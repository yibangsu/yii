<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <!--p>
        This is the About page. You may modify the following file to customize its content:
    </p-->

    <div class="col-lg-offset-1">
        Fota Manager Site<br>
        Version: 1.0.0
    </div>

    <!--code><?= __FILE__ ?></code-->
</div>
