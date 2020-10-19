<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 19.10.2020
 * Time: 21:53
 */

namespace app\commands;


use app\services\CurrencyService;
use yii\base\Module;
use yii\console\Controller;

class CurrencyController extends Controller
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

    public function actionImport()
    {
        $this->currencyService->updateCurrency();
    }

}