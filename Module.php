<?php

namespace elephantsGroup\starRating;

/*
	Module statistics for Yii 2
	Authors : Jalal Jaberi
	Website : http://elephantsgroup.com
	Revision date : 2016/07/09
*/

use Yii;

class Module extends \yii\base\Module
{
    // public $defaultRoute = 'admin';
    // make a problem, when is not logged and request like url, it asks for username and passwrod, then
    // visitor know this action exists but not allowed
    // TODO: try to solve this problem

    public function init()
    {
        parent::init();

        if (empty(Yii::$app->i18n->translations['rating']))
		{
            Yii::$app->i18n->translations['rating'] =
			[
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
                //'forceTranslation' => true,
            ];
        }
    }

    public static function t($message, $params = [], $language = null)
    {
        return \Yii::t('rating', $message, $params, $language);
    }
}
