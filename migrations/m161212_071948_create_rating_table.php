<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rating`.
 */
class m161212_071948_create_rating_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%eg_rating}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(32),
            'cookie' => $this->string(512),
            'item_id' => $this->integer(11),
            'service_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'rating' => $this->float()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%eg_rating}}');
    }
}
