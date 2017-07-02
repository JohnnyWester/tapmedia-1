<?php

namespace app\models\handlers;

use app\models\Click;
use app\models\interfaces\IHandler;
use yii\web\Request;
use Yii;

class ClickNotExistsHandler implements IHandler
{
    /**
     * @inheritdoc
     */
    public function run(Request $request, string $param1, string $param2)
    {
        $clickId = Click::saveClick($request, $param1, $param2);

        if ($clickId != false) {
            Yii::$app->controller->redirect(["success/{$clickId}"]);
        }
    }
}