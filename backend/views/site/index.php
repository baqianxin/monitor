<?php

/* @var $this yii\web\View */

$this->title = 'Monitor Center';
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">


            <div class="col-md-12">
                <?php
                var_dump(json_encode($hosts));
                foreach ($hosts as $host) {

                }
                ?>

            </div>
            <div class="col-md-12">
                <?php
                foreach ($users as $user) {
                    var_dump(json_encode($user));
                }
                ?>

            </div>
        </div>
    </div>
</div>
