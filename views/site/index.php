<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $paramsConfig array */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="text-center">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Links panel</h3>
            </div>
            <div class="panel-body">
                <?php foreach ($paramsConfig as $key => $value): ?>
                    <?php
                    echo Html::a("Link {$key}", [
                        '/click/index', 'param1' => $value['param1'], 'param2' => $value['param2'],
                    ]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
