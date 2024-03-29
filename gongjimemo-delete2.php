<?
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result=mysql_query("select passwd from gongjimemo where id=$id and wdate='$wdate'",$con);
$passwd=mysql_result($result,0,"passwd");

if ($pass != $passwd) {            // 암호가 일치하지 않는 경우
	echo   ("<script>
		window.alert('입력 암호가 일치하지 않네요');
		history.go(-1);
		</script>");
	exit;		
} else { // 암호가 일치하는 경우
	mysql_query("delete from gongjimemo where id=$id and wdate='$wdate'",$con);
	echo("
		<script>
		window.alert('댓글이 삭제 되었읍니다.');
		</script>
	");			
    
}  

mysql_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=gongji-show.php?id=$id'>");

?>
