<?php

namespace app\models;

use ArrayObject;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $telephone
 * @property string $street
 * @property string $house_number
 * @property string $zip
 * @property string $city
 * @property string $iban
 * @property string $account_owner
 */
class User extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'firstname',
                    'lastname',
                    'telephone',
                    'street',
                    'house_number',
                    'zip',
                    'city',
                    'iban',
                    'account_owner'
                ],
                'required'
            ],
            [['payment_data_id'], 'string', 'max' => 100],
            [['firstname', 'lastname', 'street', 'city', 'iban', 'account_owner'], 'string', 'max' => 50],
            [['telephone', 'house_number', 'zip'], 'string', 'max' => 20],
        ];
    }

    public static function createFromArray($data): self
    {
        $user = new static();
        $user->attributes = $data;

        return $user;
    }

    public function setPaymentDataId(string $payment_data_id)
    {
        $this->payment_data_id = $payment_data_id;
    }

}
