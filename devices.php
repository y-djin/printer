 <?php header("Content-Type: text/html; charset=utf-8");
 // Переменные###################################
 include $_SERVER['DOCUMENT_ROOT'].'/printer/config/config.php';
 
 $al_name = $_POST[al_name];
 $al_ip = $_POST[al_ip];
 $al_mintime = $_POST[al_mintime];
 $al_maxtime = $_POST[al_maxtime];
//##################################################
 //Формируем запрос
 $query="SELECT id,manuf,model,mac,ser_num,inv_num,aliace from $My_DeviceT";
 
 //##################################################
 
 
 // соединяемся
 $link = mysql_connect($My_Host,$My_User,$My_Pass);
 if (!$link) {
 	die("<p>Ошибка соединения: </p>" . mysql_error());
 }
 
 // выбираем БД и кодировку
 $db_selected = mysql_select_db ($My_Base,$link);
 $db_charset = mysql_set_charset (utf-8,$link);
 mysql_query("SET NAMES utf8");
 
 if (!$db_selected) {
 	die ("<p>Не удалось выбрать базу $My_Base: </p>" . mysql_error());
 }
 
 $result = mysql_query($query);
 if (!$result) {
 	$message  = 'Неверный запрос: ' . mysql_error() . "\n";
 	$message .= 'Запрос целиком: ' . $query;
 	die($message);
 }

//Show если переход со страницы scan
 if (empty($al_name)) {
 	$show_div='style=display:none'; 
 };
 echo " <div id='dev_aliace_info' $show_div> ";
 echo "<p>Привязать алиас " . $al_name . "(" . $al_ip . ")</p>";
 echo "<p>Работа в логах " . $al_mintime . "-" . $al_maxtime . "</p>";
 echo "<input type='checkbox' id='chkbox'>Активный";
 echo "
 	<form id=post_data>
 	<input type='hidden' name='al_ip' value=\"$al_ip\">
	<input type='hidden' name='al_name' value=\"$al_name\">
	<input type='hidden' name='al_mintime' value=\"$al_mintime\">
	<input type='hidden' name='al_maxtime' value=\"$al_maxtime\">
	
	</form>
 	</div>
 ";
//dev_aliace_info##################################

//##################################################
//Основной блок
echo "<div id='dev_main'>";
echo "<p>Найдено устройств: " . mysql_num_rows($result) . "</p>";
echo "<p><input type='button' value='Add_device' onclick='javascript:$(\"#dev_dev_add\").show();$(\"#dev_main\").hide();'> </p>";







