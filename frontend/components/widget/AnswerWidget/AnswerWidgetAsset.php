<?php

namespace frontend\components\widget\AnswerWidget;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AnswerWidgetAsset extends AssetBundle
{
    public $sourcePath = '@app/components/widget/AnswerWidget';
    public $css = [
        'question_answers_widget.css',
    ];
    public $js = [
        'question_answers_widget.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
