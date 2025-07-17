<?php

// ==========================================================
//  Copyright Reserved Wael Wael Abo Hamza (Course Ecommerce)
// ==========================================================

// echo date_default_timezone_get("Africa/Cairo");

define("MB", 1048576);

function filterRequest($requestname)
{
  return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getAllData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    if($where == null){
        $stmt = $con->prepare("SELECT  * FROM $table ");
    }else{
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    }
    
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json == true ){
 if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    return $count;
    }
 else{
        if ($count > 0){
            return  array("status" => "success", "data" => $data);
        } else {
            return array("status" => "failure");
        }
    }
   
  
}
 
function getData($table, $where = null, $values = null,$json = true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    
    if($json== true){
        if ($count > 0){
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }else{
        return $count;
    }
}

function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
  }
    return $count;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}
// function updateData($table, $data, $where, $json = true)
// {
//     global $con;
//     $cols = array();
//     $vals = array();

//     foreach ($data as $key => $val) {
//         $vals[] = "$val";
//         $cols[] = "`$key` =  ? ";
//     }
//     $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

//     $stmt = $con->prepare($sql);
//     $stmt->execute($vals);
//     $count = $stmt->rowCount();
//     if ($json == true) {
//     if ($count > 0) {
//         echo json_encode(array("status" => "success"));
//     } else {
//         echo json_encode(array("status" => "failure"));
//     }
//     }
//     return $count;
// }

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload($dir,$imageRequest)
{
  global $msgError;
  if(isset($_FILES[$imageRequest]['tmp_name'])){
    $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
  $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
  $imagesize  = $_FILES[$imageRequest]['size'];
  $allowExt   = array("jpeg", "png", "gif", "mp3", "pdf","svg","JPEG", "PNG","SVG");
  $strToArray = explode(".", $imagename);
  $ext        = end($strToArray);
  $ext        = strtolower($ext);

  if (!empty($imagename) && !in_array($ext, $allowExt)) {
    $msgError = "EXT";
  }
  if ($imagesize > 2 * MB) {
    $msgError = "size";
  }
  if (empty($msgError)) {
    move_uploaded_file($imagetmp,  $dir . $imagename);
    return $imagename;
  } else {
    return "fail";
  }
  }else {
    return "empty";
  }
  
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "wael" ||  $_SERVER['PHP_AUTH_PW'] != "wael12345") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }

    // End 
}
function sendEmail($to ,$title , $body){
    
    $header="From: somia.elhalabey@gmail.com ";
    mail($to ,$title ,$body, $header);
 } 
function printFailure($massege="none"){
    echo  json_encode(array("status" => "Failure","massege" => $massege));
} 
function printSuccess($massege="none"){
    echo  json_encode(array("status" => "success","massege" => $massege));
} 
function result($count){
    if($count > 0){
        printSuccess();
     } else {
         printFailure();     
     }
} 



function sendNotification($topic, $body, $title) {
    $endPointFirebaseCloudMessaging = "https://fcm.googleapis.com/v1/projects/ecommerce-26c75/messages:send";
    
    $message = [
        "message" => [
            "topic" => $topic,
            "notification" => [
                "body" => $body,
                "title" => $title
            ]
        ]
    ];
    
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer '
    ];

    $ch = curl_init($endPointFirebaseCloudMessaging);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

//
// function sendGCM($title, $message, $topic, $pageid, $pagename)
// {


//     $url = 'https://fcm.googleapis.com/fcm/send';

//     $fields = array(
//         "to" => '/topics/' . $topic,
//         'priority' => 'high',
//         'content_available' => true,

//         'notification' => array(
//             "body" =>  $message,
//             "title" =>  $title,
//             "click_action" => "FLUTTER_NOTIFICATION_CLICK",
//             "sound" => "default"

//         ),
//         'data' => array(
//             "pageid" => $pageid,
//             "pagename" => $pagename
//         )

//     );


//     $fields = json_encode($fields);
//     $headers = array(
//         'Authorization: key=' . "",
//         'Content-Type: application/json'
//     );

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

//     $result = curl_exec($ch);
//     return $result;
//     curl_close($ch);
// }