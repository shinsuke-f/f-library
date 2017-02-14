<?php

require_once CLASS_EX_REALDIR . 'module_extends/SC_Module_Customer_Ex.php';

/**
 * Description of SC_Api_Customer
 *
 * @author s.fujikawa
 */
class SC_Api_Customer {

    /**
     * ログイン処理
     * @param type $post
     * @return type
     */
    function login($post){
        $objFormParam = new SC_FormParam_Ex();
        $objModule = new SC_Module_Customer_Ex();
        $objModule->lfInitParam($objFormParam, __FUNCTION__);
        $objFormParam->setParam($post);
        $arrErr = $objModule->lfCheckError($objFormParam, __FUNCTION__);

        if(count($arrErr) == 0){
            $customerInfo = $objModule->getCustomerDataApi($objFormParam->getValue("user_id"), $objFormParam->getValue("password"));
            if($customerInfo){
                $customerInfo["user_id"] = $objFormParam->getValue("user_id");
                return $customerInfo;
            } else {
                $err_msg = SC_Utils_Ex::serialize_base64_encode(array("err_message" => "IDもしくはパスワードが正しくありません。"));
                throw new Exception($err_msg, 400);
            }
        } else {
            $err_msg = SC_Utils_Ex::serialize_base64_encode(array("err_message" => "入力値に誤りがあります。" , "validate_errors" => $arrErr));
            throw new Exception($err_msg, 400);
        }
    }

}
