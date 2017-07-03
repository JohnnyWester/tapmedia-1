<?php

/** @var $this \yii\web\View */
/** @var $model \app\models\Click */

$this->title = 'Success';
?>

<div class="site-index">
    <div class="text-center">
        <div><?php echo $model->id ?></div>
        <div><?php echo $model->ua ?></div>
        <div><?php echo $model->ip ?></div>
        <div><?php echo $model->ref ?></div>
        <div><?php echo $model->param1 ?></div>
        <div><?php echo $model->param2 ?></div>
        <div><?php echo $model->error ?></div>
        <div><?php echo $model->bad_domain ?></div>
    </div>
</div>