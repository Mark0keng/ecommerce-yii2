<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image-->
        <a href="">
            <img class="card-img-top" style="width = 600px;" src="<?= $model->getImageUrl() ?>" alt="..." />
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
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Check More</a></div>
        </div>
    </div>
</div>