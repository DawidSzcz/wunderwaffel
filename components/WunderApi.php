<?php


namespace app\components;

use yii\httpclient\Client;
use yii\base\BaseObject;
use yii\httpclient\Response;

class WunderApi extends BaseObject
{
    public $url;
    public $result_field;

    /**
     * @var Client
     */
    private $http_client;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->http_client = new Client();
    }

    public function registerClient(string $userId, string $iban, string $owner) : string
    {
        $data = [
            "customerId" => $userId,
            "iban" => $iban,
            "owner" => $owner
        ];
        /** @var $response Response*/
        $response = $this->http_client->createRequest()
            ->setUrl($this->url)
            ->setMethod('POST')
            ->setFormat(Client::FORMAT_JSON)
            ->setData($data)
            ->send();

        return $response->getData()[$this->result_field];
    }
}