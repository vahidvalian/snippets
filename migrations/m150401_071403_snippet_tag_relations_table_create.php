<?php

use yii\db\Schema;
use yii\db\Migration;

class m150401_071403_snippet_tag_relations_table_create extends Migration
{
    public function up()
    {
        $this->createTable('tbl_tag', [
            'id' => 'pk',
            'title' => 'string not null',
        ]);
        
        $this->createTable('tbl_snippet', [
            'id' => 'pk',
            'title' => 'string not null',
            'code' => 'text not null',
            'description' => 'text default null',
        ]);
        
        $this->createTable('tbl_tag_snippet', [
            'snippet_id' => 'int not null',
            'tag_id' => 'int not null',
        ]);
        
        $this->addPrimaryKey('pk_tag_snippet', 'tbl_tag_snippet', 'snippet_id,tag_id');
        
        $this->addForeignKey('fk_tag_snippet_snippet', 'tbl_tag_snippet', 'snippet_id', 'tbl_snippet', 'id');
        $this->addForeignKey('fk_tag_snippet_tag', 'tbl_tag_snippet', 'tag_id', 'tbl_tag', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_tag_snippet_tag', 'tbl_tag_snippet');
        $this->dropForeignKey('fk_tag_snippet_snippet', 'tbl_tag_snippet');
        
        $this->dropPrimaryKey('pk_tag_snippet', 'tbl_tag_snippet');
        
        $this->dropTable('tbl_tag_snippet');
        $this->dropTable('tbl_snippet');
        $this->dropTable('tbl_tag');
    }
}
