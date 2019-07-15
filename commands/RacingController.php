<?php


namespace app\commands;


use app\models\Car;
use yii\console\Controller;

class RacingController extends Controller
{
    public function actionIndex(){
        $cars = Car::find()->all();
        if ($cars == null) {
            echo "Машины кончились";
            return 0;
        }
        foreach ($cars as $car) {
            $isalive = false;
            $deadwheel = rand(0,3);
            $eng = $car->getEngines()->one();
            $bod = $car->getBodies()->one();
            $tra = $car->getTransmissions()->one();
            $wheels = $car->getWheels()->all();

            foreach ([$eng, $bod, $tra] as $item) {
                $hp = $item->hp;
                $hp = $hp - rand(5, 15);
                if ($hp <= 0)
                    $hp = 0;
                else
                    $isalive = true;
                $item->hp = $hp;
            }

            foreach ($wheels as $wheel) {
                $hp = $wheel->hp;
                $hp = $hp - rand(5, 15);
                if($deadwheel!=0) $deadwheel-=1;
                else {
                    $deadwheel-=1;
                    $hp = 0;
                }
                if ($hp <= 0) $hp = 0;
                else $isalive = true;
                $wheel->hp = $hp;
            }

            if ($isalive == false) {
                foreach ([$eng, $bod, $tra] as $item) $item->delete();
                foreach ($wheels as $wheel) $wheel->delete();
                $car->delete();
            }
            else {
                foreach ([$eng, $bod, $tra] as $item) $item->save();
                foreach ($wheels as $wheel) $wheel->save();
                $car->race_count +=1;
                $car->save();
            }
        }
    }

}