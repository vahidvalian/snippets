<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_snippet_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $mode
 */
class SnippetType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_snippet_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'mode'], 'required'],
            [['mode'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'mode' => 'Mode',
        ];
    }
}
