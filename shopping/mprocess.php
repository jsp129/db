<?
if (!$topic){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���')
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
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result = mysql_query("select * from gongji where id=$id", $con);
$total=mysql_num_rows($result);
echo("$total, $topic $content");
// ���� �ʵ尪�� ������ �׸��� ������
$space = mysql_result($result, 0, "space");
$hit = mysql_result($result, 0, "hit");

$wdate = date("Y-m-d-H:i:s");	//�� ������ ��¥ ����

// ���� ������ ���̺� ������
mysql_query("update gongji set topic='$topic', content='$content', hit=$hit, wdate='$wdate', space=$space where id=$id", $con);

echo("<meta http-equiv='Refresh' content='0; url=gongji-list.php'>");

mysql_close($con);

?>
