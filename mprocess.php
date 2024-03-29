<?
if (!$topic){
	echo("
		<script>
		window.alert('제목이 없습니다. 다시 입력하세요')
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
             window.alert('동일한 화일 이름이 이미 서버에 존재합니다')
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
// 기존 필드값을 유지할 항목을 추출함
$space = mysql_result($result, 0, "space");
$hit = mysql_result($result, 0, "hit");

$wdate = date("Y-m-d-H:i:s");	//글 수정한 날짜 저장

// 변경 내용을 테이블에 저장함
mysql_query("update gongji set topic='$topic', content='$content', hit=$hit, wdate='$wdate', space=$space where id=$id", $con);

echo("<meta http-equiv='Refresh' content='0; url=gongji-list.php'>");

mysql_close($con);

?>
