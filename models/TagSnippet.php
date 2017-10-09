<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tag_snippet}}".
 *
 * @property integer $snippet_id
 * @property integer $tag_id
 *
 * @property Tag $tag
 * @property Snippet $snippet
 */
class TagSnippet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tag_snippet}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['snippet_id', 'tag_id'], 'required'],
            [['snippet_id', 'tag_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'snippet_id' => 'Snippet ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSnippet()
    {
        return $this->hasOne(Snippet::className(), ['id' => 'snippet_id']);
    }
}
