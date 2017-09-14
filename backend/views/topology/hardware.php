<?php
/**
 * Created by PhpStorm.
 * User: OOM-Administrator
 * Date: 2017/9/13
 * Time: 16:34
 */
/* @var $this yii\web\View */

$this->title = '硬件结构图';
?>
<div class="hardware">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h5 class="box-title">惠通时代新楼机房</h5>
                    <div class="box-tools pull-right">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        <span class="label label-primary">No.1</span>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    The body of the box
                </div><!-- /.box-body -->
                <div class="box-footer">
                    The footer of the box
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h5 class="box-title">汇通时代老楼机房</h5>
                    <div class="box-tools pull-right">
                        <span class="label label-primary">No.2</span>
                    </div>
                </div>
                <div class="box-body">
                    The body of the box
                </div>
                <div class="box-footer">
                    The footer of the box
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            foreach ($graphs as $graph)
                echo $graph->graphid . "\n";
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
            foreach ($cpuGraphs as $graph)
                printf("id:%d name:%s\n", $graph->graphid, $graph->name);
            ?>
        </div>
        <div class="col-md-6"></div>
    </div>

</div>