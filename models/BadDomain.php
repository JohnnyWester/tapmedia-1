<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class BadDomain
 *
 * @property integer $id
 * @property string $name
 * @package app\models
 */
class BadDomain extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bad_domains}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['id', 'integer'],
            ['name', 'string'],
        ];
    }
}