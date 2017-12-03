<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Answer */

?>
<div class="question-answers well small-well">
    <span class="answer-author-username"><span class="glyphicon glyphicon-user" aria-hidden="true"
                                               data-id="<?= Html::encode($model->id); ?>"></span><?= Html::encode($model->author->username) ?></span>
    <?php $userVoted = $model->userVoted(); ?>
    <span class="small pull-right"><?= Html::encode($model->publication_date); ?></span>
    <p class="lead question-text"><?= Html::encode($model->text); ?></p>
    <span class="clearfix"></span>
    <div class="answer-vote-box">
        <span class="vote-up-btn" data-id="<?= Html::encode($model->id); ?>">
        <span class="glyphicon glyphicon-thumbs-up btn vote-up <?= ($userVoted == \common\models\AnswerVote::VOTE_UP) ? 'active' : ''; ?>"
              aria-hidden="true"></span><span
                    class="badge voted-up-count"><?= Html::encode($model->votedUpCount); ?></span>
        </span>
        <span class="vote-down-btn" data-id="<?= Html::encode($model->id); ?>">
        <span class="glyphicon glyphicon-thumbs-down btn vote-down <?= ($userVoted == \common\models\AnswerVote::VOTE_DOWN) ? 'active' : ''; ?>"
              aria-hidden="true"></span>
            <span class="badge voted-down-count"><?= Html::encode($model->votedDownCount); ?></span>
        </span>

    </div>
    <span class="clearfix"></span>
</div>
