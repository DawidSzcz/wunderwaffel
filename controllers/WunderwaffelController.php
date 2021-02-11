<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use app\models\WunderWaffelForm;
use app\models\ContactForm;

class WunderwaffelController extends Controller
{
    const SESSION_FIELD_FORM = 'form-data';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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

    public function actionIndex()
    {
        return $this->redirect('register');
    }

    public function actionRegister()
    {
        $session = Yii::$app->session;
        $session->open();
        if (null === $session->get(static::SESSION_FIELD_FORM)) {
            $session->set(static::SESSION_FIELD_FORM, new \ArrayObject());
        }

        if (!Yii::$app->request->getIsPost()) {
            $form = WunderWaffelForm::createFromArray($session[static::SESSION_FIELD_FORM]);
        } else {
            $form = new WunderWaffelForm();

            if ($form->load(Yii::$app->request->post())) {
                if ($form->validate()) {
                    $form->registerUser();
                    unset($session[static::SESSION_FIELD_FORM]);

                    $this->redirect(Url::to('index'));
                }
            }
        }

        return $this->render('register', [
            'formModel' => $form,
            'stepConfigs' => $form->getStepsConfiguration()
        ]);
    }

    public function actionUpdateform()
    {
        $session = Yii::$app->session;
        $session->open();
        $session[static::SESSION_FIELD_FORM][Yii::$app->request->get('name')] = Yii::$app->request->get('value');
        return 'Success';
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->destroy();

        return $this->goHome();
    }
}
