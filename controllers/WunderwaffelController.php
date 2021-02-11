<?php

namespace app\controllers;

use app\models\User;
use app\models\WunderWaffelForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Session;

class WunderwaffelController extends Controller
{
    const SESSION_FIELD_FORM = 'form-data';
    const SESSION_FIELD_USER = 'user-id';

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
        return $this->redirect('/wunderwaffel/register');
    }

    public function actionRegister()
    {
        $session = Yii::$app->session;
        $session->open();

        if (null !== ($user_id = $session->get(static::SESSION_FIELD_USER))) {
            return $this->displaySuccess(User::findOne($user_id));
        } else {
            if (null === $session->get(static::SESSION_FIELD_FORM)) {
                $session->set(static::SESSION_FIELD_FORM, new \ArrayObject());
            }
            if (!Yii::$app->request->getIsPost()) {
                return $this->displayForm(WunderWaffelForm::createFromArray($session[static::SESSION_FIELD_FORM]));
            } else {
                return $this->submitForm($session);
            }
        }
    }

    private function submitForm(Session $session)
    {
        $form = new WunderWaffelForm();

        if (!$form->load(Yii::$app->request->post()) || !$form->validate()) {
            $this->displayForm($form);
        } else {
            $user = User::createFromArray($form->getData());
            $user->save();

            $user->setPaymentDataId(Yii::$app->wunderApi->registerClient(
                $user->id,
                $user->iban,
                $user->account_owner
            ));
            $user->save();
            unset($session[static::SESSION_FIELD_FORM]);
            $session[static::SESSION_FIELD_USER] = $user->id;

            return $this->displaySuccess($user);
        }
    }

    private function displayForm($form)
    {
        return $this->render('register-form-b', [
            'formModel' => $form,
            'stepConfigs' => $form->getStepsConfiguration()
        ]);
    }

    private function displaySuccess(User $user)
    {
        return $this->render('register-success', [
            'user' => $user
        ]);
    }


    public function actionUpdateform()
    {
        $session = Yii::$app->session;
        $session->open();
        $session[static::SESSION_FIELD_FORM][Yii::$app->request->get('name')] = Yii::$app->request->get('value');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->destroy();

        return $this->redirect('register');
    }
}
