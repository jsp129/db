<?

if (!$name){
	echo("
		<script>
		window.alert('��ǰ���� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$price1){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
	
// ���� ��ǰ �̹����� �״�� ����ϴ� ���
if (!$userfile){
	$result = mysql_query("update product set class=$class, name='$name', content='$content', maxdate='$maxdate', price1=$price1 where code='$code'", $con);

} else {

     // ���� ��ǰ �̹��� ������ ����
	$tmp = mysql_query("select userfile from product where code='$code'", $con);
	$fname = mysql_result($tmp, 0, "userfile");
    $savedir = "./photo";
	unlink("$savedir/$fname");
	
    // ������ ÷���� �̹��� ������ ����	
    $temp = $userfile_name;
    if (file_exists("$savedir/$temp")) {
         echo (" 
             <script>
             window.alert('������ ȭ�� �̸��� ������ �����մϴ�')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile, "$savedir/$temp");
         unlink($userfile);
    }
	$result = mysql_query("update product set class=$class, name='$name', content='$content', maxdate='$maxdate', price1=$price1, userfile='$userfile_name' where code='$code'", $con);
}

if(!$userfile2){	
}else{
	 // ���� ��ǰ ���� ������ ����
	$tmp2 = mysql_query("select userfile2 from product where code='$code'", $con);
	$fname2 = mysql_result($tmp2, 0, "userfile2");
    $savedir2 = "./photo2";
	unlink("$savedir2/$fname2");
	
    // ������ ÷���� �̹��� ������ ����	
    $temp2 = $userfile2_name;
    if (file_exists("$savedir2/$temp2")) {
         echo (" 
             <script>
             window.alert('������ ȭ�� �̸��� ������ �����մϴ�')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile2, "$savedir2/$temp2");
         unlink($userfile2);
    }
	$result= mysql_query("update product set userfile2='$userfile2_name' where code='$code'",$con);
}

if (!$result) {
	echo("
      <script>
      window.alert('��ǰ ������ �����߽��ϴ�')
      </script>
    ");
    exit;
} else {
	echo("
      <script>
      window.alert('��ǰ ������ �Ϸ�Ǿ����ϴ�')
      </script>
   ");
} 

mysql_close($con);		//�����ͺ��̽� ��������

echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>
