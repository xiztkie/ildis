<?php

use mdm\admin\components\Helper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CirculationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Circulation';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php Pjax::begin(['enablePushState' => false]); ?>

<div class="box-body table-responsive no-padding">
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <?= GridView::widget([

        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Data ' . 'Circulation' . '</h3>',
        ],
        'toolbar' =>  [
            ['content' => Html::a('<i class="fa fa-plus-circle"></i> Tambah Data', ['create'], ['class' => 'btn btn-success'])],
            '{export}',
            '{toggleData}'
        ],
        'dataProvider' => $dataProvider,
        'summary' => 'Ditampilkan {begin} - {end} dari {totalCount} Data',
        'filterModel' => $searchModel,
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [

            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 50px;', 'class' => 'text-center'],
                'header' => 'No',
                'headerOptions' => ['class' => 'text-center'],
            ],


            'member_id',
            'member',
            'document_id',
            'title',
            // 'item_id',
            // 'item_code',
            // 'tanggal_pinjam',
            // 'tanggal_kembali',
            // 'status',
            // 'denda',
            // '_created_by',
            // '_updated_by',
            // '_created_time',
            // '_updated_time',


            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 150px;', 'class' => 'text-center'],
                'contentOptions' => ['style' => 'width: 150px;', 'class' => 'text-center'],
                'header' => 'Aksi',
                'template' => Helper::filterActionColumn('{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}'),

                'buttons' => [
                    'view' => function ($url, $model) {
                        return
                            Html::a('<span class="btn btn-sm btn-success"><b class="fa fa-search-plus"></b></span>', ['view', 'id' => $model->id], ['title' => 'Lihat']);
                    },
                    'update' => function ($id, $model) {
                        return Html::a('<span class="btn btn-sm btn-warning"><b class="fa fa-pencil"></b></span>', ['update', 'id' => $model->id], ['title' => 'Ubah']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="btn btn-sm btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model->id], ['title' => 'Hapus', 'class' => '', 'data' => ['confirm' => 'Yakin akan menghapus data ini.', 'method' => 'post', 'data-pjax' => false],]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>