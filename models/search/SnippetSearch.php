<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Snippet;

/**
 * SnippetSearch represents the model behind the search form about `app\models\Snippet`.
 */
class SnippetSearch extends Snippet {
    public function rules() {
        return [
            [['id'], 'integer'],
            [['title', 'code', 'description','pre_tags'], 'safe'],
        ];
    }

    public function scenarios() {
        return Model::scenarios();
    }

    public function indexSearch($q)
    {
        $query = Snippet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        #TODO: set alias instant `tbl_snippet`
        $query->select('tbl_snippet.*');

        $query->andFilterWhere(['like', 'tbl_snippet.title', $q])
              ->orFilterWhere(['like', 'code', $q])
              ->orFilterWhere(['like', 'description', $q]);

        $query->joinWith('tags')->orFilterWhere(['like', 'tbl_tag.title', $q]);

        return $dataProvider;
    }

    public function search($params) {
        $query = Snippet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'code', $this->code])
                ->andFilterWhere(['like', 'description', $this->description]);
        
        if($this->pre_tags)
        {
            $query->joinWith('tags')->where(['like', 'tbl_tag.title', $this->pre_tags]);
        }
        

        return $dataProvider;
    }

}
