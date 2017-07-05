<?php

/** @var $this \yii\web\View */
/** @var $model \app\models\Click */
/** @var $redirect boolean */

$this->title = 'Error';
?>

<div class="site-index">
    <div class="text-center">
        <div><?php echo 'This link has already been clicked or clicking from this domain is not allowed.' ?></div>
    </div>
</div>

<?php
if ($redirect) {
    $this->registerJsFile('/js/redirect.js');
}