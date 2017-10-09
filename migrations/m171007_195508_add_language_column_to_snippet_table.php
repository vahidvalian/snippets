<?php

use yii\db\Migration;

/**
 * Handles adding language to table `snippet`.
 */
class m171007_195508_add_language_column_to_snippet_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('tbl_snippet', 'language', 'VARCHAR(128) DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('tbl_snippet', 'language');
    }
}
