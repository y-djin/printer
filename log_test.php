 <?php header("Content-Type: text/html; charset=utf-8");

//загрузка переменный
 include $_SERVER['DOCUMENT_ROOT'].'/printer/config/config.php';

 
 
 //#####################
// соединяемся
$link = mysql_connect($My_Host,$My_User,$My_Pass);
if (!$link) {
    die("<p>Ошибка соединения: </p>" . mysql_error());
}
//echo "<p>Успешно соединились</p>";

// выбираем

$db_selected = mysql_select_db ($My_Base,$link);
$db_charset = mysql_set_charset (utf-8,$link);

if (!$db_selected) {
    die ("<p>Не удалось выбрать базу $My_Base: </p>" . mysql_error());
}
//echo '<p>Успешно соединились c Базой</p>';

//#####################
$query = "SELECT COUNT(*) as count FROM $My_Table;";
mysql_query("SET NAMES utf8");
$result = mysql_query($query);
if (!$result) {
    $message  = 'Неверный запрос: ' . mysql_error() . "\n";
    $message .= 'Запрос целиком: ' . $query;
    die($message);
}
if (mysql_num_rows($result) == 0) {
	echo "No rows found, nothing to print so am exiting";
	exit;
}
$row = mysql_fetch_assoc($result);


echo "Всего записей: " . $row[count] ;




mysql_close($link);

?>
