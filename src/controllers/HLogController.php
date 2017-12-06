<?php

namespace yiier\humansLog\controllers;

use Yii;
use yiier\humansLog\models\HLogSearch;
use yii\web\Controller;

/**
 * HLogController implements the CRUD actions for HLog model.
 */
class HLogController extends Controller
{
    /**
     * Lists all HLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
