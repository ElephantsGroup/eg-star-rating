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

        $this->insert('{{%auth_item}}', [
            'name' => '/star-rating/admin/*',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => 'rating_management',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'rating_management',
            'child' => '/star-rating/admin/*',
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => 'rating_manager',
            'type' => 1,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'rating_manager',
            'child' => 'rating_management',
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'super_admin',
            'child' => 'rating_manager',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'super_admin',
            'child' => 'rating_manager',
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'rating_manager',
            'child' => 'rating_management',
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => 'rating_manager',
            'type' => 1,
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'rating_management',
            'child' => '/star-rating/admin/*',
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => 'rating_management',
            'type' => 2,
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => '/star-rating/admin/*',
            'type' => 2,
        ]);
        $this->dropTable('{{%eg_rating}}');
    }
}
