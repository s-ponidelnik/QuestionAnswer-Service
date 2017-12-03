<?php

use yii\db\Migration;

/**
 * Class m171202_150427_answer
 */
class m171202_150427_answer extends Migration
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

        $this->createTable('answer', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'author_id' => $this->integer()->defaultValue(null),
            'question_id' => $this->integer()->notNull(),
            'publication_date' => $this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP'))
        ], $tableOptions);


    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        $this->dropTable('answer');
    }
}
