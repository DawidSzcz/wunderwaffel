<?php


namespace app\components;

use app\models\AbTestsVariant;

class ABTestManager
{
    const REGISTER_VIEW_TEST = 'reg_test';

    public static function drawVariant($testName): string
    {
        /** @var AbTestsVariant[] $variants */
        $variants = [];

        /** @var AbTestsVariant $variant */
        foreach (AbTestsVariant::findAll(['test_name' => $testName]) as $variant) {
            $variants[$variant->variation_name] = $variant;
        }

        $result = array_rand($variants);

        $variants[$result]->updateCounters([
            'assigned_users_count' => 1
        ]);

        return $result;
    }

    public static function countSuccess($test_name, $variant_name)
    {
        AbTestsVariant::findOne([
            'test_name' => $test_name,
            'variation_name' => $variant_name
        ])->updateCounters([
            'conversions_count' => 1
        ]);
    }
}