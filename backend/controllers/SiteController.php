<?php
namespace backend\controllers;

use common\models\Color;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'save-colors', 'delete-color'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Сохранение цветов
     */
    public function actionSaveColors()
    {
        if ($_POST['Color']) {
            foreach ($_POST['Color'] as $color) {
                $model = Color::findOne($color['id']) ?? new Color();
                if (!$model->load($color, '') || !$model->save()) {
                    Yii::$app->session->setFlash('error', Html::errorSummary($model));
                }
            }
        }

        $this->redirect('index');
    }

    /**
     * Удаление цвета
     * @return array
     */
    public function actionDeleteColor()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = Color::findOne($_POST['id']);
        $model->deleted = true;
        if($model->save()) {
            return ['result' => true];
        } else {
            return ['result' => false, 'message' => Html::errorSummary($model, ['header' => ''])];
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
