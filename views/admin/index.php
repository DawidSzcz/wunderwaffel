<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $dataProviderVariants yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <h1>Variations</h1>
    <?= GridView::widget([
        'dataProvider' => $dataProviderVariants,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'test_name',
            'variation_name',
            'assigned_users_count',
            'conversions_count',
            [
                'class' => 'yii\grid\Column',
                'header' => 'Success rate',
                'content' => function ($model, $key, $index, $column) {
                    return sprintf("%d%%", $model->conversions_count * 100 / $model->assigned_users_count);
                }
            ],
        ],
    ]); ?>


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'firstname',
            'lastname',
            'telephone',
            'street',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
