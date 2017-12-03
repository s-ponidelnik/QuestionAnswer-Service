<?php

use yii\db\Migration;

/**
 * Class m171202_154318_question_answer_rel
 */
class m171202_154318_question_answer_rel extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addForeignKey('answer_author_id_user_id_rel', 'answer', 'author_id', 'user', 'id');
        $this->addForeignKey('answer_question_id_question_id_rel', 'answer', 'question_id', 'question', 'id');
        $this->addForeignKey('question_author_id_user_id_rel', 'question', 'author_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('question_author_id_user_id_rel', 'question');
        $this->dropForeignKey('answer_question_id_question_id_rel', 'answer');
        $this->dropForeignKey('answer_author_id_user_id_rel', 'answer');

    }
}
