<?php
/**
 * Created by PhpStorm.
 * User: OOM-Administrator
 * Date: 2017/9/14
 * Time: 11:08
 */

namespace backend\models;

use backend\components\ZabbixComponent;
use yii\base\Component;

/**
 * Class Zabbix
 * @package backend\models
 * 调用zabbix api 接口model
 */
class Zabbix extends Component
{


    private $_zabbix;


    /**
     * @var array
     * ($apiUrl='',
     * $user='',
     * $password='',
     * $httpUser='',
     * $httpPassword='',
     * $authToken='',
     * $sslContext=NULL)
     */
    private $config = [
        'apiUrl' => 'http://12.15.0.39/zabbix/api_jsonrpc.php',
        'user' => 'Admin',
        'password' => 'zabbix',
        'params' => [
            'apiUrl' => 'http://12.15.0.39/zabbix/api_jsonrpc.php',
            'user' => 'Admin',
            'password' => 'zabbix'
        ]
    ];

    public function getZabbix()
    {
        return $this->_zabbix;
    }

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $zabbixComponent = new ZabbixComponent($this->config);
        $this->_zabbix = $zabbixComponent->getZabbixObject();
    }

}