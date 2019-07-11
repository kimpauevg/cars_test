<?php

use yii\db\Migration;

/**
 * Class m190710_135343_add_tables_to_database
 */
class m190710_135343_add_tables_to_database extends Migration
{
    public function up(){
        $this->createTable('car',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull()->unique(),
            'race_count'=>$this->integer()->defaultValue(0)
        ]);
        $this->createTable('engine',[
            'id'=>$this->primaryKey(),
            'car_id'=>$this->integer()->notNull(),
            'hp'=>$this->integer()->defaultValue(100)
        ]);
        $this->createTable('wheel',[
            'id'=>$this->primaryKey(),
            'car_id'=>$this->integer()->notNull(),
            'hp'=>$this->integer()->defaultValue(100)
        ]);
        $this->createTable('transmission',[
            'id'=>$this->primaryKey(),
            'car_id'=>$this->integer()->notNull(),
            'hp'=>$this->integer()->defaultValue(100)
        ]);
        $this->createTable('body',[
            'id'=>$this->primaryKey(),
            'car_id'=>$this->integer()->notNull(),
            'hp'=>$this->integer()->defaultValue(100)
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190710_135343_add_tables_to_database cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190710_135343_add_tables_to_database cannot be reverted.\n";

        return false;
    }
    */
}
