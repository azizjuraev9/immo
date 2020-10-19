<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 19.10.2020
 * Time: 22:10
 */
namespace app\controllers;

use app\models\Currency;
use app\models\CurrencySearch;
use app\services\CurrencyService;
use yii\base\Module;
use yii\web\Response;

class CurrenciesController extends \yii\rest\Controller
{

    /**
     * @var CurrencyService
     */
    private $currencyService;

    public function __construct(
        $id,
        Module $module,
        array $config = [],
        CurrencyService $currencyService
    )
    {
        parent::__construct($id, $module, $config);
        $this->currencyService = $currencyService;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] =
        [
            'application/json' => Response::FORMAT_JSON
        ] ;
        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->currencyService->getPageCurrencies([],3);
    }

    public function actionView($id)
    {
        return Currency::findOne($id);
    }

}