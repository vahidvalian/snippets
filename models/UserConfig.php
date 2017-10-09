<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user_config".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $serialize_config
 *
 * @property User $user
 */
class UserConfig extends \yii\db\ActiveRecord
{
    public $default_language;
    public $ace_default_mode;
    public $ace_default_theme;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'serialize_config'], 'required'],
            [['user_id'], 'integer'],
            [['serialize_config'], 'string'],

            [['ace_default_mode', 'ace_default_theme', 'default_language'], 'string'],

            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'serialize_config' => 'Serialize Config',
            'ace_default_mode' => 'Default Mode'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getModes()
    {
        return SnippetType::find()->all();
    }

    public function getThemes()
    {
        return [
            'ambiance' => 'ambiance',
            'chaos' => 'chaos',
            'chrome' => 'chrome',
            'clouds' => 'clouds',
            'clouds_midnight' => 'clouds_midnight',
            'cobalt' => 'cobalt',
            'crimson_editor' => 'crimson_editor',
            'dawn' => 'dawn',
            'dreamweaver' => 'dreamweaver',
            'eclipse' => 'eclipse',
            'github' => 'github',
            'idle_fingers' => 'idle_fingers',
            'iplastic' => 'iplastic',
            'katzenmilch' => 'katzenmilch',
            'kr_theme' => 'kr_theme',
            'kuroir' => 'kuroir',
            'merbivore' => 'merbivore',
            'merbivore_soft' => 'merbivore_soft',
            'mono_industrial' => 'mono_industrial',
            'monokai' => 'monokai',
            'pastel_on_dark' => 'pastel_on_dark',
            'solarized_dark' => 'solarized_dark',
            'solarized_light' => 'solarized_light',
            'sqlserver' => 'sqlserver',
            'terminal' => 'terminal',
            'textmate' => 'textmate',
            'tomorrow' => 'tomorrow',
            'tomorrow_night_blue' => 'tomorrow_night_blue',
            'tomorrow_night_bright' => 'tomorrow_night_bright',
            'tomorrow_night_eighties' => 'tomorrow_night_eighties',
            'tomorrow_night' => 'tomorrow_night',
            'twilight' => 'twilight',
            'vibrant_ink' => 'vibrant_ink',
            'xcode' => 'xcode'
        ];
    }
}
