<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\Request;

/**
 * Class Click
 * @property string id
 * @property string ua
 * @property string ip
 * @property string ref
 * @property string param1
 * @property string param2
 * @property integer error
 * @property integer bad_domain
 *
 * @package app\models
 */
class Click extends ActiveRecord
{
    const CLICK_EXISTS_HANDLER = 'app\models\handlers\ClickExistsHandler';
    const CLICK_NOT_EXISTS_HANDLER = 'app\models\handlers\ClickNotExistsHandler';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%click}}';
    }

    public function rules()
    {
        return [
            [['id', 'ua', 'ip', 'ref', 'param1', 'param2'], 'required'],
            [['id', 'ua', 'ip', 'ref', 'param1', 'param2'], 'string'],
            [['error', 'bad_domain'], 'integer'],
            ['id', 'unique'],
        ];
    }

    /**
     * Checking of unique click exists in database
     *
     * @param $request Request
     * @param $param1 string
     * @return bool
     */
    public static function clickExists($request, $param1)
    {
        $model = self::find()
            ->where([
                'ua' => $request->userAgent,
                'ip' => $request->userIP,
                'ref' => $request->referrer,
                'param1' => $param1,
            ])->one();

        return empty($model) ? false : true;
    }

    public function generateId()
    {
        return uniqid();
    }

    public static function saveClick($request, $param1, $param2)
    {
        $click = new Click();
        $click->id = $click->generateId();
        $click->ua = $request->userAgent;
        $click->ip = $request->userIP;
        $click->ref = $request->referrer;
        $click->param1 = $param1;
        $click->param2 = $param2;

        return ($click->save()) ? $click->id : false;
    }

    public function getHandler($condition)
    {
        switch ($condition) {
            case true:
                return self::CLICK_EXISTS_HANDLER;
                break;
            case false:
                return self::CLICK_NOT_EXISTS_HANDLER;
                break;
        }
    }
}