<?
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result=mysql_query("select passwd from gongjimemo where id=$id and wdate='$wdate'",$con);
$passwd=mysql_result($result,0,"passwd");

if ($pass != $passwd) {            // ��ȣ�� ��ġ���� �ʴ� ���
	echo   ("<script>
		window.alert('�Է� ��ȣ�� ��ġ���� �ʳ׿�');
		history.go(-1);
		</script>");
	exit;		
} else { // ��ȣ�� ��ġ�ϴ� ���
	mysql_query("delete from gongjimemo where id=$id and wdate='$wdate'",$con);
	echo("
		<script>
		window.alert('����� ���� �Ǿ����ϴ�.');
		</script>
	");			
    
}  

mysql_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=gongji-show.php?id=$id'>");

?>
