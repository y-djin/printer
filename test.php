<?php





//##################################################
function get_query($query) {
	$result = mysql_query($query);
	if (!$result) {
		$message  = 'Неверный запрос: ' . mysql_error() . "\n";
		$message .= 'Запрос целиком: ' . $query;
		die($message);
	}
	return  mysql_fetch_assoc($result);

};
//##################################################
?>