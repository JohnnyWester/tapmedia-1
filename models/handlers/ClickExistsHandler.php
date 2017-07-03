<?php

namespace app\models\handlers;

use app\models\BadDomain;
use app\models\interfaces\IHandler;
use yii\web\Request;
use app\models\Click;
use Yii;

class ClickExistsHandler implements IHandler
{
    /**
     * @inheritdoc
     */
    public function run(Request $request, string $param1, string $param2)
    {
        $model = $this->getClick($request, $param1);

        if ($this->checkReferrerInBadDomains($request->referrer)) {
            if (!empty($model)) {
                $model->updateCounters(['bad_domain' => 1]);
            }
        }

        $this->handleClick($model);

        if ($this->saveBadDomain($request->referrer)) {
            Yii::$app->controller->redirect(["error/{$model->id}"]);
        }
    }

    protected function handleClick($model)
    {
        if (!empty($model)) {
            $model->updateCounters(['error' => 1]);
        }
    }

    protected function saveBadDomain($referrer)
    {
        $badDomain = new BadDomain();
        $badDomain->name = $referrer;

        return $badDomain->save();
    }

    protected function getClick($request, $param1)
    {
        $model = Click::find()
            ->where([
                'ua' => $request->userAgent,
                'ip' => $request->userIP,
                'ref' => $request->referrer,
                'param1' => $param1,
            ])->one();

        return $model;
    }

    public function checkReferrerInBadDomains($referrer)
    {
        $model = BadDomain::findOne(['name' => $referrer]);

        return empty($model) ? false : true;
    }
}