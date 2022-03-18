<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image-->
        <a href="">
            <img class="card-img-top" src="<?= $model->getImageUrl() ?>" alt="..." />
        </a>

        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <a href="">
                    <h5 class="fw-bolder"><?= $model->name ?></h5>
                </a>
                <!-- Product price-->
                <?= 'Rp.' . $model->price ?>
            </div>
        </div>
        <!-- Product actions-->
        <div class="desc text-center mx-3 mb-3">
            <?= \yii\helpers\StringHelper::truncateWords(strip_tags($model->description), 10) ?>
        </div>

        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
                <a class="btn btn-outline-dark btn-sm mt-auto m-2" href="#">Check More</a>
                <a href="<?php echo \yii\helpers\Url::to(['/cart/add']) ?>" class="btn btn-primary btn-add-to-cart">
                    Add to Cart
                </a>
            </div>

        </div>
    </div>
</div>