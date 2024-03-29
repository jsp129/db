<?
if (!$topic){
	echo("
		<script>
		window.alert('제목이 없습니다. 다시 입력하세요.')
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
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result = mysql_query("select id from gongji", $con);
$total=mysql_num_rows($result);
// 글에 대한 id부여
if (!$total){
	$id = 1;
} else {
	$id = $total + 1;
}

$wdate = date("Y-m-d-H:i:s");	//   글 쓴 날짜 저장
// 테이블에 입력 글 내용을 저장
mysql_query("insert into gongji(id,topic,content,hit,wdate,space,filename,filesize) values($id,'$topic','$content',0,'$wdate',0,'$userfile_name','$userfile_size')", $con);

mysql_close($con);	// 데이터베이스 연결해제

//show.php 프로그램을 호출하면서 테이블 이름을 전달
echo("<meta http-equiv='Refresh' content='0; url=admin.php'>");
?>