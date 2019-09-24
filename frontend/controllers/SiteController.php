<?php
namespace frontend\controllers;

use common\models\Apple;
use common\models\CreateApple;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;

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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Список яблок
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Apple();
        return $this->render('index', ['model' => $model]);
    }

    /**
     * Добавление яблок
     */
    public function actionAddApples()
    {
        $model = new CreateApple();
        if ($model->create()) {
            Yii::$app->session->setFlash('success', 'Яблоки успешно добавлены');
        } else {
            Yii::$app->session->setFlash('error', Html::errorSummary($model));
        }

        $this->redirect(['site/index']);
    }

    /**
     * Укусываем яблоко
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionEatApple()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (isset($_POST['id'])) {
            $model = Apple::findOne($_POST['id']);
            $model->how_much_is_eaten = $_POST['size'];
            if ($model->how_much_is_eaten == 100 && $model->delete()) {
                return ['result' => true, 'message' => 'Яблоко съедено'];
            }
            if ($model->save()) {
                return ['result' => true, 'message' => 'Яблоко укушено'];
            } else {
                return ['result' => false, 'message' => Html::errorSummary($model, ['header' => ''])];
            }
        } else {
            return ['result' => false, 'message' => 'Не найдено кусаемое яблоко'];
        }
    }
}
