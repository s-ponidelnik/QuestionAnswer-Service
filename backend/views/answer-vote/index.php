<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnswerVoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Answer Votes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-vote-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'author_id',
            'answer_id',
            'position' => [
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->position == \common\models\AnswerVote::VOTE_DOWN)
                        return HTML::tag('span', '', ['class' => 'glyphicon glyphicon-thumbs-down']);
                    elseif ($model->position == \common\models\AnswerVote::VOTE_UP)
                        return HTML::tag('span', '', ['class' => 'glyphicon glyphicon-thumbs-up']);
                }
            ],
            'vote_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
