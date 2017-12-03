<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property string $text
 * @property integer $author_id
 * @property integer $question_id
 * @property string $publication_date
 *
 * @property User $author
 * @property Question $question
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'question_id', 'author_id'], 'required'],
            [['text'], 'string'],
            [['author_id', 'question_id'], 'integer'],
            [['publication_date'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * Vote up get count
     * @return int|string
     */
    public function getVotedUpCount()
    {
        return AnswerVoteSearch::find()->where(['answer_id' => $this->id, 'position' => AnswerVote::VOTE_UP])->count();
    }

    /**
     * Vote up get count
     * @return int|string
     */
    public function getVotedDownCount()
    {
        return AnswerVoteSearch::find()->where(['answer_id' => $this->id, 'position' => AnswerVote::VOTE_DOWN])->count();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text' => Yii::t('app', 'Text'),
            'author_id' => Yii::t('app', 'Author ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'publication_date' => Yii::t('app', 'Publication Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * Get User Voted
     * @return false|null|string
     */
    public function userVoted()
    {
        if (!Yii::$app->user->isGuest)
            return AnswerVote::find()->select(['position'])->where(['author_id' => Yii::$app->user->id, 'answer_id' => $this->id])->scalar();
        return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
}
