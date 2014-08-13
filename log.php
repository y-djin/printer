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
$query = "SELECT * FROM $My_Table ORDER BY time DESC;";
mysql_query("SET NAMES utf8");
$result = mysql_query($query);
if (!$result) {
    $message  = 'Неверный запрос: ' . mysql_error() . "\n";
    $message .= 'Запрос целиком: ' . $query;
    die($message);
}


echo "Всего записей: " . mysql_num_rows($result) ;
echo "<table>";


echo "<tr id=tr_h1> <td id=log_time>Время</td> <td id=log_doc>Документ</td> <td id=log_user>Пользователь</td> <td id=log_printer>Принтер</td><td id=log_ip>IP адресс</td> <td id=log_sum>Стр.</td>";


while ($row = mysql_fetch_assoc($result)) {
echo "<tr>";
echo "<td> $row[time] </td>";
echo "<td> $row[doc] </td>";
echo "
	<td>
	<form id='log_$row[user]'>
	<input type='hidden', name='_user', value='$row[user]'>
	<a href='javascript:post_open(\"log_$row[user]\",\"center\",\"/printer/user-log.php\");');'>$row[user]</a> 
	</form>
	</td>

";
echo "<td> $row[printer_name] </td>";
echo "<td> $row[printer_ip] </td>";
echo "<td> $row[count] </td>";


echo "</tr>";
}
echo "</table>";






mysql_close($link);

?>
