<head>
<script language="javascript" src="/printer/jquery-ui.min.js"></script>
<script language="javascript" src="/printer/function/ajax_framework.js"></script>
<script type="text/javascript">
function test() {
$data = $('#test3').val();
$( "form3" ).on( "submit", function( event ) {
  event.preventDefault();
console.log( $(this).serialize() );
});



$data = document.getElementById('test3').value;
document.getElementById('test2').value = $data;





}
</script>
</head>
<body>


<form id='form3' name='form3'>
<input type="button" value="OK" onclick="javascript:call()">
<input type="submit" value="submit">
<input type="text" id="test2" value="" >
<input type="text" id="test3" value="123" >
</form>








</body>



