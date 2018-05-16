<?php

namespace elephantsGroup\starRating\controllers;

use Yii;
use elephantsGroup\starRating\models\Rating;
use elephantsGroup\starRating\models\RatingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use elephantsGroup\base\EGController;
use yii\web\Cookie;

/**
 * RatingController implements the CRUD actions for Rating model.
 */
class AjaxController extends EGController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'vote' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Creates a new Rating model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionVote()
    {
        $star_rating_module = Yii::$app->getModule('star-rating');
        $response = [
            'status' => 500,
            'message' => $star_rating_module::t('Server problem')
        ];

        try
        {
            $cookies = Yii::$app->request->cookies;
            if(Yii::$app->user->isGuest)
            {
                if (!$cookies || !$cookies->getValue('visitor'))
                {
                    $cookies = Yii::$app->response->cookies;
                    $cookies->add(new Cookie([
                        'name' => 'visitor',
                        'value' => md5(time() . rand(1, 100)),
                        'expire' => (time() + (3600)),
                    ]));
                }
            }
            $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
            $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : 0;
            $rating = isset($_POST['rating']) ? $_POST['rating'] : 0;
            $user_id = Yii::$app->user->isGuest ? 0 : (int) Yii::$app->user->id;
            $ip = Yii::$app->request->userIP;
            $visitor_cookie = $cookies->getValue('visitor');

            if(Yii::$app->user->isGuest)
            {
                $rate = Rating::find()
                    ->where(['item_id' => $item_id, 'service_id' => $service_id, 'cookie' => $visitor_cookie])
                    ->one();
            }
            else
            {
                $rate = Rating::find()
                    ->where(['item_id' => $item_id, 'service_id' => $service_id, 'user_id' => $user_id ])
                    ->one();
            }


            if(!$rate)
            {
                $model = new Rating();
                $model->service_id = $service_id;
                $model->item_id = $item_id;
                $model->user_id = $user_id;
                $model->rating = $rating;
                $model->ip = $ip;
                $model->cookie = $visitor_cookie;

                if($model->save())
                    $response = [
                        'status' => 200,
                        'message' => $star_rating_module::t('Successful')
                    ];
                else
                    $response = [
                        'status' => 400,
                        'message' => $star_rating_module::t('Failed to save')
                    ];
            }
            else
            {
                $rate->rating = $rating;
                if ($rate->save())
                    $response = [
                        'status' => 200,
                        'message' => $star_rating_module::t('Changed vote')
                    ];
                else
                    $response = [
                        'status' => 400,
                        'message' => $star_rating_module::t('Failed to save')
                    ];
            }
        }
        catch(Exception $exp)
        {
            $response = [
                'status' => 500,
                'message' => $star_rating_module::t('Server problem')
            ];
        }
        return json_encode($response);
    }
}
