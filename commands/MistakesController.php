<?php


namespace app\commands;



use yii\console\Controller;
use yii\db\Migration;

class MistakesController extends Controller
{
    public function actionFix1(){
        $migr = new Migration();
        $migr->alterColumn('{{%Car}}','name', $migr->text()->unique()->notNull());
    }
    /*public function actionFix2(){
        $migr = new Migration();
        $migr->dropTable('Car');
        $migr->dropTable('Engine');
        $migr->dropTable('Wheel');
        $migr->dropTable('')
    }*/
}