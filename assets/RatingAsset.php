<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace elephantsGroup\starRating\assets;

use yii\web\AssetBundle;
use yii\web\View;
use yii\web\JqueryAsset;

/**
 * 
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 2.0
 */
class RatingAsset extends AssetBundle
{
    public $sourcePath = '@vendor/elephantsgroup/yii2-star-rating/assets';
   
    public function init() {
        $this->jsOptions['position'] = View::POS_END;
        parent::init();
    }

	public $css = [
        'css/rating.css'
    ];
    public $js = [
		'js/rating.js',
		'js/eg-rating.js',
	];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
