<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var $model \app\models\BadDomain */

$form = ActiveForm::begin([
    'id' => 'bad-domain-form',
]);

echo $form->field($model, 'name')->textInput();

echo Html::submitButton('Save', ['class' => 'btn btn-primary']);

ActiveForm::end();