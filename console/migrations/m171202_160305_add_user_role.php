<?php

use yii\db\Migration;

/**
 * Class m171202_160305_add_user_role
 */
class m171202_160305_add_user_role extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('user','isAdmin',$this->smallInteger(1)->defaultValue(null));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('user','isAdmin');
    }
}
