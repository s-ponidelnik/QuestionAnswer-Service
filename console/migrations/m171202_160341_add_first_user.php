<?php

use yii\db\Migration;

/**
 * Class m171202_160341_add_first_user
 */
class m171202_160341_add_first_user extends Migration
{
    public function safeUp()
    {
        $this->insert('user', [
                'username' => 'admin',
                'password_hash' => Yii::$app->security->generatePasswordHash('111111'),
                'email' => 'test@mail.com',
                'auth_key' => Yii::$app->security->generateRandomString(),
                'created_at' => time(),
                'updated_at' => time(),
                'isAdmin' => '1'
            ]
        );
    }

    public function safeDown()
    {
        $this->delete('user', [
            'username' => 'admin',
            'email' => 'test@mail.com'
        ]);
    }
}
