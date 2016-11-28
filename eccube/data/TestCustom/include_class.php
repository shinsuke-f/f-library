<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of include_class
 *
 * @author s.fujikawa
 */

//カスタマイズのクラスを定義する

define("CUSTOM_DIR", __DIR__);

//
$arrDirs = scandir(CUSTOM_DIR);
foreach($arrDirs as $dirName){
    if(($dirName != "." && $dirName != "..") && is_dir(CUSTOM_DIR . "/" . $dirName)){
        require_once CUSTOM_DIR . "/" . $dirName . "/" . $dirName . ".php";
    }
}

class include_class {
    function createCutomeObj(&$objPage){

        $arrDirs = scandir(CUSTOM_DIR);
        foreach($arrDirs as $className){
            if(($className != "." && $className != "..") && is_dir(CUSTOM_DIR . "/" . $className)){
                $objName = "obj_" . $className;
                $objPage->$objName = new $className();
            }
        }

    }
}
