<?php

use yii\db\Migration;

/**
 * Handles the creation of table `humans_log`.
 */
class m171206_064455_create_humans_log_table extends Migration
{
    /**
     * 创建表选项
     * @var string
     */
    public $tableOptions = null;
    /**
     * 是否事务性存储表, 则创建为事务性表. 默认不使用
     * @var bool
     */
    public $useTransaction = true;

    public function init()
    {
        parent::init();
        if ($this->db->driverName === 'mysql') { //Mysql 表选项
            $engine = $this->useTransaction ? 'InnoDB' : 'MyISAM';
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=' . $engine;
        }
    }

    public function up()
    {
        $this->createTable('{{%h_log_template}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('标题'),
            'unique_id' => $this->string()->notNull()->comment('唯一标识 action uniqueId 或者 model class'),
            'template' => $this->string()->notNull()->comment('模板'),
            'method' => $this->smallInteger()->notNull()->defaultValue(1)->comment('请求方式 1 insert 2 view 3 update 4 delete'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态 0暂停 1开启'),
            'created_at' => $this->integer()->unsigned()->defaultValue(null),
            'updated_at' => $this->integer()->unsigned()->defaultValue(null),
        ], $this->tableOptions);
        $this->createIndex('fk_unique_id_method', '{{%h_log_template}}', ['unique_id', 'method'], true);
        $this->addCommentOnTable('{{%h_log_template}}', '日志模板表');

        $this->createTable('{{%h_log}}', [
            'id' => $this->primaryKey(),
            'h_log_template_id' => $this->integer()->unsigned()->defaultValue(null)->comment('日志模板ID'),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('用户ID'),
            'username' => $this->string()->defaultValue(null)->comment('用户名'),
            'log' => $this->string()->notNull()->comment('日志'),
            'created_at' => $this->integer()->unsigned()->defaultValue(null),
        ], $this->tableOptions);
        $this->createIndex('fk_user_id', '{{%h_log}}', 'user_id');
        $this->addCommentOnTable('{{%h_log}}', '日志表');
    }

    public function down()
    {
        echo "m171206_064455_create_humans_log_table cannot be reverted.\n";
        $this->dropTable('{{%h_log_template}}');
        $this->dropTable('{{%h_log}}');
        return false;
    }
}
