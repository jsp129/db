<?
if ($point < $usepoint){
	echo("
		<script>
		window.alert('���� ����Ʈ�� �Ѵ� ����Ʈ�� ��� �Ұ��� �մϴ�.')
		history.go(-1)
		</script>
	");
	exit;
}
if (!$receiver){
	echo("
		<script>
		window.alert('������ �̸��� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$phone){
	echo("
		<script>
		window.alert('�������� ��ȭ��ȣ�� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$addr1){
	echo("
		<script>
		window.alert('��� �ּҰ� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$buydate = date("Y-m-d-H:i:s");	// ���� ��¥ ����

$ordernum = strtoupper(substr($UserID, 0, 3)) . "-" . $buydate; 

$address = "(" . $zip .  ")" . "&nbsp;" . $addr1 . "&nbsp;" . $addr2;

// ����� �ּҿ� ���� ��ȣ�� ���̺��� ����
mysql_query("insert into   receivers(id, session, sender, receiver, phone, address, message, buydate,   ordernum, status) values ('$UserID', '$Session', '$UserName',   '$receiver','$phone', '$address', '$message', '$buydate', '$ordernum', 1)", $con);

// ��ü ���ι� ���̺����� ���� ������ �о�� ����
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);
$result2 = mysql_query("select * from member where uid='$UserID'", $con);
$total2 = mysql_num_rows($result);
$point1=mysql_result($result2,0,"point");
$newpoint=$point1-$usepoint + $point;
mysql_query("update member set point=$newpoint",$con);
$counter=0;

while ($counter < $total) :
	$pcode = mysql_result($result, $counter, "pcode");
    $quantity = mysql_result($result, $counter, "quantity");
      
    // ���ι� ������ �ϳ��� ���� �Ϸ� ����Ʈ�� ����
    mysql_query("insert into orderlist(id, session, pcode, quantity)   values ('$UserID', '$Session', '$pcode','$quantity')", $con);
	 	 	 
    $counter++;
endwhile;

// ���� �Ϸ��� ������ ���ι� ���̺����� ��� ����
mysql_query("delete from shoppingbag   where session='$Session'",$con);

mysql_close($con);	 

echo ("<script>
 	window.alert('���Ű� ���������� ó���Ǿ����ϴ�. \\n�ֹ� ��ȣ�� $ordernum �̸� My Page���� �ֹ� ��ȸ�� �����մϴ�')
    history.go(1)
    </script>
    <meta http-equiv='Refresh' content='0; url=index.html'>
");

?>