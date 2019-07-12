<?php


namespace app\controllers;


use app\models\Car;
use Yii;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class CarController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'post' => ['post'],
                    'index'=>['get','post']
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }
    public function actionIndex(){
        $req = Yii::$app->request;
        //return $this->render('index');

       if ($req->getIsGet()){

            $id = $req->getQueryParam('id');
            if ($id == null) return $this->render('index',['json' => "Дайте Id"]);
            $json = $this->get($id);
            if ($json == null) return $this->renderContent('Нет такой машины');
            $this->layout = false;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderContent($json);
        }
        if ($req->getIsPost()) {
            $ans = $this->postpgsql($req->post('name'));
            return $this->render('index',['json'=> $ans]);
        }
        return $this->render('index');

    }


    public function postpgsql($name){
        try {
            Yii::$app->db->createCommand("INSERT INTO {{%Car}} (name) VALUES ('{$name}')")->execute();
        } catch ( \Exception $exception){
            return $exception->getMessage();
        }
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
        return "Response:Ok";
    }
    public function get($id){
        $car = Car::findOne($id);
        if ($car==null) { return ("Нет такой машины"); }
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
        return $json;


    }

    public function actionCreate(){
        $name = null;
        return $this->render('create',['name'=>$name]);


    }


}