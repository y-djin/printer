<?php header("Content-Type: text/html; charset=utf-8");
//Обработка входных переменных
include $_SERVER['DOCUMENT_ROOT'].'/php/config/config.php';

 $_table = $_POST['_table'];
 $result = $_POST;
 unset ($result['_table']);
 
 

  //Удаляем прочитанные страницу-источник и имя таблицы, дальше данные для базы


 //Разбиваем на названия полей $field и сами значения $values
foreach ($result as $row => $name) {
if (empty($field)){
$field = $row;
	$values = "'" . $name . "'";
} else {
$field = $field  . "," . $row;
$values = $values  . ",'" . $name . "'";
}
}
 //Формируем запрос
$query="INSERT INTO " . $_table . " (" . $field . ") VALUES (" . $values . ");";

//##################################################



//Создание соединения с сервером SQL
$link = mysql_connect($My_Host,$My_User,$My_Pass);
if (!$link) {
die("<p>Ошибка соединения: </p>" . mysql_error());
 }
 //Соединение с БД
 $db_selected = mysql_select_db ($My_Base,$link);
 if (!$db_selected) {
 die ("<p>Не удалось выбрать базу $My_Base: </p>" . mysql_error());
 }
 //Установка кодировки
 $db_charset = mysql_set_charset (utf-8,$link);
 //Запрос и закрытие соединения
 mysql_query($query,$link);
 mysql_close($link);
 echo " $query </br> ";
 //echo "Location: $_source";

 //Возвращаемся на страницу вызова
 //header ("Location: http://10.71.6.5/printer/#close");
 
 exit();
 ?>
