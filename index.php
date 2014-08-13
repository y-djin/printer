 <?php header("Content-Type: text/html; charset=utf-8");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script language="javascript" src="/printer/function/jquery.js"></script>
<script language="javascript" src="/printer/function/ajax_framework.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>


<body>
<div id='main'>
	<div id='top'>
			<input type="button" value="Log" onclick="javascript:OpenPage('log.php')"/>
			<input type="button" value="Users" onclick="javascript:OpenPage('user.php')"/>
			<input type="button" value="Scan" onclick="javascript:OpenPage('scan.php')"/>
			<input type="button" value="Dev" onclick="javascript:OpenPage('devices.php','center')"/>
			<input type="button" value="menu" onclick="javascript:OpenPage2('log_test.php')"/>
			<input type="button" value="sub-menu" onclick="javascript:OpenPage3('sub-menu.php')"/>
	<div id='menu'></div>
	</div>
	
	
	<div id='center'></div>
	
	<div id='bottom'>
	<div id='sub-menu'></div>
	</div>
	
	
		<aside id="add_device" class="modal">
		<div>
		
			<form id ="form_to_dev">
			<table>
  			<tr><td> Производитель </td> <td> <input type="text" name="manuf" value='<?php echo $_hw_manuf ?>' > </td></tr>
  			<tr><td> Модель </td> <td> <input type="text" name="model" value='<?php echo $_hw_model ?>' > </td></tr>
  			<tr><td> MAC-адрес </td> <td> <input type="text" name="mac" value='<?php echo $_hw_mac ?>' > </td></tr>
  			<tr><td> Серийный номер </td> <td> <input type="text" name="ser_num" value='<?php echo $_hw_ser_num ?>' > </td></tr>
  			<tr><td> Инвентарный номер </td> <td> <input type="text" name="inv_num" value='<?php echo $_hw_inv_num ?>' > </td></tr>
  			<tr><td> Алиас </td> <td> <input type="text" name="aliace" value='' > </td></tr>
   			</table>
			<input type="hidden" name="_table" value="hw_device">
			<input type="button" id="b_ok" value="Save" onclick="javascript:insert_from_form('#form_to_dev');OpenPage('devices.php')">
			</form>
			
			<form method=post>
			<input type="button" id="b_close" value="Close" onclick="javascript:OpenPage('devices.php')"/>
			</form>
			
		
		</div>
		</aside>
		
		<aside id="example2" class="modal">
		<div>
		
			<form action ="#close">
			<p> TEST </p>
			<input type="submit" id="b_ok" value="Save">
			</form>
			
			<form action ="#close">
			<input type="submit" id="b_close" value="Close">
			</form>
			
		
		</div>
		</aside>
	

</div>



</body>


</html>