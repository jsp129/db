<?
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result=mysql_query("select * from member where uid='$UserID'",$con);
$passwd=mysql_result($result,0,"upass");

if ($upass != $passwd) {            // ��ȣ�� ��ġ���� �ʴ� ���
	echo   ("<script>
		window.alert('�Է� ��ȣ�� ��ġ���� �ʽ��ϴ�');
		history.go(-1);
		</script>");
	exit;		
} else {                  // ��ȣ�� ��ġ�ϴ� ���
            echo("<meta http-equiv='Refresh' content='0; url=mypage.php'>");
}  

mysql_close($con);

?>