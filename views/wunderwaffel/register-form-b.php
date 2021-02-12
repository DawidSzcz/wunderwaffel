<?php

use app\models\WunderWaffelForm;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var $formModel WunderWaffelForm */
/** @var $stepConfigs array */

$this->registerCssFile('@web/css/register-b.css');
$this->registerJsFile('@web/js/register-b.js', [
    'depends' => JqueryAsset::class
]);
?>
<div class="register">
    <h1>Enjoy your form steps separated</h1>
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => "main-form"
        ]
    ]); ?>

    <div id="first-step" class="step <?= $stepConfigs[WunderWaffelForm::FIRST_STEP_CFG]['class'] ?>">
        <h2>First step</h2>
        <?php foreach (WunderWaffelForm::FIRST_STEP as $field) : ?>
            <?= $form->field($formModel, $field); ?>
        <?php endforeach ?>

        <?= Html::button('Next'); ?>
    </div>

    <div id="second-step" class="step <?= $stepConfigs[WunderWaffelForm::SECOND_STEP_CFG]['class'] ?>">
        <h2>Second step</h2>
        <?php foreach (WunderWaffelForm::SECOND_STEP as $field) : ?>
            <?= $form->field($formModel, $field); ?>
        <?php endforeach ?>

        <?= Html::button('Next'); ?>
    </div>

    <div id="third-step" class="step <?= $stepConfigs[WunderWaffelForm::THIRD_STEP_CFG]['class'] ?>">
        <h2>Third step</h2>
        <?php foreach (WunderWaffelForm::THIRD_STEP as $field) : ?>
            <?= $form->field($formModel, $field); ?>
        <?php endforeach ?>

        <?= Html::submitButton('Send'); ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- register -->
