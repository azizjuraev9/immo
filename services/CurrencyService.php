<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 19.10.2020
 * Time: 20:18
 */

namespace app\services;

use app\models\Currency;
use app\models\CurrencySearch;
use Yii;
use yii\console\Controller;
use yii\httpclient\Client;

class CurrencyService
{

    const RECOURSE_URL = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public function updateCurrency()
    {
        $client = new Client();

        /**
         * @var \yii\httpclient\Response $response
         */
        $response = $client->createRequest()
            ->setUrl(self::RECOURSE_URL)
            ->send();

        if (!$response->isOk) {
            return false;
        }

        $fields = [
            'name',
            'code',
            'rate',
        ];

        $data = [];

        foreach ($response->data['Valute'] as $valute)
        {

            if (Yii::$app->controller instanceof Controller)
            {
                echo $valute['Nominal'] . ' ';
                echo $valute['Name'] . ' ';
                echo '(' . $valute['CharCode'] . ') = ';
                echo $valute['Value'] . ' RUB' . PHP_EOL;
            }

            $data[] = [
                $valute['Name'],
                $valute['CharCode'],
                (float)$valute['Value'] / (float)$valute['Nominal'],
            ];
        }

        $db = Yii::$app->db;
        $db->createCommand()->truncateTable(Currency::tableName());

        $transaction = $db->beginTransaction();
        echo $db->createCommand()
            ->batchInsert(
                Currency::tableName(),
                $fields,
                $data
            )
            ->execute();

        $transaction->commit();

        return true;
    }

    public function getPageCurrencies($params,$page_size = 3)
    {
        $model = new CurrencySearch();
        $dataProvider = $model->search($params);
        $models = $dataProvider->getModels();

        return $models;

    }

}