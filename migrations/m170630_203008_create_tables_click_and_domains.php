<?php

use yii\db\Migration;

class m170630_203008_create_tables_click_and_domains extends Migration
{
    protected $click      = '{{%click}}';
    protected $badDomains = '{{%bad_domains}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->click, [
            'id' => $this->string()->unique(),
            'ua' => $this->string(),
            'ip' => $this->string(),
            'ref' => $this->string(),
            'param1' => $this->string(),
            'param2' => $this->string(),
            'error' => $this->integer()->defaultValue(0),
            'bad_domain' => $this->integer()->defaultValue(0),
        ], $tableOptions);

        $this->createTable($this->badDomains, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->click);
        $this->dropTable($this->badDomains);
    }
}
