<?
if (!$topic){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}
if (!$userfile){
} else {
    $savedir = "./gongji";
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
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result = mysql_query("select id from gongji", $con);
$total=mysql_num_rows($result);
// �ۿ� ���� id�ο�
if (!$total){
	$id = 1;
} else {
	$id = $total + 1;
}

$wdate = date("Y-m-d-H:i:s");	//   �� �� ��¥ ����
// ���̺� �Է� �� ������ ����
mysql_query("insert into gongji(id,topic,content,hit,wdate,space,filename,filesize) values($id,'$topic','$content',0,'$wdate',0,'$userfile_name','$userfile_size')", $con);

mysql_close($con);	// �����ͺ��̽� ��������

//show.php ���α׷��� ȣ���ϸ鼭 ���̺� �̸��� ����
echo("<meta http-equiv='Refresh' content='0; url=admin.php'>");
?>