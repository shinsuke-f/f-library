<?php

require_once './simple_html_dom.php';

/*
 * 外部のページのhtml情報をスクレイピングしてパースする
 */

$url = "http://www.universal-music.co.jp/hkt48/news/";

$html = file_get_contents($url);
$dom_sample = str_get_html($html);
//時間取得
foreach ($dom_sample->find('.contain') as $el) {
    echo $el->find("time", 0, true);
}

