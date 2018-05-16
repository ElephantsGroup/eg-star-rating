<?php

namespace elephantsGroup\starRating\models;

use Yii;

/**
 * This is the model class for table "{{%eg_rating}}".
 *
 * @property integer $id
 * @property string $ip
 * @property integer $item_id
 * @property integer $service_id
 * @property integer $user_id
 * @property integer $rating
 * @property string $update_time
 * @property string $creation_time
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eg_rating}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip', 'cookie'], 'trim'],
            [['item_id', 'service_id', 'user_id', 'rating'], 'integer'],
            [['update_time', 'creation_time'], 'date', 'format'=>'php:Y-m-d H:i:s'],
            [['ip'], 'string', 'max' => 32],
            [['cookie'], 'string', 'max' => 512],
            [['rating'], 'default', 'value' => 0],
            [['update_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['creation_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $base_module = Yii::$app->getModule('base');
        return [
            'id' => $base_module::t('ID'),
            'ip' => $base_module::t('IP'),
            'cookie' => $base_module::t('Cookie'),
            'item_id' => $base_module::t('Item ID'),
            'service_id' => $base_module::t('Service ID'),
            'user_id' => $base_module::t('User ID'),
            'rating' => $base_module::t('Rating'),
            'update_time' => $base_module::t('Update Time'),
            'creation_time' => $base_module::t('Creation Time'),
        ];
    }

    public function beforeSave($insert)
    {
        $date = new \DateTime();
        $date->setTimestamp(time());
        $date->setTimezone(new \DateTimezone('Iran'));
        $this->update_time = $date->format('Y-m-d H:i:s');
        if($this->isNewRecord)
            $this->creation_time = $date->format('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }
    

    /**
     * @inheritdoc
     * @return RatingQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new RatingQuery(get_called_class());
    }*/
}
