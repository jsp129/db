<?

if (!$code){
	echo("
		<script>
		window.alert('��ǰ�ڵ���� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$name){
	echo("
		<script>
		window.alert('��ǰ���� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}
if (!$maxdate){
	echo("
		<script>
		window.alert('��������� �����ϴ�. �ٽ� �Է��ϼ���.')
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

if (!$userfile){
	echo("
		<script>
        window.alert('��ǰ ������ ������ �ּ���')
        history.go(-1)
        </script>
    ");
    exit;
} else {
    $savedir = "./photo";
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
if (!$userfile2){
	echo("
		<script>
        window.alert('���� ������ ������ �ּ���')
        history.go(-1)
        </script>
    ");
    exit;
} else {
    $savedir2 = "./photo2";
    $temp2 = $userfile2_name;
    if (file_exists("$savedir2/$temp2")) {
         echo (" 
             <script>
             window.alert('������ ȭ�� �̸��� �̹� ������ �����մϴ�')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile2, "$savedir2/$temp2");
         unlink($userfile2);
    }
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result = mysql_query("insert into product(class, code, name, content,maxdate, price1, userfile,userfile2, hit) values ($class, '$code', '$name', '$content','$maxdate', '$price1', '$userfile_name','$userfile2_name', 0)", $con);

mysql_close($con);		

if (!$result) {
   echo("
      <script>
      window.alert('�̹� ������� ��ǰ �ڵ��Դϴ�')
      history.go(-1)
      </script>
   ");
   exit;
} else {
   echo("
      <script>
      window.alert('��ǰ ����� �Ϸ�Ǿ����ϴ�')
      </script>
   ");
}
echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>
