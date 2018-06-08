<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m180608_190833_add_star_rating_management
 */
class m180608_190833_add_star_rating_management extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$db = \Yii::$app->db;
		$query = new Query();
        if ($db->schema->getTableSchema("{{%auth_item}}", true) !== null)
		{
			if (!$query->from('{{%auth_item}}')->where(['name' => '/star-rating/admin/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/star-rating/admin/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'star_rating_management'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'star_rating_management',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'star_rating_manager'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'star_rating_manager',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'administrator'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'administrator',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_item_child}}", true) !== null)
		{
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'star_rating_management', 'child' => '/star-rating/admin/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'star_rating_management',
					'child'		=> '/star-rating/admin/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'star_rating_manager', 'child' => 'star_rating_management'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'star_rating_manager',
					'child'		=> 'star_rating_management'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'administrator', 'child' => 'star_rating_manager'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'administrator',
					'child'		=> 'star_rating_manager'
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_assignment}}", true) !== null)
		{
			if (!$query->from('{{%auth_assignment}}')->where(['item_name' => 'administrator', 'user_id' => 1])->exists())
				$this->insert('{{%auth_assignment}}', [
					'item_name'	=> 'administrator',
					'user_id'	=> 1,
					'created_at' => time()
				]);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		// it's not safe to remove auth data in migration down
    }
}
