<?php

use yii\db\Migration;

/**
 * Class m190715_052451_add_triggers_to_db
 */
class m190715_052451_add_triggers_to_db extends Migration
{
    public function up(){
        $command = "
        CREATE OR REPLACE FUNCTION details_insert()
        RETURNS TRIGGER AS \$ins$
            BEGIN
            INSERT INTO body (car_id) VALUES (NEW.id);
            INSERT INTO engine (car_id) VALUES (NEW.id);
            INSERT INTO transmission (car_id) VALUES (NEW.id);
            INSERT INTO wheel (car_id) VALUES (NEW.id);
            INSERT INTO wheel (car_id) VALUES (NEW.id);
            INSERT INTO wheel (car_id) VALUES (NEW.id);
            INSERT INTO wheel (car_id) VALUES (NEW.id);
            RETURN NULL;
        END;
        \$ins$ LANGUAGE plpgsql";
        $trigger = "
        CREATE TRIGGER car_insert AFTER INSERT on car
            FOR EACH ROW EXECUTE PROCEDURE details_insert();";

        $this->execute($command);
        $this->execute($trigger);
    }
    public function down(){
        $this->execute('DROP TRIGGER IF EXISTS car_insert ON car;');
        $this->execute('DROP FUNCTION details_insert();');
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
        echo "m190715_052451_add_triggers_to_db cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190715_052451_add_triggers_to_db cannot be reverted.\n";

        return false;
    }
    */
}
