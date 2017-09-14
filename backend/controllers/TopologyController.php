<?php
/**
 * Created by PhpStorm.
 * User: OOM-Administrator
 * Date: 2017/9/13
 * Time: 16:30
 */

namespace backend\controllers;


use backend\models\Zabbix;
use yii\web\Controller;

class TopologyController extends Controller
{


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     *   echo "hardware:硬件结构图";
     */
    public function actionHardware()
    {
        $zabbix = new Zabbix();
        $graphs = $zabbix->getZabbix()->graphGet();
        // get all graphs named "CPU"
        $cpuGraphs = $zabbix->getZabbix()->graphGet(array(
            'output' => 'extend',
            'search' => array('name' => 'CPU')
        ));

        return $this->render('hardware', ['graphs' => $graphs, 'cpuGraphs' => $cpuGraphs]);
    }

    /**
     * @return string
     *   echo "Network:网络拓扑图";
     */
    public function actionNetwork()
    {
        return $this->render('network');
    }

}