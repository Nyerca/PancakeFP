<html>
<head>
<script type="text/javascript">
function insert() {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("txtHint").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","reviewChange.php",true);
	xmlhttp.send();
}
</script>
</head>
<body>
    <script type="text/javascript">
		setInterval(function(){ insert(); }, 1000);
	</script>
	<div id="txtHint"><b>Person info will be listed here...</b></div>
</body>
</html>