<?

if(!$content){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

// �����ͺ��̽��� ����
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result=mysql_query("select id from munui",$con);
$total=mysql_num_rows($result);

// �ۿ� ���� id�ο�
if (!$total){
	$id = 1;
} else {
	$id = $total + 1;
}
if ($userfile) {	
   $savedir = "./munui";	//÷�� ������ ����� ����
   $temp = $userfile_name;
   copy($userfile, "$savedir/$temp");
   unlink($userfile);
}
$wdate = date("Y-m-d-H:i:s");	//   �� �� ��¥ ����

// ���̺� �Է� �� ������ ����
mysql_query("insert into munui(uid,id,writer,passwd,topic,content,hit,wdate,space,filename,filesize) values('$UserID',$id,'$writer','$passwd','$topic','$content',0,'$wdate',0,'$userfile_name','$userfile_size')", $con);

mysql_close($con);	// �����ͺ��̽� ��������

//show.php ���α׷��� ȣ���ϸ鼭 ���̺� �̸��� ����
echo("<meta http-equiv='Refresh' content='0; url=munui.php'>");

?>
