<?php

/* @var $this yii\web\View */
use common\models\Product;
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="container px-4 px-lg-5 mt-5">

        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '<div class="m-4">{summary}</div><div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">{items}</div>{pager}',
            'itemView' => '_product_item',
            // 'options' => [
                // 'class' => 'row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'
            // ],
            'itemOptions' => [
                'class' => 'col mb-5'
            ],
            'pager' => [
                'class' => \yii\bootstrap4\LinkPager::class
            ]
        ]) ?>
        
    </div>
    </div>
</div>
