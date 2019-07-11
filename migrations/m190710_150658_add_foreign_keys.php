<?php

use yii\db\Migration;

/**
 * Class m190710_150658_add_foreign_keys
 */
class m190710_150658_add_foreign_keys extends Migration
{
    public function up(){
        $this->addForeignKey('car_id_fk','{{%Body}}','car_id','{{%Car}}','id');
        $this->addForeignKey('car_id_fk','{{%Wheel}}','car_id','{{%Car}}','id');
        $this->addForeignKey('car_id_fk','{{%Engine}}','car_id','{{%Car}}','id');
        $this->addForeignKey('car_id_fk','{{%Transmission}}','car_id','{{%Car}}','id');


    }
    public function down()
    {
        $this->dropForeignKey('car_id_for_body','Body');
        $this->dropForeignKey('car_id_for_wheels','Wheel');
        $this->dropForeignKey('car_id_for_body','Engine');
        $this->dropForeignKey('car_id_for_body','Transmission');


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
        echo "m190710_150658_add_foreign_keys cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190710_150658_add_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
