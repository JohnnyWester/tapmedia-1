<?php

namespace app\models\interfaces;

use yii\web\Request;

/**
 * Interface IHandler
 * @package app\models\interfaces
 */
interface IHandler
{
    /**
     * Runs click handler
     *
     * @param $request Request
     * @param $param1 string
     * @param $param2 string
     * @return mixed
     */
    public function run(Request $request, string $param1, string $param2);
}