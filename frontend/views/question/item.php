<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = $model->id;
$this->params['breadcrumbs'] = [];
?>


<div class="well question-view">
    <div class="small pull-right"><?= Html::encode($model->publication_date); ?></div>
    <div class="question-author"><span class="glyphicon glyphicon-user" aria-hidden="true" data-id="<?=Html::encode($model->id);?>"></span><?= Html::encode($model->author->username); ?>
        <span class="badge answers-count"><?= Html::encode(count($model->answers)); ?></span>
    </div>
    <p class="lead question-text">
        <?= Html::a(Html::encode($model->text), yii\helpers\Url::to(['question/view', 'id' => $model->id], ['class' => 'question-link'])); ?>
    </p>
</div>
