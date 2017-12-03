<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AnswerVote */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Answer Vote',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Answer Votes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="answer-vote-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
