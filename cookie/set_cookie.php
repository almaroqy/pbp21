<?php
//File		: set_cookie.php
//Deskripsi	: untuk mengeset sebuah cookie

//Remember that setcookie must come before any other line that generates output
//$expired = time() + (60*60*24*1);
setcookie("username","michele");
echo 'Cookie created.';
?>
