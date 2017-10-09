<?php

use yii\db\Migration;


class m170121_193026_create_tbl_user extends Migration
{
    public function up()
    {
        $this->createTable(
            'tbl_user',
            [
                'id' => $this->primaryKey(),
                'email' => $this->string(255)->notNull(),
                'auth_key' => $this->text()->notNull(),
                'password' => $this->string(32)->notNull(),
                'created' => $this->integer()->notNull(),
                'updated' => $this->integer()->notNull(),
                'is_active' => $this->integer()->defaultValue(0)
            ]
        );
    }

    public function down()
    {
        $this->dropTable('tbl_user');
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
