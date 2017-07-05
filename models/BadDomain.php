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
            ['name', 'url'],
            ['name', 'unique', 'targetAttribute' => ['name'], 'message' => 'This URL exists in database.'],
        ];
    }

    /**
     * Returns an array with attribute labels of click model
     *
     * @return array
     */
    public static function getAttributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (self::find()->where(['name' => $this->name])->exists()) {
                return false;
            }

            return true;
        }

        return false;
    }
}