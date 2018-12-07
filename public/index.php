<?php
header("Content-Type: text/html; charset=utf8"); 



//подключаем все библиотеки
require_once('../config/config.php');


//exec("mysql test5 < " . DATA_DIR . "test5.sql");
//die();
//получаем URL запроса к сайту и разбиваем его в массив url_array
$url_array = explode("/", $_SERVER['REQUEST_URI']);

//$calcVar1 =  (int) $_REQUEST['calcVar1'];
//$calcVar2 =  (int) $_REQUEST['calcVar2'];
//$calcOper = $_REQUEST['operation'];
//if (isset($_REQUEST['calcVar1']) && isset($_REQUEST['calcVar2'])) {
//    if (is_float($calcVar1) && is_float($calcVar2)) {
//    $calculate = $calcVar1 . $calcOper . $calcVar2;
//    $calcResult = eval("return $calculate;");
//
//}
//    header('Location: http://php1.oleg/');
//}








//анализируем первое слово после запроса, например в site/news/?id_news=1
//$url_array[1]="news"
//Полученное значение идет в page_name, если зашли в корень сайта
//то page_name="index"
//$url_array[1] = "calc";

if ($url_array[1] == "" || $url_array[1] == "?XDEBUG_SESSION_START=netbeans-xdebug") {
  $page_name = "index";

} else {
    $page_name = $url_array[1];
}


//подготовку переменных вынесли в отдельную функцию
//в нее передаем имя страницы, переменные для которой нужно подготовить
$variables = prepareVariables($page_name);

//строим страницу и выводим ее на экран
//входные данные имя страницы и ассоциотивный массив переменных
//Например "title"=>"Шапка сайта"
echo renderPage($page_name, $variables);





