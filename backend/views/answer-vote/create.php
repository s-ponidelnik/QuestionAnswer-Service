<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AnswerVote */

$this->title = Yii::t('app', 'Create Answer Vote');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Answer Votes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-vote-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
