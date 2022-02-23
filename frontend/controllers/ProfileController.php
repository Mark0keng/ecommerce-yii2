<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class ProfileController extends Controller 
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update-address', 'update-account'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                  
                ],
            ],
           
        ];
    }
    public function actionIndex()
    {
        /** @var \common\models\User  $user */
        $user = Yii::$app->user->identity;
        $userAddresses = $user->addresses;
        $userAddress = $user->getAddress();
        return $this->render('index', [
            'user' => $user,
            'userAddress' => $userAddress
        ]);
    }

    public function actionUpdateAddress()
    {
         /** @var \common\models\User  $user */
         if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException("You are only allowed to make ajax");
        }
        $user = Yii::$app->user->identity;
        $userAddress = $user->getAddress();
        $success = false;
        if ($userAddress->load(Yii::$app->request->post()) && $userAddress->save()) {
            $success = true;
        }
        return $this->renderAjax('user_address', [
            'userAddress' => $userAddress,
            'success' => $success,
        ]);
    }

    public function actionUpdateAccount()
    {
         /** @var \common\models\User  $user */
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException("You are only allowed to make ajax");
        }
         $user = Yii::$app->user->identity;
        $success = false;
        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            $success = true;
        }
        return $this->renderAjax('user_account', [
            'user' => $user,
            'success' => $success,
        ]);
    }
}
?>