<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $user User */
?>

<h1>Congratulations <?=$user->firstname; ?></h1>
<?= Html::img('/favicon.jpg') ?>
<h2>Wunderbar! Your wunder waffel is on the way. </h2>
<p>Your order number is: <?=$user->payment_data_id; ?></p>

<div class="form-group">
    <?= Html::a('Once again', Url::to('logout'), ['class' => 'btn btn-primary']) ?>
</div>