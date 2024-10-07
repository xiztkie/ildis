<?php

use backend\models\Peraturan;
// use backend\models\Monografi;
// use backend\models\Artikel;
// use backend\models\Putusan;
// use backend\models\Berita;
//use miloschuman\highcharts\Highcharts;
//use yii\web\JsExpression;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3><?= Peraturan::find()->where(['tipe_dokumen' => 1])->count(); ?></h3>

                <p>PERATURAN</p>
            </div>
            <div class="icon">
                <i class="fa fa-bookmark"></i>
            </div>
            <?= Html::a('Selengkapnya <i class="fa fa-files-o"></i>', ['peraturan/index'], ['class' => 'small-box-footer']) ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3><?= Peraturan::find()->where(['tipe_dokumen' => 2])->count(); ?></h3>

                <p>MONOGRAFI</p>
            </div>
            <div class="icon">
                <i class="fa fa-gavel"></i>
            </div>
            <?= Html::a('Selengkapnya <i class="fa fa-files-o"></i>', ['monografi/index'], ['class' => 'small-box-footer']) ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= Peraturan::find()->where(['tipe_dokumen' => 3])->count(); ?></h3>

                <p>ARTIKEL</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-text"></i>
            </div>
            <?= Html::a('Selengkapnya <i class="fa fa-files-o"></i>', ['artikel/index'], ['class' => 'small-box-footer']) ?>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-olive">
            <div class="inner">
                <h3><?= Peraturan::find()->where(['tipe_dokumen' => 4])->count(); ?></h3>

                <p>PUTUSAN</p>
            </div>
            <div class="icon">
                <i class="fa fa-paperclip"></i>
            </div>
            <?= Html::a('Selengkapnya <i class="fa fa-files-o"></i>', ['putusan/index'], ['class' => 'small-box-footer']) ?>
        </div>
    </div>


    <!-- ./col -->
</div>