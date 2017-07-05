<?php

use yii\helpers\Html;
use app\models\Click;
use \app\models\BadDomain;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $paramsConfig array */
/* @var $attributeLabels array */
/* @var $badDomainAttributeLabels array */
/* @var $models Click */
/* @var $model Click */
/* @var $badDomains BadDomain */
/* @var $badDomain BadDomain */

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

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Logged links table</h3>
        </div>
        <div id="links">
            <input class="search form-control" placeholder="Search" />

            <div class="buttons text-center">
                <button class="sort btn btn-default" data-sort="click-id">Sort by click ID</button>
                <button class="sort btn btn-default" data-sort="user-agent">Sort by user agent</button>
                <button class="sort btn btn-default" data-sort="ip">Sort by IP</button>
                <button class="sort btn btn-default" data-sort="ref">Sort by referrer</button>
                <button class="sort btn btn-default" data-sort="param-1">Sort by param 1</button>
                <button class="sort btn btn-default" data-sort="param-2">Sort by param 2</button>
                <button class="sort btn btn-default" data-sort="error">Sort by error</button>
                <button class="sort btn btn-default" data-sort="bad-domain">Sort by bad domain</button>
            </div>

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <?php foreach ($attributeLabels as $attributeLabel): ?>
                            <th><?php echo $attributeLabel ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>

                <tbody class="list">
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td class="click-id"><?php echo $model->id ?></td>
                        <td class="user-agent"><?php echo $model->ua ?></td>
                        <td class="ip"><?php echo $model->ip ?></td>
                        <td class="ref"><?php echo $model->ref ?></td>
                        <td class="param-1"><?php echo $model->param1 ?></td>
                        <td class="param-2"><?php echo $model->param2 ?></td>
                        <td class="error"><?php echo $model->error ?></td>
                        <td class="bad-domain"><?php echo $model->bad_domain ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
           <div class="row">
               <h3 class="panel-title text-center">Bad domains table</h3>
               <a href="<?php echo Url::to(['site/bad-domain']) ?>" class="btn btn-primary btn-custom">Add domain</a>
           </div>
        </div>
        <div id="bad-domains">
            <input class="search form-control" placeholder="Search" />

            <div class="buttons text-center">
                <button class="sort btn btn-default" data-sort="id">Sort by ID</button>
                <button class="sort btn btn-default" data-sort="name">Sort by name</button>
            </div>

            <table class="table table-condensed">
                <thead>
                <tr>
                    <?php foreach ($badDomainAttributeLabels as $badDomainAttributeLabel): ?>
                        <th><?php echo $badDomainAttributeLabel ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>

                <tbody class="list">
                <?php foreach ($badDomains as $badDomain): ?>
                    <tr>
                        <td class="id"><?php echo $badDomain->id ?></td>
                        <td class="name"><?php echo $badDomain->name ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
</div>
