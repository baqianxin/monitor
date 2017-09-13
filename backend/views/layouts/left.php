<?php

use mdm\admin\components\MenuHelper;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/favicon.ico" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Oom</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php
        $callback = function ($menu) {
            $data = json_decode($menu['data'], true);
            $items = $menu['children'];
            $return = [
                'label' => $menu['name'],
                'url' => [$menu['route']],
            ];
            if ($data) {
                //visible
                isset($data['visible']) && $return['visible'] = $data['visible'];
                //icon
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                //other attribute e.g. class...
                $return['options'] = $data;
            }
            //没配置图标的显示默认图标
            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'circle-o';
            $items && $return['items'] = $items;
            return $return;
        };
        $items = MenuHelper::getAssignedMenu(Yii::$app->user->id, '', $callback);

        $items = array_merge([['label' => 'Menu Monitor', 'options' => ['class' => 'header']]], $items);
        echo dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => $items,
        ]);
        ?>
    </section>

</aside>
