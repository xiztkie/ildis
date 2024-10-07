<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\PeraturanTerkait;
use frontend\models\DokumenTerkait;
use frontend\models\DataLampiran;
use frontend\models\DataStatus;
use frontend\models\Eksemplar;

use frontend\models\HasilUjiMateri;
use frontend\models\DataPengarang;
use frontend\models\DataSubyek;
/* @var $this yii\web\View */
/* @var $model frontend\models\Dokumen */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="page-title-section bg-img cover-background" data-overlay-dark="7" data-background="/img/banner/header.jpg">
    <div class="container">
        <h1>Monografi Detail</h1>
        <ul class="text-center">
            <li><?= Html::a('Home', ['/']); ?></li>
            <li><?= Html::a('Monografi', ['/dokumen/monografi']); ?></li>
            <li>
                <span class="active"> <?= $model->jenis_peraturan; ?></span>
            </li>
        </ul>
    </div>
</section>
<!-- end page title section -->

<!-- start blog detail section -->
<section class="blogs">
    <div class="container">
        <div class="widget search mb-4">
            <form id="w0" action="/dokumen/index" method="get" data-pjax="1">
                <div class="form-row align-items-center">
                    <div class="col-md-10 my-1">
                        <input type="text" class="form-control" id="dokumensearch-judul" name="DokumenSearch[judul]" placeholder="cari dokumen hukum lainnya...">
                    </div>


                    <div class="col-md-2 my-1">
                        <button type="submit" class="butn btn-block">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <!--  start blog left-->

            <div class="col-lg-8 col-md-12 sm-margin-50px-bottom">
                <div class="posts">
                    <!--  start post-->

                    <div class="content">
                        <div class="blog-list-simple-text post-meta margin-20px-bottom">
                            <div class="post-title">
                                <h5><?= $model->judul; ?></h5>
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-lg-6 col-md-6 mb-3">
                                Nomor Panggil<br>
                                <span class="text-extra-dark-gray font-weight-600"><?= $model->nomor_panggil; ?></span>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-3">
                                Penerbit <br>
                                <span class="text-extra-dark-gray font-weight-600"><?= $model->penerbit; ?></span>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                Tahun Terbit<br>
                                <span class="text-extra-dark-gray font-weight-600"><?= $model->tahun_terbit; ?></span>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                Deskripsi Fisik<br>
                                <span class="text-extra-dark-gray font-weight-600"><?= $model->deskripsi_fisik; ?></span>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-3">
                                Klasifikasi<br>
                                <span class="text-extra-dark-gray font-weight-600"><?= $model->klasifikasi; ?></span>
                            </div>


                            <div class="col-lg-6 col-md-6 mb-3">
                                Bahasa<br>
                                <span class="text-extra-dark-gray font-weight-600"><?= $model->bahasa; ?></span>
                            </div>
                           <div class="col-lg-6 col-md-6 mb-3">
                                ISBN<br>
                                <span class="text-extra-dark-gray font-weight-600"><?= $model->isbn; ?></span>
                            </div>
                           <div class="col-lg-6 col-md-6 mb-3">
                                Tempat Terbit<br>
                                <span class="text-extra-dark-gray font-weight-600"><?= $model->tempat_terbit; ?></span>
                            </div>
                           <div class="col-lg-6 col-md-6 mb-3">
                                Anotasi<br>
                                <span class="text-extra-dark-gray font-weight-600"><p class="text-justify"><?= $model->sumber; ?></p></span>
                            </div>
                           <div class="col-lg-6 col-md-6 mb-3">
                                Bidang Hukum<br>
                                <span class="text-extra-dark-gray font-weight-600"><?= $model->bidang_hukum; ?></span>
                            </div>

                        </div>

                        <div class="row align-items-end">
                            <div class="col-lg-12 col-md-12 mt-4">
                                <span class="text-extra-dark-gray font-weight-600">EKSEMPLAR</span><br>
                                <table class="table">
                                    <thead>
                                        <tr class="active">
                                            <th>Kode Eksemplar</th>
                                            <th>lokasi Rak</th>
                                            <th>Status Buku</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $eksemplar = Eksemplar::find()->where(['id_dokumen' => $model->id])->all();
                                    if (!empty($eksemplar)) {
                                        echo '<tbody>';
                                        foreach ($eksemplar as  $data) {
                                            //echo $data['document_terkait'];
                                            echo '<tr><td>' . $data->kode_eksemplar . '</td>';
                                            echo '<td>' . $data->lokasi_rak . '</td>';
						if ($data->status_eksemplar =='Dipinjam'){

                                            echo '<td><span class="label label-danger">' . $data->status_eksemplar . '</span></td></tr>';
}else{
 echo '<td>' . $data->status_eksemplar . '</td></tr>';
}

                                        }
                                        echo '</tbody>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>

                        <div class="row align-items-end">
                            <div class="col-lg-12 col-md-12 mt-4">
                                <span class="text-extra-dark-gray font-weight-600">T.E.U BADAN</span><br>
                                <table class="table">
                                    <thead>
                                        <tr class="active">
                                            <th>Nama Pengarang</th>
                                            <th>Tipe Pengarang</th>
                                            <th>Jenis Pengarang</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $teu = DataPengarang::find()->where(['id_dokumen' => $model->id])->all();
                                    if (!empty($teu)) {
                                        echo '<tbody>';
                                        foreach ($teu as  $data) {
                                            //echo $data['document_terkait'];
                                            echo '<tr><td>' . $data->namaPengarang->name . '</td>';
                                            echo '<td>' . $data->tipePengarang->name . '</td>';
                                            echo '<td>' . $data->jenisPengarang->name . '</td></tr>';
                                        }
                                        echo '</tbody>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>

                        <div class="row align-items-end">
                            <div class="col-lg-12 col-md-12 mt-4">
                                <span class="text-extra-dark-gray font-weight-600"> SUBJEK : </span>
                                <!-- <table class="table">
                                    <thead>
                                        <tr class="active">
                                            <th>Nama Subjek</th>
                                            <th>Tipe Subjek</th>
                                            <th>Jenis Subjek</th>
                                        </tr>
                                    </thead> -->
                                <?php
                                $subjek = DataSubyek::find()->where(['id_dokumen' => $model->id])->all();
                                if (!empty($subjek)) {

                                    foreach ($subjek as  $data) {

                                        echo  $data->subyek . ' - ';
                                    }
                                    //echo// '</tbody>';
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  end blog left-->

            <!--  start blog right-->
            <div class="col-lg-4 col-md-12 padding-30px-left sm-padding-15px-left">
                <div class="side-bar">
                    <div class="shadow">
                        <ul class="list-group mt-2">
                            <li class="list-group-item text-center">JENIS DOKUMEN</li>
                            <li class="list-group-item list-group-item-primary text-center"><strong><?= $model->jenis_peraturan; ?></strong></li>
                        </ul>
                    </div>

                    <?php if (!empty($model->gambar_sampul)) {
                        echo '    
                    <div class="shadow">
                        <ul class="list-group mt-2">
                            <li class="list-group-item text-center">COVER </li>
                            <li class="list-group-item list-group-item-warning text-center">' .
                            Html::img('@web/common/dokumen/' . $model->gambar_sampul, ['class' => 'rounded']) . '
                            
                            </li>
                        </ul>
                    </div>';
                    } ?>

                    <div class="widget">
                        <div class="widget-title margin-35px-bottom mt-4">
                            <h3>Lampiran</h3>
                        </div>
                        <ul class="widget-list">
                            <?php
                            $lampiran = DataLampiran::find()->where(['id_dokumen' => $model->id])->all();

                            if (!empty($lampiran)) {
                                foreach ($lampiran as  $data) {
                                    //echo '<li>'.$data['dokumen_lampiran'].'</li>';
                                    //echo Html::a($data['dokumen_lampiran'], ['/dokumen/download', 'id' => $data->dokumen_lampiran], ['target' => '_blank', 'class' => 'btn btn-secondary btn-sm mb-2 btn-hover-primary', 'title' => 'download file']);
                                    echo  Html::a($data['dokumen_lampiran'], ['/common/dokumen/' . $data->dokumen_lampiran], ['class' => 'btn btn-secondary btn-sm mb-2 btn-hover-primary', 'target' => '_blank', 'title' => 'lihat file']);
                                    # code...
                                }
                            }
                            if (!empty($model->abstrak)) {
                                echo '<br>';
                                //echo Html::a($model->abstrak, ['/dokumen/download', 'id' => $model->abstrak], ['target' => '_blank', 'class' => 'btn btn-secondary btn-sm mb-2 btn-hover-primary', 'title' => 'download file']);
                                echo  Html::a($model->abstrak, ['/common/dokumen/' . $model->abstrak], ['class' => 'btn btn-secondary btn-sm mb-2 btn-hover-primary', 'target' => '_blank', 'title' => 'lihat file']);
                            }
                            ?>

                        </ul>
                    </div>



                </div>
            </div>
            <!--  end blog right-->

        </div>
    </div>
</section>