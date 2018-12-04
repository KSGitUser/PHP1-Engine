<?php

//Константы ошибок
define('ERROR_NOT_FOUND', 1);
define('ERROR_TEMPLATE_EMPTY', 2);

/*
 	Обрабатывает указанный шаблон, подставляя нужные переменные
	Если во входных параметрах массив не указан, назначим
	пустой массив variables
*/
function renderPage($page_name, $variables = [])
{
	//дополним до полного имени файл шаблона из имени страницы page_name
    $file = TPL_DIR . "/" . $page_name . ".tpl";

	//Если шаблон отсутствует выведем ошибку
    if (!is_file($file)) {
      	echo 'Template file "' . $file . '" not found';
      	exit(ERROR_NOT_FOUND);
    }

	//Если шаблон есть но пустой тоже выведем ошибку
    if (filesize($file) === 0) {
      	echo 'Template file "' . $file . '" is empty';
      	exit(ERROR_TEMPLATE_EMPTY);
    }

    // если переменных для подстановки не указано, просто
    // возвращаем шаблон как есть
    if (empty($variables)) {
	      $templateContent = file_get_contents($file);
    }
    else {
      	$templateContent = file_get_contents($file);

        // заполняем значениями если variables не пустая и нужно делать замену
        $templateContent = pasteValues($variables, $page_name, $templateContent);
    }
	//возвращаем текст шаблона
    return $templateContent;
}
/*
	Функция замены значений в шаблоне по массиву замен variables
	Если массив variables двумерный то замена происходит по дополнительному шаблону
	Например variables:
	[
		"newsfeed"=>[
						"news1"=>"Текст новости 1",
						"news1"=>"Текст новости 1",
						"news1"=>"Текст новости 1"		
					]
	]
	тогда поле {{newsfeed}} будет заменено не просто текстом, а по шаблону из файла
	news_newsfeed_item.tpl имя которого система постоит сама
*/
function pasteValues($variables, $page_name, $templateContent){
	//перебираем массив замен
    foreach ($variables as $key => $value) {
		//Если массив двумерный, т.е. не одно значение для подстановки
		//то выполним подстановку через дополнительный шаблон
        if ($value != null) {
            // собираем ключи
            $p_key = '{{' . strtoupper($key) . '}}';

            if(is_array($value)){
                // замена массивом
                $result = "";
                foreach ($value as $value_key => $item){
					//сформируем имя дополнительного шаблона
                    $itemTemplateContent = file_get_contents(TPL_DIR . "/" . $page_name ."_".$key."_item.tpl");

					//выполним замену по дополнительному шаблону
                    foreach($item as $item_key => $item_value){
                        $i_key = '{{' . strtoupper($item_key) . '}}';

                        $itemTemplateContent = str_replace($i_key, $item_value, $itemTemplateContent);
                    }
					//формируем общую строку с шаблоном уже с подставленными значениями
                    $result .= $itemTemplateContent;
                }
            }
            else
				//если подставляется просто значение, его и вернем
                $result = $value;
			//произведем основную замену элементов в шаблоне
            $templateContent = str_replace($p_key, $result, $templateContent);
        }
    }
	//вернем строку с готовым шаблоном со вставленными элементами
    return $templateContent;
}
/*
	Так называемый роутер, навигатор, главное место в движке,
	где определяется какая страница вызвана и выполняются
	необходимые действия для нее, а именно
	присваиваются, получаются, вычисляются значения
	для подстановки в шаблон, формируется переменная vars
	На входе имя запрашиваемой страницы

*/
function prepareVariables($page_name){
    $vars = [];
	//в зависимости от того, какую страницу вызываем
	//такой блок кода для нее и выполняем

    switch ($page_name){
        case "news":
			//если вызвана страница новостей заполним для нее поля
			//лента новостей будет не просто строка текста,
			//а массивом новостей, БЕЗ ТЕГОВ, просто текст
			//pasteValues сам заменит этот текст на шаблон
            $vars["newsfeed"] = getNews();
            $vars["test"] = "Привет!";
            break;
      case "gallery":
			//если вызвана страница галлереи заполним для нее поля
			//pasteValues сам заменит этот текст на шаблон
            $sql = "SELECT * FROM image_names";
            $sql = "SELECT * FROM `image_names` WHERE 1 ORDER BY `views_number` DESC";
            $vars["gallery"] = getImages($sql);
            $vars["test"] = "Галлерея!";
            $vars["head"] = file_get_contents(TPL_DIR . "/head.tpl");
            break;
         case "gallerypage":
			//если вызвана страница для полной новости
			//то получим текст полной новости content
			//через выполнение запроса к базе по номеру новости
			//который получаем через GET
            $content = getImageFromBase($_GET['id_image']);
            $vars["big_file_name"] = $content["big_file_name"];
            $vars["views_number"] = ++$content["views_number"];
            $vars["head"] = file_get_contents(TPL_DIR . "/head.tpl");
            $sql = "UPDATE image_names SET views_number={$content["views_number"]} WHERE img_id={$content["img_id"]}";
            executeQuery($sql);  
            break;  
        
//        case "install":
//            $fileText = file_get_contents(DATA_DIR . "/test5.sql");
//     
//            $result = executeQueryNewTable($fileText, "php1.oleg", "root", "", "images_bd");
        
        case "newspage":
			//если вызвана страница для полной новости
			//то получим текст полной новости content
			//через выполнение запроса к базе по номеру новости
			//который получаем через GET
            $content = getNewsContent($_GET['id_news']);
            $vars["news_title"] = $content["news_title"];
            $vars["news_content"] = $content["news_content"];

            break;     
        
        

	case "delete":
			//дополнительная функция удаления новости
			//запрос вида site/delete/?id_news=2 т.е. удалите ка вторую новость
			//Получаем номер новости через GET
			$idx = $_GET["id_news"];
			//вызываем функцию удаления новости
			delNews($idx);
			//возвращаемся на страницу с новостями, никаких значений возвращать уже не нужно
			header("location: /news/");

            break;
    }
	//возвращаем готовый массив значения vars для шаблона 
    return $vars;
}

//функция возвращает массив всех новостей
function getNews(){
    $sql = "SELECT id_news, news_title, news_preview FROM news";
    $news = getAssocResult($sql);
	//print_r($news);
    return $news;
}

function getImages($sql){
   
    $images = getAssocResult($sql);
	//print_r($news);
    return $images;
}
//функция удаления новости по ее номеру
function delNews($idx){
	$idx = (int)$idx;
    $sql = "DELETE FROM `news` WHERE `news`.`id_news` = {$idx}";
	executeQuery($sql);

}

function addImageToTable($value){
   
	
    $sql =  "INSERT INTO `image_names`(`smal_file_name`, `big_file_name`, `views_number`) VALUES (\"{$value}\",\"{$value}\",0)";;
	executeQuery($sql);

}
//функция вовзращает текст полной новости по ее номеру
function getNewsContent($id_news){
    $id_news = (int)$id_news;

    $sql = "SELECT * FROM news WHERE id_news = {$id_news}";
    $news = getAssocResult($sql);

	//В случае если новости нет, вернем пустое значение
    $result = [];
    if(isset($news[0]))
        $result = $news[0];

    return $result;
}

function getImageFromBase($id_image){
    $id_image = (int)$id_image;

    $sql = "SELECT * FROM image_names WHERE `img_id` = {$id_image}";
    $image = getAssocResult($sql);

	//В случае если картинки нет, вернем пустое значение
    $result = [];
    if(isset($image[0]))
        $result = $image[0];

    return $result;
}

