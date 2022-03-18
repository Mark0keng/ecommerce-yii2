<div class="card">
    <div class="card-header">
        Cart Items
    </div>

    <div class="card-body p-0">

        <table class="table table-hover">
            <thead>
                <th class="text-center">Product</th>
                <th class="text-center">Image</th>
                <th class="text-center">Unit Price</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Total Price</th>
                <th class="text-center">Action</th>
            </thead>
            <tbody>
                <?php foreach($cartItems as $item) : ?>
                <tr>
                    <td class="align-middle text-center"><?= $item['name'] ?></td>
                    <td class="text-center">
                        <img src="<?= \common\models\Product::formatImageUrl($item['image']) ?>" style="height: 50px;">
                    </td>
                    <td class="align-middle text-center"><?= 'Rp. ' . $item['price'] ?></td>
                    <td class="align-middle text-center"><?= $item['quantity'] ?></td>
                    <td class="align-middle text-center"><?= 'Rp. ' . $item['price'] * $item['quantity'] ?></td>
                    <td class="align-middle text-center">
                        <?= \yii\helpers\Html::a('Delete', ['/cart/delete', 'id' => $item['id']], [
                            'class' => 'btn btn-outline-danger btn-sm',
                            'data_method' => 'post',
                            'data-confirm' => 'Remove this product?'
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        
        <?php if(empty($item)): ?>
            <p class="text-muted text-center">There are no items in the cart</p>
        <?php else: ?>
            <div class="card-body text-right">
            <a href="<?= \yii\helpers\Url::to(['/cart/checkout']) ?>" class="btn btn-primary">Checkout</a>
        </div>
        <?php endif; ?>

    </div>
</div>
