<?php

use app\models\WunderWaffelForm;
use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var $formModel WunderWaffelForm */
/** @var $stepConfigs array */
?>
<div class="register">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => "main-form"
        ]
    ]); ?>

    <?= Collapse::widget([
        'items' => [
            [
                'label' => 'Step 1',
                'content' => $this->render('_partials/step',
                    ['form' => $form, 'stepFields' => WunderWaffelForm::FIRST_STEP, 'formModel' => $formModel]
                ),
                'contentOptions' => $stepConfigs[WunderWaffelForm::FIRST_STEP_CFG]
            ],
            [
                'label' => 'Step 2',
                'content' => $this->render('_partials/step',
                    ['form' => $form, 'stepFields' => WunderWaffelForm::SECOND_STEP, 'formModel' => $formModel]
                ),
                'contentOptions' => $stepConfigs[WunderWaffelForm::SECOND_STEP_CFG]
            ],
            [
                'label' => 'Step 3',
                'content' => $this->render('_partials/step',
                    ['form' => $form, 'stepFields' => WunderWaffelForm::THIRD_STEP, 'formModel' => $formModel]
                ),
                'contentOptions' => $stepConfigs[WunderWaffelForm::THIRD_STEP_CFG]
            ]
        ]
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'action' => Url::to('#')]) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- register -->
