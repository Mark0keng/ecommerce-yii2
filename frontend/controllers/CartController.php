<?php

namespace frontend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductQuery;
use common\models\CartItem;
use common\models\query\CartItemQuery;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CartController extends Controller
{ 
    public function behaviors() {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['add'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON 
                ]
            ]
            ];
    }

    public function actionIndex() {
        $query = new \yii\db\Query();
        $userId = Yii::$app->user->id;
        $userStatus = Yii::$app->user->isGuest;

        if($userStatus == true){
            // get session
            return $this->redirect(['site/login']);
        } else{
            $cartItems = $query->select([
                                    'products.id',
                                    'cart_items.product_id',
                                    'products.image',
                                    'products.name',
                                    'products.price',
                                    'cart_items.quantity',
                                    'cart_items.created_by',
                                    ])
                                ->from(['cart_items'])
                                ->join('LEFT JOIN', 'products', 'products.id = cart_items.product_id')
                                ->where('cart_items.created_by = :userId', [':userId' => $userId])
                                ->limit(10)
                                ->all();

                            return $this->render('index', [ 
                                'cartItems' => $cartItems
                            ]);
        }
    }

    public function actionAdd(){
        $id = \Yii::$app->request->post('id');
        $product = Product::findOne(['id' => $id, 'status' => 1]);

        if(!$product){
            throw new NotFoundHttpException('Product not Found');
        }

        if(\Yii::$app->user->isGuest){
            
        } 
        else {
            $userId = \Yii::$app->user->id;

            $cartItems = new CartItem();
            $cartItems = CartItem::find()->userId($userId)->productId($id)->one();

            if($cartItems){
                $cartItems->quantity++;

                if ($cartItems->save()){
                    Yii::$app->session->setFlash('success', "Item has added to cart!");
                    return $this->redirect(['/site/index', 'success' => true]);
                } else {
                    return [
                        'success' => false,
                        'errors' => $cartItem->errors
                    ];
                }
            } 
            else{
                $cartItems = new CartItem();
                $cartItems ->product_id = $id;
                $cartItems->created_by = $userId;
                $cartItems->quantity = 1;

                if ($cartItems->save()){
                    Yii::$app->session->setFlash('success', "Item has added to cart!");
                    return $this->redirect(['/site/index', 'success' => true]);
                } else {
                    return [
                        'success' => false,
                        'errors' => $cartItem->errors
                    ];
                }
            }
        }
    } 

    public function actionDelete($id){
        CartItem::deleteAll(['product_id' => $id, 'created_by' => \Yii::$app->user->id]);

        return $this->redirect(['index']);
    }
}