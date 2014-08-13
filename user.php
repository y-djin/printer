 <?php header("Content-Type: text/html; charset=utf-8");

//загрузка переменный
 include $_SERVER['DOCUMENT_ROOT'].'/printer/config/config.php';
 $usr_hw_id = $_POST[_id];
 if (!empty($usr_hw_id)) {
 	echo "принтер id:" . $usr_hw_id; 
 }
 
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
if (empty($usr_hw_id)) {
$query = "SELECT DISTINCT user FROM win_log order by UPPER(user);";
}
else {
$query = "Select DISTINCT user from win_log as log, hw_aliace as aliace where aliace.hw_id='$usr_hw_id' and log.printer_name = aliace.al_name and log.printer_ip=aliace.al_ip and log.time between aliace.al_mintime and aliace.al_maxtime ;";
}
	
mysql_query("SET NAMES utf8");
$result = mysql_query($query);
if (!$result) {
    $message  = 'Неверный запрос: ' . mysql_error() . "\n";
    $message .= 'Запрос целиком: ' . $query;
    die($message);
}


echo "Всего записей: " . mysql_num_rows($result) ;
echo "<table>";

echo "<tr id=tr_h1> 
		<td id=log_user>Пользователь</td>
		<td>Напечатано</td>
		</tr>";

while ($row = mysql_fetch_assoc($result)) {
	$query = "Select SUM(count) as count FROM win_log where user='$row[user]';";
	$result2 = mysql_query($query);
	$row2 = mysql_fetch_assoc($result2);	

	
echo "<tr>";
#<a href='javascript:post_open(\"$row[user]\",\"center\");'>$row[user]</a>
echo "
<td>
<form id='user_$row[user]'>
<input type='hidden', name='_user', value='$row[user]'>
<a href='javascript:post_open(\"user_$row[user]\",\"center\",\"/printer/user-log.php\");'>$row[user]</a> 
</form>
</td>
";

echo "<td> $row2[count] </td>";



echo "</tr>";
}
echo "</table>";






mysql_close($link);

?>
