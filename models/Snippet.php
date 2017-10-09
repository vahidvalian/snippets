<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%snippet}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $description
 *
 * @property TagSnippet[] $tagSnippets
 * @property Tag[] $tags
 */
class Snippet extends \yii\db\ActiveRecord {

    public $pre_tags;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%snippet}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'code', 'pre_tags','language'], 'required'],
            [['code', 'description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['pre_tags'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'pre_tags' => Yii::t('app', 'Tags'),
            'code' => 'Code',
            'description' => 'Description',
            'language' => 'Language',
        ];
    }

    public function afterSave($insert, $changedAttributes) {


        $tags = explode(",", $this->pre_tags);

        if(!$insert) {
            foreach($this->tagSnippets as $tag) {
                $tag->delete();
            }
        }

        foreach ($tags as $tag) {
            $model = Tag::findOne(['title' => $tag]);
            if ($model === NULL) {
                $model = new Tag();
                $model->attributes = ['title' => $tag];
                $model->save();
            }
            $relation = new TagSnippet();
            $relation->attributes = [
                'snippet_id' => $this->id,
                'tag_id' => $model->id
            ];

            $relation->save();
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete() {

        if ($this->tagSnippets) {
            foreach ($this->tagSnippets as $tagSnippets) {
                $tagSnippets->delete();
            }
        }

        return parent::beforeDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagSnippets() {
        return $this->hasMany(TagSnippet::className(), ['snippet_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags() {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%tag_snippet}}', ['snippet_id' => 'id']);
    }

    public function getTagArray() {
        $data = [];
        if ($this->tags) {
            
            foreach ($this->tags as $tags) {
                $data[] = $tags->title;
            }
        }

        return $data;
    }
    
    public function getTagString() {
        if($this->tagArray) {
            return implode(",", $this->tagArray);
        }

        return "";
    }

}
