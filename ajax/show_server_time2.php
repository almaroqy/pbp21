<!-- File: ajaxServerTime.html
	Deskripsi : menampilkan waktu server dengan ajax
-->

<!DOCTYPE HTML> 
<html>
<head>
  <script>
	//fungsi untuk membuat objek XMLHttpRequest
    function getXMLHTTPRequest(){
		if (window.XMLHttpRequest){
			// code for modern browsers
			return new XMLHttpRequest();
		}else{
			// code for old IE browsers
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
	}

	//fungsi yang melakukan request ke file server menggunakan Ajax
	function get_server_time() {
		var xmlhttp = getXMLHTTPRequest();
		var page = 'get_server_time.php';
		xmlhttp.open("GET", page, true);
		xmlhttp.onreadystatechange = function() {
			document.getElementById('showtime').innerHTML = '<img src="../images/ajax_loader.png"/>';
			if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
				document.getElementById('showtime').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.send(null);
	}

  </script>
  <title>Simple Ajax Example</title>
</head>
<body> 
<h2>Ajax Server Time</h2>
<br>
<button onclick="get_server_time()">Show Server Time</button>
<br><br>
<div id="showtime"></div>
</body>
</html>