while ($row = mysql_fetch_assoc($result)) {

$al_query="Select al_name,al_ip from hw_aliace where al_maxtime = '9999-00-00 00:00:00' and hw_id='$row[id]';";
$al_result = mysql_query($al_query);
if (!$result) {
	$message  = 'Неверный запрос: ' . mysql_error() . "\n";
	$message .= 'Запрос целиком: ' . $query;
	die($message);
}
$al_row = mysql_fetch_assoc($al_result);

#Select SUM(count) from win_log as log, hw_aliace as aliace where aliace.hw_id='22' and log.printer_name = aliace.al_name and log.printer_ip=aliace.al_ip and log.time between aliace.al_mintime and aliace.al_maxtime;

$count_query="Select SUM(count)as count from win_log as log, hw_aliace as aliace where aliace.hw_id='$row[id]' and log.printer_name = aliace.al_name and log.printer_ip=aliace.al_ip and log.time between aliace.al_mintime and aliace.al_maxtime;";
$count_result = mysql_query($count_query);
if (!$result) {
	$message  = 'Неверный запрос: ' . mysql_error() . "\n";
	$message .= 'Запрос целиком: ' . $query;
	die($message);
}
$count_row = mysql_fetch_assoc($count_result);




echo "
<div class='table'>
	<div class='str'>
		<div class='cel-30'>
			<p>$al_row[al_name] ( $al_row[al_ip] ) </p>
			<p><a href='javascript:sh_hide(\"#str-sub_$row[id]\",\"div.str-sub\");'><img src='/printer/img/down-arrow.png'>Подробно</a></p>
			
		</div>
		<div class='cel-30'>
			 $row[manuf] $row[model] #$row[id] 
		</div>
		<div class='cel-20'>	
			<a href='javascript:post_open(\"form_del_dev_$row[id]\",\"center\",\"/printer/user.php\");'>Всего напечатано: $count_row[count]</a> 
		</div>
		
		<div class='cel-20'>
";
#
if(empty($al_name)) {
echo "		
			<form id='form_del_dev_$row[id]'>
				<input type='hidden' name='_table' value='hw_device'>
				<input type='hidden' name='_id' value='$row[id]'>
				<input type='button' value='Delete' onclick='delete_from(\"#form_del_dev_$row[id]\");OpenPage(\"devices.php\");'> </br>
			</form>	
";
};
//<input type='button' value='Select' onclick='javascript:ch_check(\"chkbox\",\"input_$row[id]\",\"$al_maxtime\");insert_from_form(\"#form_sel_$row[id]\");OpenPage(\"scan.php\");'>
//Если переход со страницы скан добавляется кнопка select
		if(!empty($al_name)) {
			echo "
			<form id='form_sel_$row[id]'>
				<input type='button' value='Select' onclick='ch_check(\"chkbox\",\"input_$row[id]\",\"$al_maxtime\");insert_from_form(\"#form_sel_$row[id]\");OpenPage(\"scan.php\");'> </br>
				<input type='hidden' name='_table' value='hw_aliace'>
				<input type='hidden' name='hw_id' value=\"$row[id]\">
 				<input type='hidden' input name='al_ip' value=\"$al_ip\">
				<input type='hidden' input name='al_name' value=\"$al_name\">
				<input type='hidden' input name='al_mintime' value=\"$al_mintime\">
				<input type='hidden' input name='al_maxtime' value=\"$al_maxtime\" id='input_$row[id]'>
			</form>	
			";
			};
//#########################################################
echo "
	</div>

		
		
		
	</div>
	<div class='str-sub' id='str-sub_$row[id]'>
			<p> Производитель: $row[manuf] </p>
			<p> Модель: $row[model] </p>
			<p> MAC-адрес:  $row[mac] </p>
			<p> Сирийный номер: $row[ser_num] </p>
			<p> Инвентарный номер: $row[inv_num] </p>
			<p> Привязанные алиасы: </p>
			
	</div>
</div>
		
";

};//While
echo "
</br>

</div> 	
";
//end Main div
//Окно добавления нового устройства
echo "
	<div id ='dev_dev_add' style='display:none'>
		<form id ='form_to_dev'>
			<table>
  				<tr><td> Производитель </td> <td> <input type='text' name='manuf' value='' > </td></tr>
  				<tr><td> Модель </td> <td> <input type='text' name='model' value='' > </td></tr>
  				<tr><td> MAC-адрес </td> <td> <input type='text' name='mac' value='' > </td></tr>
  				<tr><td> Серийный номер </td> <td> <input type='text' name='ser_num' value='' > </td></tr>
  				<tr><td> Инвентарный номер </td> <td> <input type='text' name='inv_num' value='' > </td></tr>
  				<tr><td> Алиас </td> <td> <input type='text' name='aliace' value='' > </td></tr>
			</table>
			<input type='hidden' name='_table' value='hw_device'>
			<table>
				<tr>
				<td>
				<input type='button' value='Save' onclick='javascript:insert_from_form(\"#form_to_dev\");post_open(\"post_data\",\"center\",\"/printer/devices.php\");'>	
				
				</td>
				<td>
				<input type='button' value='Close' onclick='javascript:$(\"#dev_main\").show();$(\"#dev_dev_add\").hide();'>
				</td>
				</tr>
			</table>
		</form>
	</div>
";
//dev_dev_add
//Окно привязки алиаса

mysql_close($link);
?>