<?php

namespace app\controllers;

use app\models\Click;
use yii\web\Controller;
use Yii;

class ClickController extends Controller
{
    public function actionIndex($param1, $param2)
    {
        $click = new Click();
        $request = Yii::$app->request;
        $clickExists = Click::clickExists($request, $param1, $param2);

        $clickHandlerClassName = $click->getHandler($clickExists);
        (new $clickHandlerClassName())->run($request, $param1, $param2);
    }

    public function actionSuccess($clickId)
    {
        $model = Click::findOne(['id' => $clickId]);

        return $this->render('success', [
            'model' => $model,
        ]);
    }

    public function actionError($clickId)
    {
        $model = Click::findOne(['id' => $clickId]);

        return $this->render('error', [
            'model' => $model,
            'redirect' => $model->checkBadDomain(),
        ]);
    }
}