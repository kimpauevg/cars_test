<?php


namespace app\commands;


use app\models\Body;
use app\models\Car;
use app\models\Engine;
use app\models\Transmission;
use app\models\Wheel;
use yii\base\ErrorException;
use yii\console\Controller;
use yii\db\Migration;
use yii\helpers\Json;
use Yii;

class LogicController extends Controller
{
    public function actionGet($id){
        $car = Car::findOne($id);
        if ($car==null) { echo ("Нет такой машины"); return;}
        $body = $car->getBodies()->one();
        $trans = $car->getTransmissions()->one();
        $eng = $car->getEngines()->one();
        $wheels = $car->getWheels()->all();
        if($body==null || $trans==null||$eng==null||$wheels==null) {echo 'Машине не хватает деталей'; return;}


        $json = array(
           'name'=>$car->name,
           'engine'=>$eng->hp,
            'transmission' => $trans->hp,
            'body'=>$body->hp,
            'wheel'=>[
                "0"=>$wheels[0]->hp,
                "1"=>$wheels[1]->hp,
                "2"=>$wheels[2]->hp,
                "3"=>$wheels[3]->hp,
            ]
        );
        echo json_encode($json);


    }
    public function actionPost($name){
        $create = new Migration();

        try {
            $create->insert('Car',['name'=>$name]);
        } catch (\Exception $exception){
            echo $exception->getMessage();
            return 1;
        }
        $car = Car::find()
            ->orderBy(['(id)'=>SORT_DESC])
            ->one();

        $create->insert('{{%Body}}',
            [
                'car_id'=> $car->id
            ]
        );
        $create->insert('{{%Transmission}}',
            [
                'car_id'=> $car->id
            ]
        );
        $create->insert('{{%Engine}}',
            [
                'car_id'=> $car->id
            ]
        );
        for ($i = 0; $i < 4;$i++) {
            $create->insert('{{%Wheel}}',
                [
                    'car_id' => $car->id
                ]
            );
        }
    }


    public function actionPostpgsql($name){
        Yii::$app->db->createCommand("INSERT INTO {{%Car}} (name) VALUES ('{$name}')")->execute();
        $car = Yii::$app->db->createCommand("SELECT * FROM {{%Car}} ORDER BY id DESC")->queryOne();//Извлечение последней записи

        foreach ($car as $item){
            if ($item!=0 && is_numeric($item)) {
                $car = $item;
                break;
            }
        }
        Yii::$app->db->createCommand("INSERT INTO {{%Body}} (car_id) VALUES ($car)")->execute();
        Yii::$app->db->createCommand("INSERT INTO {{%Engine}} (car_id) VALUES ($car)")->execute();
        Yii::$app->db->createCommand("INSERT INTO {{%Transmission}} (car_id) VALUES ($car)")->execute();
        for ($i=0;$i<4;$i++) Yii::$app->db->createCommand("INSERT INTO {{%Wheel}} (car_id) VALUES ($car)")->execute();

    }
    public function actionResetpkeys(){


    }

}