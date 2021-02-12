<?php

namespace app\controllers;

use app\components\ABTestManager;
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
                return $this->displayForm(
                    WunderWaffelForm::createFromArray($session[static::SESSION_FIELD_FORM]),
                    $session
                );
            } else {
                return $this->submitForm($session);
            }
        }
    }

    private function submitForm(Session $session)
    {
        $form = new WunderWaffelForm();

        if (!$form->load(Yii::$app->request->post()) || !$form->validate()) {
            return $this->displayForm($form, $session);
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

            ABTestManager::countSuccess(
                ABTestManager::REGISTER_VIEW_TEST,
                $session[ABTestManager::REGISTER_VIEW_TEST]
            );

            return $this->displaySuccess($user);
        }
    }

    private function displayForm($form, Session $session)
    {
        if (!isset($session[ABTestManager::REGISTER_VIEW_TEST])) {
            $session[ABTestManager::REGISTER_VIEW_TEST] = ABTestManager::drawVariant(ABTestManager::REGISTER_VIEW_TEST);
        }

        return $this->render($session[ABTestManager::REGISTER_VIEW_TEST], [
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
