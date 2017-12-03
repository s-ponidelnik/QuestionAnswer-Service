<?php

use yii\db\Migration;

/**
 * Class m171203_150219_answerVote
 */
class m171203_150219_answerVote extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('answer_vote', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'answer_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull(),
            'vote_date' => $this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP'))
        ], $tableOptions);

        $this->addForeignKey('answer_vote_author_id_user_id_rel', 'answer_vote', 'author_id', 'user', 'id');
        $this->addForeignKey('answer_vote_id_answer_id_rel', 'answer_vote', 'answer_id', 'answer', 'id');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('answer_vote_id_answer_id_rel', 'answer_vote');
        $this->dropForeignKey('answer_vote_author_id_user_id_rel', 'answer_vote');
        $this->dropTable('answer_vote');
    }

}
