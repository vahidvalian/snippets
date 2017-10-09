<?php

use yii\db\Migration;

class m170204_161657_create_tbl_user_config extends Migration
{
    public function up()
    {
        $this->createTable('tbl_user_config',[
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->notNull()->unsigned()->unique(),
            'serialize_config' => $this->text()->notNull(),
        ]);

        $this->addForeignKey('fk_user_config', 'tbl_user_config', 'user_id', 'tbl_user', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_config', 'tbl_user_config');
        $this->dropTable('tbl_user_config');

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
