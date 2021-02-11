<?php

namespace app\models;

use ArrayObject;
use Yii;
use yii\base\Model;

class WunderWaffelForm extends Model
{
    const FIRSTNAME_FIELD = 'firstname';
    const LASTNAME_FIELD = 'lastname';
    const TELEPHONE_FIELD = 'telephone';
    const STREET_FIELD = 'street';
    const HOUSE_NUMBER_FIELD = 'house_number';
    const ZIP_FIELD = 'zip';
    const CITY_FIELD = 'city';
    const IBAN_FIELD = 'iban';
    const ACCOUNT_OWNER_FIELD = 'account_owner';

    const FIRST_STEP_CFG = 'cfg-1';
    const SECOND_STEP_CFG = 'cfg-2';
    const THIRD_STEP_CFG = 'cfg-3';

    const FIRST_STEP = [
        self::FIRSTNAME_FIELD,
        self::LASTNAME_FIELD,
        self::TELEPHONE_FIELD,
    ];

    const SECOND_STEP = [
        self::STREET_FIELD,
        self::HOUSE_NUMBER_FIELD,
        self::ZIP_FIELD,
        self::CITY_FIELD,
    ];

    const THIRD_STEP = [
        self::IBAN_FIELD,
        self::ACCOUNT_OWNER_FIELD,
    ];

    public $firstname;
    public $lastname;
    public $telephone;
    public $street;
    public $house_number;
    public $zip;
    public $city;
    public $account_owner;
    public $iban;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [
                [
                    static::FIRSTNAME_FIELD,
                    static::LASTNAME_FIELD,
                    static::TELEPHONE_FIELD,
                    static::STREET_FIELD,
                    static::HOUSE_NUMBER_FIELD,
                    static::ZIP_FIELD,
                    static::CITY_FIELD,
                    static::IBAN_FIELD,
                    static::ACCOUNT_OWNER_FIELD
                ],
                'required'
            ],
            [
                [
                    static::FIRSTNAME_FIELD,
                    static::LASTNAME_FIELD,
                    static::STREET_FIELD,
                    static::CITY_FIELD,
                    static::IBAN_FIELD,
                    static::ACCOUNT_OWNER_FIELD
                ],
                'string',
                'max' => 50
            ],
            [[static::TELEPHONE_FIELD, static::HOUSE_NUMBER_FIELD, static::ZIP_FIELD,], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'telephone' => 'Telephone',
            'street' => 'Street',
            'house_number' => 'House Number',
            'zip' => 'Zip',
            'city' => 'City',
            'iban' => 'Iban',
            'account_owner' => 'Account Owner',
        ];
    }

    public function getData()
    {
        return $this->getAttributes();
    }

    public static function createFromArray(ArrayObject $data): self
    {
        $form = new static();

        $form->firstname = $data['firstname'] ?? null;
        $form->lastname = $data['lastname'] ?? null;
        $form->telephone = $data['telephone'] ?? null;
        $form->street = $data['street'] ?? null;
        $form->house_number = $data['house_number'] ?? null;
        $form->zip = $data['zip'] ?? null;
        $form->city = $data['city'] ?? null;
        $form->account_owner = $data['account_owner'] ?? null;
        $form->iban = $data['iban'] ?? null;

        return $form;
    }

    public function getStepsConfiguration(): array
    {
        $hasErrorsFirst = array_reduce(static::FIRST_STEP, function ($curry, $item) {
            return $curry || $this->hasErrors($item);
        }, false);
        $hasErrorsSecond = array_reduce(static::SECOND_STEP, function ($curry, $item) {
            return $curry || $this->hasErrors($item);
        }, false);
        $hasErrorsThird = array_reduce(static::THIRD_STEP, function ($curry, $item) {
            return $curry || $this->hasErrors($item);
        }, false);
        $isFilledFirst = array_reduce(static::FIRST_STEP, function ($curry, $item) {
            return $curry && null !== $this->$item;
        }, true);
        $isFilledSecond = array_reduce(static::SECOND_STEP, function ($curry, $item) {
            return $curry && null !== $this->$item;
        }, true);
        $isFilledThird = array_reduce(static::THIRD_STEP, function ($curry, $item) {
            return $curry && null !== $this->$item;
        }, true);

        return [
            static::FIRST_STEP_CFG => [
                'class' => $hasErrorsFirst || !$isFilledFirst ? 'in' : ''
            ],
            static::SECOND_STEP_CFG => [
                'class' => $hasErrorsSecond || (!$isFilledSecond && $isFilledFirst) ? 'in' : ''
            ],
            static::THIRD_STEP_CFG => [
                'class' => $hasErrorsThird || (!$isFilledThird && $isFilledFirst && $isFilledSecond) ? 'in' : ''
            ],
        ];
    }
}
