<?php

use yii\db\Migration;

/**
 * Class m200214_121740_update_h_log_table
 */
class m200214_121740_update_h_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("{{%h_log}}", 'fk',
            $this->string(100)->comment('外键')->defaultValue('')->after('h_log_template_id')
        );
        $this->alterColumn("{{%h_log}}", 'username',
            $this->string(100)->defaultValue(null)->comment('用户名')
        );
        $this->createIndex('fk_h_log_template_id_fk', '{{%h_log}}', ['h_log_template_id', 'fk']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200214_121740_update_h_log_table cannot be reverted.\n";
        $this->alterColumn("{{%h_log}}", 'username',
            $this->string()->defaultValue(null)->comment('用户名')
        );
        $this->dropIndex('fk_h_log_template_id_fk', '{{%h_log}}');
        $this->dropColumn("{{%h_log}}", 'fk');
        return true;
    }
}
