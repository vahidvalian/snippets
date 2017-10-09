<?php

use yii\db\Migration;

class m170203_141729_snippet_type extends Migration
{
    public function up()
    {
        $this->createTable(
            'tbl_snippet_type',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(255)->notNull(),
                'mode' => $this->text()->notNull(),
            ]
        );
    }

    public function down()
    {
        $this->dropTable('tbl_snippet_type');

        return false;
    }
}
