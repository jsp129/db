<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

mysql_query("delete from gongji where id=$id",$con);
mysql_query("delete from gongjimemo where id=$id",$con);
echo("
	<script>
	window.alert('���� ���� �Ǿ����ϴ�.');
	</script>
");

// ������ �ۺ��� �� ��ȣ�� ū �Խù��� �� ��ȣ�� 1�� ����
$tmp = mysql_query("select id from gongji order by id desc", $con);
$last = mysql_result($tmp, 0, "id");     // ���� ������ �� ��ȣ ����

$i = $id + 1;       // ������ ���� ��ȣ���� 1�� ū �� ��ȣ���� ����
while($i <= $last):
	mysql_query("update gongji set id=id-1 where id=$i", $con);
	$i++;
endwhile;

// �� ���� ����� �����ֱ� ���� �� ��� ���� ���α׷� ȣ��
echo("<meta http-equiv='Refresh' content='0; url=gongji-list.php'>");

mysql_close($con);

?>
