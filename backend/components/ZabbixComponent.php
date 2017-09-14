<?php
/**
 * Created by PhpStorm.
 * User: kist
 * Date: 17.03.15
 * Time: 15:05
 */

namespace backend\components;

use yii\base\Component;
use yii\base\Exception;
use yii\base\UnknownPropertyException;
use yii\base\InvalidCallException;
use ZabbixApi\ZabbixApi;

/**
 * Class Zabbix
 * @package backend\components
 */
class ZabbixComponent extends Component
{
    /**
     * @var ZabbixApi
     */
    private $_zabbixObject;

    /**
     * @var array
     */
    private $_params;

    private $_user;
    private $_password;
    private $_apiUrl;


    public function setApiUrl($apiUrl)
    {
        $this->_apiUrl = $apiUrl;
    }

    public function getApiUrl()
    {
        return $this->_apiUrl;
    }

    public function setUser($user)
    {
        $this->_user = $user;
    }

    public function getUser()
    {

        return $this->_user;

    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Auth params
     *
     * @param array $param
     */
    public function setParams($param)
    {
        $this->_params = $param;
    }

    /**
     * @return array|mixed
     * ($apiUrl='', $user='', $password='', $httpUser='', $httpPassword='', $authToken='', $sslContext=NULL)
     */
    public function getParams()
    {
        return $this->_params;
    }

    public function getZabbixObject()
    {
        if ($this->_zabbixObject === null) {
            $param = $this->getParams();
            $this->_zabbixObject = new ZabbixApi($param['apiUrl']);
        }
        return $this->_zabbixObject;
    }

    /**
     * ($apiUrl='', $user='', $password='', $httpUser='', $httpPassword='', $authToken='', $sslContext=NULL)
     * @throws \Exception
     */
    public function init()
    {
        try {
            $params = $this->getParams();
            $this->getZabbixObject()->userLogin(['user' => $params['user'], 'password' => $params['password']]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param string $methodName
     * @param array $methodParams
     * @return mixed
     */
    public function __call($methodName, $methodParams)
    {
        if (method_exists($this->getZabbixObject(), $methodName)) {
            return call_user_func_array(array($this->getZabbixObject(), $methodName), $methodParams);
        }
    }

    /**
     * @param string $name
     * @return mixed
     * @throws UnknownPropertyException
     */
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this->getZabbixObject(), $getter)) {
            return $this->getZabbixObject()->$getter();
        } elseif (method_exists($this, $getter)) {
            return parent::__get($name);
        } elseif (method_exists($this, 'set' . $name)) {
            throw new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
        } else {
            throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws UnknownPropertyException
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this->getZabbixObject(), $setter)) {
            $this->getZabbixObject()->$setter($value);
        } elseif (method_exists($this, $setter)) {
            parent::__set($name, $value);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidCallException('Setting read-only property: ' . get_class($this) . '::' . $name);
        } else {
            throw new UnknownPropertyException('Setting unknown property: ' . get_class($this) . '::' . $name);
        }
    }
}