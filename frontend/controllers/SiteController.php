<?php
namespace frontend\controllers;

use common\models\Apple;
use common\models\CreateApple;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

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
}
