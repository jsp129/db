<?
if (!$UserID) {
	echo ("<script>
		window.alert('�α��� ����ڸ� ���� �ۼ��� �����մϴ�')
		history.go(-1)
		</script>");
      exit;
} 
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result = mysql_query("select uname from member where uid='$UserID'", $con);
$name = mysql_result($result, 0, "uname");
function check($message) {
	echo ("
		<script>
		window.alert(\"$message\");
		history.go(-1);
		</script>
	");
	exit;
}
if (!$userfile){
}else{
	$savedir = "./memo";
	$temp = $userfile_name;
	if (file_exists("$savedir/$temp")) {
		 echo (" 
			 <script>
			 window.alert('������ ȭ�� �̸��� �̹� ������ �����մϴ�')
			 history.go(-1)
			 </script>
		 ");
		 exit;
	} else {
		 copy($userfile, "$savedir/$temp");
		 unlink($userfile);
	}
}

if (!$wmemo) check("������ �Է��ϼ���");
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("class", $con);
$wdate = date("Y-m-d-H:i:s");

mysql_query("insert into memojang(name,wdate,message,code,userfile, id) values('$name', '$wdate','$wmemo','$code','$userfile_name','$UserID')", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code'>");

?>
