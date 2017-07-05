<?php

namespace app\models\handlers;

use app\models\BadDomain;
use app\models\interfaces\IHandler;
use yii\web\Request;
use app\models\Click;
use Yii;

/**
 * Class ClickExistsHandler
 * @package app\models\handlers
 */
class ClickExistsHandler implements IHandler
{
    /**
     * @inheritdoc
     */
    public function run(Request $request, string $param1, string $param2)
    {
        $model = $this->getClick($request, $param1);

        if ($this->checkReferrerInBadDomains($request->referrer)) {
            $this->handleClick($model, 'bad_domain');
        }

        $this->handleClick($model, 'error');
        $this->saveBadDomain($request->referrer);
        Yii::$app->controller->redirect(["error/{$model->id}"]);
    }

    /**
     * Handle click by updating counter in database
     *
     * @param $model Click
     * @param $field string
     */
    protected function handleClick($model, $field)
    {
        if (!empty($model)) {
            $model->updateCounters([$field => 1]);
        }
    }

    /**
     * Save referrer address in bad_domain table
     *
     * @param $referrer
     * @return bool
     */
    protected function saveBadDomain($referrer)
    {
        $badDomain = new BadDomain();
        $badDomain->name = $referrer;

        $badDomain->save();
    }

    /**
     * Find model in click table
     *
     * @param $request
     * @param $param1
     * @return array|null|\yii\db\ActiveRecord
     */
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

    /**
     * Checks if referrer address exists in database
     *
     * @param $referrer
     * @return bool
     */
    public function checkReferrerInBadDomains($referrer)
    {
        $model = BadDomain::findOne(['name' => $referrer]);

        return empty($model) ? false : true;
    }
}