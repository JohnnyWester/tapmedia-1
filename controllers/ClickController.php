<?php

namespace app\controllers;

use app\models\Click;
use yii\web\Controller;
use Yii;

/**
 * Class ClickController
 * @package app\controllers
 */
class ClickController extends Controller
{
    /**
     * @param $param1
     * @param $param2
     */
    public function actionIndex($param1, $param2)
    {
        $click = new Click();
        $request = Yii::$app->request;
        $clickExists = Click::clickExists($request, $param1);

        $clickHandlerClassName = $click->getHandler($clickExists);
        (new $clickHandlerClassName())->run($request, $param1, $param2);
    }

    /**
     * Renders success view after saving link info
     *
     * @param $clickId
     * @return string
     */
    public function actionSuccess($clickId)
    {
        $model = Click::findOne(['id' => $clickId]);

        return $this->render('success', [
            'model' => $model,
        ]);
    }

    /**
     * Renders error view if link is already logged
     *
     * @param $clickId
     * @return string
     */
    public function actionError($clickId)
    {
        $model = Click::findOne(['id' => $clickId]);

        return $this->render('error', [
            'model' => $model,
            'redirect' => $model->checkBadDomain(),
        ]);
    }
}