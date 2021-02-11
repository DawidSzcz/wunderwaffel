<?php
use app\models\WunderWaffelForm;
use yii\widgets\ActiveForm;

/** @var $formModel WunderWaffelForm */
/** @var $stepFields string[] */
/** @var $form ActiveForm */
?>

<?php foreach ($stepFields as $field) : ?>
    <?= $form->field($formModel, $field);?>
<?php endforeach ?>