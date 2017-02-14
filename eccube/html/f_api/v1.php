<?php
define("FRONT_API_FLAG", 1);
require_once '../require.php';
$content_type = filter_input(INPUT_SERVER, 'CONTENT_TYPE');
$method_seccess = true;

try{
    if (!isset($content_type) || false === strpos($content_type, 'application/json')) {
      $err_msg = SC_Utils_Ex::serialize_base64_encode(array("err_message" => "JSON形式で送信してください。"));
      throw new Exception($err_msg, 400);
    } else {
        header('Content-Type: application/json', true, 201);
        $result = json_decode(file_get_contents('php://input'), true);
        //デコードがオブジェクトで返却されたら配列に変更する
        if(is_object($result)){
            $result = get_object_vars($result);
        }
        if(isset($result['api']) && isset($result['method'])){
            $api_class = 'SC_Api_' . $result["api"] . '_Ex';
            $method_name = $result["method"];
            $filePath = CLASS_EX_REALDIR . 'api_extends/frontview/' . $api_class . '.php';
            if(file_exists($filePath)){
                require_once $filePath;
                $objClass =  new $api_class();
                $methodVariable = array($objClass, $method_name);
                $arrClassMethods = get_class_methods($objClass);
                if(in_array($method_name, $arrClassMethods)){
                    $response = $objClass->$method_name($result);
                } else {
                    $err_msg = SC_Utils_Ex::serialize_base64_encode(array("err_message" => "指定したClassまたはメソッドが存在しません。"));
                    throw new Exception($err_msg, 400);
                }
            } else {
                $err_msg = SC_Utils_Ex::serialize_base64_encode(array("err_message" => "指定したClassまたはメソッドが存在しません。"));
                throw new Exception($err_msg, 400);
            }
        } else {
            $err_msg = SC_Utils_Ex::serialize_base64_encode(array("err_message" => "apiコードまたはメソッドが空です。"));
            throw new Exception($err_msg, 400);
        }
    }
} catch (Exception $ex) {
    $method_seccess = false;
    $errCode = $ex->getCode();
    $response = SC_Utils_Ex::unserialize_base64_decode($ex->getMessage());
}

if(!$method_seccess){
    switch($errCode){
        case 400:
            header("HTTP/1.1 {$errCode} Bad Request");
            break;
        case 403:
            header("HTTP/1.1 {$errCode} Forbidden");
            break;
        case 404:
            header("HTTP/1.1 {$errCode} Not Found");
            break;
        case 500:
            header("HTTP/1.1 {$errCode} Internal Server Error");
            break;
        case 503:
            header("HTTP/1.1 {$errCode} Service Unavailable");
            break;
        case 504:
            header("HTTP/1.1 {$errCode} Gateway Time-out");
            break;
        default :
            header("HTTP/1.1 {$errCode}");
    }
    //レスポンスにsuccessが入っていない場合success=0を入れる
    if(!isset($response["success"])){
        $response = array_merge(array("success" => 0), $response);
    }
} else {
    //レスポンスにsuccessが入っていない場合success=1を入れる
    if(!isset($response["success"])){
        $response = array_merge(array("success" => 1), $response);
    }
    header('HTTP/1.1 200 OK');
}

// success以外のレスポンス項目はresultフィールド内にセットする
$arrResult = array();
$arrResult = $response;
unset($arrResult["success"]);
$arrSuccess = $response["success"];
$response = array();
$response["success"] = $arrSuccess;
$response["result"] = $arrResult;


header("Content-Type: application/json; charset=utf-8");
echo json_encode($response,JSON_UNESCAPED_UNICODE);

