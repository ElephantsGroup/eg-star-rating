<?php

namespace elephantsGroup\starRating\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use elephantsGroup\starRating\models\Rating;
use yii\web\Cookie;

class Rate extends Widget
{
    public $min_num = 1;
    public $max_num = 5;
    public $rate_num = 0;
	public $language;
    public $service;
    public $item;
    public $view_file = 'rate';

	public function init()
	{
		if(!isset($this->language) || !$this->language)
			$this->language = Yii::$app->language;
        if(!isset($this->item) || !$this->item)
            $this->item = 0;
        if(!isset($this->service) || !$this->service)
            $this->service = 0;
        if(!isset($this->rate_num) || !$this->rate_num)
            $this->rate_num = 0;
        if(!isset($this->view_file) || !$this->view_file)
            $this->view_file = Yii::t('like', 'View File');
	}

    public function run()
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

        $user_id = (int) Yii::$app->user->id;

        if(Yii::$app->user->isGuest)
            $is_rating = Rating::find()->where(['item_id' => $this->item, 'service_id' => $this->service, 'cookie' => $cookies->getValue('visitor')])->one();
        else
            $is_rating = Rating::find()->where(['item_id' => $this->item, 'service_id' => $this->service, 'user_id' => $user_id])->one();

        $this->rate_num = $is_rating['rating'];

        return $this->render($this->view_file, [
            'min_num' => $this->min_num,
            'max_num' => $this->max_num,
            'rate_num' => $this->rate_num,
            'item' => $this->item,
            'service' => $this->service,
        ]);
	}
}