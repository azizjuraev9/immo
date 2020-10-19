<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 19.10.2020
 * Time: 23:23
 */

namespace app\controllers;


use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SiteController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] =
            [
                'application/json' => Response::FORMAT_JSON
            ] ;
        return $behaviors;
    }

    public function actionError()
    {
        return [];
    }
}