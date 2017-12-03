<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "answer_vote".
 *
 * @property integer $id
 * @property integer $author_id
 * @property integer $answer_id
 * @property integer $position
 * @property string $vote_date
 *
 * @property User $author
 * @property Answer $answer
 */
class AnswerVote extends \yii\db\ActiveRecord
{

    const VOTE_UP = 1;/*vote up*/
    const VOTE_DOWN = 2;/*vote down*/

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer_vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'answer_id'], 'required'],
            [['author_id', 'answer_id', 'position'], 'integer'],
            [['vote_date'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::className(), 'targetAttribute' => ['answer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'answer_id' => Yii::t('app', 'Answer ID'),
            'position' => Yii::t('app', 'Position'),
            'vote_date' => Yii::t('app', 'Vote Date'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answer::className(), ['id' => 'answer_id']);
    }
}
