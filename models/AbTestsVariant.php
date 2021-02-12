<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ab_tests_variants".
 *
 * @property int $id
 * @property string $test_name
 * @property string $variation_name
 * @property int $assigned_users_count
 * @property int $conversions_count
 */
class AbTestsVariant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ab_tests_variants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_name', 'variation_name', 'assigned_users_count', 'conversions_count'], 'required'],
            [['assigned_users_count', 'conversions_count'], 'integer'],
            [['test_name', 'variation_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_name' => 'Test Name',
            'variation_name' => 'Variation Name',
            'assigned_users_count' => 'Assigned Users Count',
            'conversions_count' => 'conversions Count',
        ];
    }
}
