<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Gmd */

$this->title = 'Tambah Data Gmd';
$this->params['breadcrumbs'][] = ['label' => 'Gmd', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body no-padding">

    <?= $this->render('_form-create', [
    'model' => $model,
    ]) ?>
</div>


