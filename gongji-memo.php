<?
if (!$UserID) {
	echo ("<script>
		window.alert('�α��� ����ڸ� ��� �ۼ��� �����մϴ�')
		history.go(-1)
		</script>");
      exit;
} 

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result = mysql_query("select uname from gongjimemo where id=$id", $con);


function check($message) {
	echo ("
		<script>
		window.alert(\"$message\");
		history.go(-1);
		</script>
	");
	exit;
}
if (!$content) check("������ �Է��ϼ���");
$wdate = date("Y-m-d-H:i:s");

mysql_query("insert into gongjimemo(name,wdate,message,passwd,id) values('$name', '$wdate','$content','$passwd',$id)", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=gongji-show.php?id=$id'>");
?>