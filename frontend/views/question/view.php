<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use frontend\components\widget\AnswerWidget\AnswerWidget;
/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = $model->text;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-view">


    <span class="small"><span class="glyphicon glyphicon-user" aria-hidden="true" data-id="<?=Html::encode($model->id);?>"></span><?= Html::encode($model->author->username); ?></span>
    <span class="small pull-right"><?= Html::encode($model->publication_date); ?></span>
    <div class="lead">
        <?= Html::encode($this->title) ?></div>
    </br>
    <?=AnswerWidget::widget(['question_id' => $model->id]); ?>

    <p>
        <?php if (!Yii::$app->user->isGuest) { ?>
        <?php $form = ActiveForm::begin(['action' =>['answer/create'], 'method' => 'post',]);?>
        <?= $form->field(new \common\models\Answer(), 'text')->textarea(['rows' => 6]); ?>
        <?=$form->field(new \common\models\Answer(),'question_id')->hiddenInput(['value'=>$model->id])->label(false);?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']);?>
        </div>
        <?php ActiveForm::end(); ?>

        <?php } ?>
    </p>

</div>
