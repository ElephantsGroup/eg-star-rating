<?php

namespace elephantsGroup\starRating\controllers;

use Yii;
use elephantsGroup\starRating\controllers\BaseAjaxController;
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
class AjaxController extends BaseAjaxController
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

    public function additionalFeatureVote($service_id, $item_id, $user_id, $rating, $is_new, $old_rate)
    {

    }
}
