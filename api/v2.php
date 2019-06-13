<?php
require_once('../inc/conn.php');

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

if(!isset($data)){echo "Connection be with post method"; exit();}


if (isset($data->key)) {

  $key = $data->key;

  $apikey=$db->prepare("SELECT * FROM users where apikey=:apikey");
  $apikey->execute(array(
    'apikey' => $key
  ));
  $count=$apikey->rowCount();

  if($count==0){
    echo json_encode(array("error"=>"Invalid API key"));
    exit();
  }

  if (isset($data->action)) {
    $action = $data->action;
    //Actions if
    if($action=="services"){
      $array = array();
      $services=$db->prepare("SELECT * FROM services where enable=:enable");
      $services->execute(array(
        'enable' => 1
      ));

      while($takeService=$services->fetch(PDO::FETCH_ASSOC)){

        $category=$db->prepare("SELECT * FROM category where id=:id");
        $category->execute(array(
          'id' => $takeService['category_id']
        ));
        $takeCategory=$category->fetch(PDO::FETCH_ASSOC);

        $array[] = array(
          "service"=>(int)$takeService['id'],
          "name"=>$takeService['name'],
          "type"=>$takeService['type'],
          "rate"=>$takeService['money'],
          "min"=>$takeService['min'],
          "max"=>$takeService['max'],
          "category"=>$takeCategory['name']
        );
      }

      echo json_encode($array,JSON_UNESCAPED_UNICODE);
    }

    if($action=="add"){

      if(!isset($data->service)){
        echo json_encode(array("error"=>"ServiceID not found"));
        exit();
      }

      if(!isset($data->link)){
        echo json_encode(array("error"=>"Link not found"));
        exit();
      }
      if(!isset($data->quantity)){
        echo json_encode(array("error"=>"Quantity not found"));
        exit();
      }

      $service=$db->prepare("SELECT * FROM services where id=:id");
      $service->execute(array(
        'id' => $data->service
      ));
      $count=$service->rowCount();

      if($count==0){
        echo json_encode(array("error"=>"Service not found"));
        exit();
      }

      $takeService=$service->fetch(PDO::FETCH_ASSOC);


        if($data->quantity < $takeService['min']){
          echo json_encode(array("error"=>"Quantity must be minimum ".$takeService['min']));
          exit();
        }

        if($data->quantity > $takeService['max']){
          echo json_encode(array("error"=>"Quantity must be maksimum ".$takeService['max']));
          exit();
        }

        $money = $takeService['money']/1000;
        $cost = $data->quantity * $money;

        $takeInfo=$apikey->fetch(PDO::FETCH_ASSOC);

        if($takeInfo['balance']<$cost){
          echo json_encode(array("error"=>"Your balance is insufficient"));
          exit();
        }

        $kaydet=$db->prepare("INSERT INTO orders SET
        service=:service,
        count=:count,
        cost=:cost,
        link=:link,
        user_id=:user_id
        ");
        $insert=$kaydet->execute(array(
        'service' => $data->service,
        'count' => $data->quantity,
        'cost' => $cost,
        'link' => $data->link,
        'user_id' => $takeInfo['id']
        ));
        if($insert){
          $userMoney=$takeInfo['balance']-$cost;

          $duzenle=$db->prepare("UPDATE users SET
          balance=:balance
          WHERE id={$takeInfo['id']}");
          $update=$duzenle->execute(array(
          'balance' => $userMoney
          ));
          if ($duzenle) {
            $services=$db->prepare("SELECT * FROM orders where service=:service and count=:count and cost=:cost and link=:link and user_id=:user_id");
            $services->execute(array(
              'service' => $data->service,
              'count' => $data->quantity,
              'cost' => $cost,
              'link' => $data->link,
              'user_id' => $takeInfo['id']
            ));
            $takeService=$services->fetch(PDO::FETCH_ASSOC);
            echo json_encode(array("order"=>$takeService['id']));
          }else{
            echo json_encode(array("error"=>"Please try again!"));
          }
        }else{
          echo json_encode(array("error"=>"Please try again!"));
        }

    }


    if($data->action=="status"){



      if(!isset($data->order)){
        echo json_encode(array("error"=>"OrderID not found"));
        exit();
      }

      $user=$db->prepare("SELECT * FROM users where apikey=:apikey");
      $user->execute(array(
        'apikey' => $data->key
      ));
      $takeUserInfo = $user->fetch(PDO::FETCH_ASSOC);
      $user_id = $takeUserInfo['id'];

      $orderArray = explode(",", $data->order);

      if(count($orderArray)>1){


        for($i=0;$i<count($orderArray);$i++){

          $orders=$db->prepare("SELECT * FROM orders where id=:id and user_id=:user_id");
          $orders->execute(array(
            'id' => $orderArray[$i],
            'user_id' => $user_id
          ));
          $takeInfo=$orders->fetch(PDO::FETCH_ASSOC);
          $count=$orders->rowCount();

          if($count==0){

            $array[] = array($orderArray[$i]=>array("error"=>"Incorrect order ID"));
          }else{
            $array[] = array($takeInfo['id']=>array(
              "charge"=> $takeInfo['cost'],
              "start_count"=> "StartCount",
              "status"=> $takeInfo['stats'],
              "remains"=> "Remains",
              "currency"=> "TRY"
            ));
          }


        }
        echo json_encode($array,JSON_UNESCAPED_UNICODE);


      }else{
        $orders=$db->prepare("SELECT * FROM orders where id=:id and user_id=:user_id");
        $orders->execute(array(
          'id' => $orderArray[$i],
          'user_id' => $user_id
        ));
        $count=$orders->rowCount();

        if($count==0){
          echo json_encode(array("error"=>"Incorrect order ID"));
          exit();
        }
        $takeInfo=$orders->fetch(PDO::FETCH_ASSOC);
        $array = array(
          "charge"=> $takeInfo['cost'],
          "start_count"=> "StartCount",
          "status"=> $takeInfo['stats'],
          "remains"=> "Remains",
          "currency"=> "TRY"
        );

       echo json_encode($array,JSON_UNESCAPED_UNICODE);
      }



    }


    if($data->action=="balance"){
      $takeInfo=$apikey->fetch(PDO::FETCH_ASSOC);
      echo json_encode(array('balance' => $takeInfo['balance'],'currency'=>"TRY"),JSON_UNESCAPED_UNICODE);
    }
  }
}


 ?>
