<?



$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

// �亯 ���� ���� �ۺ��� ���̰� 1 ������
$result=mysql_query("select space from munui where id=$id", $con);
$space=mysql_result($result, 0, "space");
$space=$space+1;
$wdate=date("Y-m-d-H:i:s"); // �ܺ� ���� �� ��¥ ����

// �亯���� �߰��Ǹ� ���� ������ �ϳ� �����ϹǷ� �� ��ȣ�� ����
$tmp = mysql_query("select id from munui", $con);
$total = mysql_num_rows($tmp);

while($total >= $id):
	mysql_query("update munui set id=id+1 where id=$total", $con);
	$total--;
endwhile;

// ���� �� ��ȣ ��ġ�� �亯 ���� ������
mysql_query("insert into munui(uid, id, writer, passwd, topic, content, hit, wdate, space) values ('$uid', $id, '������', '$passwd', '$topic','$content', 0, '$wdate',   $space)", $con);

mysql_close($con);

echo("<meta http-equiv='Refresh' content='0; url=munui-list.php'>");

?>
