<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\datamodels\TestModel;

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;



$cform = new TestModel();

$cform->Body ="bodyyyyyy";
$cform->Name ="namemmmmm";
$cform->Email ="emailllllll";
$cform->Subject ="subjecttttttttttt";


print $cform->renderToXml();

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the test page.
    </p>

    <code><?= __FILE__ ?></code>
</div>
