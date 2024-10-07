<?php

namespace backend\controllers;

use Yii;
use backend\models\DokumenJdih;
use backend\models\Eksemplar;
use backend\models\Pengarang;
use backend\models\LogPustakawan;
use backend\models\JenisPeraturan;
use backend\models\DataPengarang;
use backend\models\DataSubyek;
use backend\models\DataStatus;
use backend\models\DataLampiran;
use backend\models\HasilUjiMateri;
use backend\models\DokumenTerkait;
use backend\models\PeraturanTerkait;
use backend\models\search\DokumenJdihSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

/**
 * PeraturanController implements the CRUD actions for Peraturan model.
 */
class VerifikasiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Peraturan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DokumenJdihSearch();
        /*
        $searchModel = new DokumenJdihSearch(['id'=>\Yii::$app->user->identity->direktorat_id]);
        $dataProvider->query->andWhere(['id'=>[2,3,4]]);
        */
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Peraturan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);

        $teu = new ActiveDataProvider([
            'query' => DataPengarang::find()->where(['id_dokumen' => $id]),
            'pagination' => ['pageSize' => 10]
        ]);

        $subyek = new ActiveDataProvider([
            'query' => DataSubyek::find()->where(['id_dokumen' => $id]),
            'pagination' => ['pageSize' => 10]
        ]);

        $lampiran = new ActiveDataProvider([
            'query' => DataLampiran::find()->where(['id_dokumen' => $id]),
            'pagination' => ['pageSize' => 10]
        ]);

        $peraturan = new ActiveDataProvider([
            'query' => PeraturanTerkait::find()->where(['id_dokumen' => $id]),
            'pagination' => ['pageSize' => 10]
        ]);

        $dokumen = new ActiveDataProvider([
            'query' => DokumenTerkait::find()->where(['id_dokumen' => $id]),
            'pagination' => ['pageSize' => 10]
        ]);

        $ujimateri = new ActiveDataProvider([
            'query' => HasilUjiMateri::find()->where(['id_dokumen' => $id]),
            'pagination' => ['pageSize' => 10]
        ]);

        $status = new ActiveDataProvider([
            'query' => DataStatus::find()->where(['id_dokumen' => $id]),
            'pagination' => ['pageSize' => 10]
        ]);

        $log = new ActiveDataProvider([
            'query' => LogPustakawan::find()->where(['dokumen_id' => $id]),
            'pagination' => ['pageSize' => 10]
        ]);

        $eksemplar = new ActiveDataProvider([
            'query' => Eksemplar::find()->where(['id_dokumen' => $id]),
            'pagination' => ['pageSize' => 10]
        ]);

        switch ($model->tipe_dokumen) {
            case '1':
                return $this->render('view-peraturan', [
                    'model' => $this->findModel($id),
                    'teu' => $teu,
                    'subyek' => $subyek,
                    'lampiran' => $lampiran,
                    'peraturan' => $peraturan,
                    'dokumen' => $dokumen,
                    'status' => $status,
                    'ujimateri' => $ujimateri,
                    'log' => $log,

                ]);
                break;


            case '2':
                return $this->render('view-monografi', [
                    'model' => $this->findModel($id),
                    'teu' => $teu,
                    'subyek' => $subyek,
                    'lampiran' => $lampiran,
                    'peraturan' => $peraturan,
                    'dokumen' => $dokumen,
                    'status' => $status,
                    'ujimateri' => $ujimateri,
                    'log' => $log,
                    'eksemplar' => $eksemplar,

                ]);


                break;

            case '3':
                return $this->render('view-artikel', [
                    'model' => $this->findModel($id),
                    'teu' => $teu,
                    'subyek' => $subyek,
                    'lampiran' => $lampiran,
                    'peraturan' => $peraturan,
                    'dokumen' => $dokumen,
                    'status' => $status,
                    'ujimateri' => $ujimateri,
                    'log' => $log,

                ]);
                break;

            case '4':
                return $this->render('view-putusan', [
                    'model' => $this->findModel($id),
                    'teu' => $teu,
                    'subyek' => $subyek,
                    'lampiran' => $lampiran,
                    'peraturan' => $peraturan,
                    'dokumen' => $dokumen,
                    'status' => $status,
                    'ujimateri' => $ujimateri,
                    'log' => $log,

                ]);
                break;
            default:

                return $this->render('view', [
                    'model' => $this->findModel($id),
                    'teu' => $teu,
                    'subyek' => $subyek,
                    'lampiran' => $lampiran,
                    'peraturan' => $peraturan,
                    'dokumen' => $dokumen,
                    'status' => $status,
                    'ujimateri' => $ujimateri,
                    'log' => $log,

                ]);
                break;
        }
    }

    public function actionInactive($id = null)
    {
        if ($id != null) {
            $model = $this->findModel($id);
            $model->is_publish = 0;
            if ($model->save()) {
                Yii::$app->session->setFlash('danger', 'Produk Hukum tidak  diverifikasi');
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
            }
        } else {
            $model = $this->findModel(\Yii::$app->user->identity->id);
            $model->is_publish = 0;
            $model->save();
            if ($model->save()) {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('success', 'Account inactive');
                return $this->goHome();
            }
        }
    }

    /**
     * Change is_publish user to Active
     * @param integer $id
     * @return mixed
     */
    public function actionActive($id)
    {
        $model = $this->findModel($id);
        $model->is_publish = 1;
        $model->save();
        Yii::$app->session->setFlash('success', 'Produk Hukum telah diverifikasi');
        return $this->redirect(['index']);
    }

    /**
     * Finds the DokumenJdih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DokumenJdih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPublishView($id)
    {
        /* @var $user User */
        $model = $this->findModel($id);
        if ($model->is_publish == 0) {
            $model->is_publish = 1;
            if ($model->save(false)) {
                // $log = new LogAktifitas();
                // $log->controller = Yii::$app->controller->id;
                // $log->action = Yii::$app->controller->action->id;
                // $log->user_id =   \Yii::$app->user->id;
                // $log->data_id  = $id;
                // $log->detail = 'user ' . \Yii::$app->user->identity->username . ' mempublish data Peraturan (<b>' . $model->judul . '</b>) pada tanggal ' . $model->getTanggal2(date("Y-m-d H:i:s"));

                // $log->save(false);
                Yii::$app->session->setFlash('success', 'Dokumen Hukum Berhasil dipublish');
                return $this->redirect(['view', 'id' => $id]);
            } else {
                $errors = $model->firstErrors;
                throw new UserException(reset($errors));
            }
        }
    }

    public function actionUnpublishView($id)
    {
        /* @var $user User */
        $model = $this->findModel($id);
        if ($model->is_publish == 1) {
            $model->is_publish = 0;
            if ($model->save(false)) {
                // $log = new LogAktifitas();
                // $log->controller = Yii::$app->controller->id;
                // $log->action = Yii::$app->controller->action->id;
                // $log->user_id =   \Yii::$app->user->id;
                // $log->data_id  = $id;
                // $log->detail = 'user ' . \Yii::$app->user->identity->username . ' Mempublish data Peraturan (<b>' . $model->judul . '</b>) pada tanggal ' . $model->getTanggal2(date("Y-m-d H:i:s"));

                // $log->save(false);
                Yii::$app->session->setFlash('success', 'Dokumen Berhasil dinonaktifkan');
                return $this->redirect(['view', 'id' => $id]);
            } else {
                $errors = $model->firstErrors;
                throw new UserException(reset($errors));
            }
        }
    }
    protected function findModel($id)
    {
        if (($model = DokumenJdih::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
