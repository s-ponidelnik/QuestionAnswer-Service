<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.12.2017
 * Time: 19:09
 */

namespace frontend\components\widget\AnswerWidget;

use common\models\Answer;
use frontend\components\widget\AnswerWidget\AnswerWidgetAsset;
use yii\base\Widget;

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;

class AnswerWidget extends Widget
{
    public $question_id;

    public function init()
    {
        AnswerWidgetAsset::register($this->getView());
        parent::init();
    }

    public function run()
    {

        $query = Answer::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere([
            'question_id' => $this->question_id,
        ]);
        $query->orderBy(['publication_date'=>SORT_DESC]);
        return ListView::widget([
            'summary'=>'',
            'dataProvider' => $dataProvider,
            'itemView' => '..\..\components\widget\AnswerWidget\question_answers',
            'emptyText' => Html::tag('span',\Yii::t('app','Have no answers yet'),['class'=>'text-muted']),
        ]);
    }
}