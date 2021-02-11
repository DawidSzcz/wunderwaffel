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

    <?php foreach ($formModel->getAttributes() as $key => $field) : ?>
        <?= $form->field($formModel, $key);?>
    <?php endforeach ?>


    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'action' => Url::to('#')]) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- register -->
