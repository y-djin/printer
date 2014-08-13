<?php header("Content-Type: text/html; charset=utf-8");
//загрузка переменных
 include $_SERVER['DOCUMENT_ROOT'].'/printer/config/config.php';
 
// соединяемся
$link = mysql_connect($My_Host,$My_User,$My_Pass);
if (!$link) {
    die("<p>Ошибка соединения: </p>" . mysql_error());
}
// выбираем
$db_selected = mysql_select_db ($My_Base,$link);
$db_charset = mysql_set_charset (utf-8,$link);
mysql_query("SET NAMES utf8");
if (!$db_selected) {
    die ("<p>Не удалось выбрать базу $My_Base: </p>" . mysql_error());
}

//Запрос
$query = "Select DISTINCT printer_name, printer_ip
from $My_WinlogT 
where (printer_name,printer_ip) NOT IN (SELECT al_name,al_ip from $My_AliaceT)
order by printer_ip, time ASC;";

$result = mysql_query($query);
if (!$result) {
    $message  = 'Неверный запрос: ' . mysql_error() . "\n";
    $message .= 'Запрос целиком: ' . $query;
    die($message);
}

$ct=mysql_num_rows($result);
echo "<p>Найдено алиасов: " . $ct . "</p>";
echo "<table>";

echo "<tr id=tr_h1>";
echo "<td> Название принтера </td>";
echo "<td> IP-адрес принтера </td>";
echo "<td> Активность </td> <td></td>";
echo "</tr>";
$f_count=0;
while ($row = mysql_fetch_assoc($result)) {
++$f_count;
	$query = "Select MAX(time) as maxtime, MIN(time) as mintime from win_log where printer_name='$row[printer_name]' and printer_ip='$row[printer_ip]';";
		if (!$result) {
		$message  = 'Неверный запрос: ' . mysql_error() . "\n";
		$message .= 'Запрос целиком: ' . $query;
		die($message);
		}
	$result2 = mysql_query($query);
	$row2 = mysql_fetch_assoc($result2);
	echo "<tr>";
	echo "<td> $row[printer_name] </td>";
	echo "<td> $row[printer_ip] </td>";
	echo "<td> <p> $row2[mintime] </p> <p> $row2[maxtime] </p> </td>";
	echo "<td>
	<form id=scan_$f_count>
	<input type='hidden' input name='al_ip' value='$row[printer_ip]')>
	<input type='hidden' input name='al_name' value='$row[printer_name]')>
	<input type='hidden' input name='al_mintime' value='$row2[mintime]')>
	<input type='hidden' input name='al_maxtime' value='$row2[maxtime]')>
	<input type='button' value='Привязать к..' onclick='javascript:post_open(\"scan_$f_count\",\"center\",\"/printer/devices.php\");'> 
	</form>
	</td>";
		
	echo "</tr>";

}
echo "</table>";


mysql_close($link);

?>