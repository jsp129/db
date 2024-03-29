<?
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result=mysql_query("select * from member where uid='$UserID'",$con);
$passwd=mysql_result($result,0,"upass");

if ($upass != $passwd) {            // 암호가 일치하지 않는 경우
	echo   ("<script>
		window.alert('입력 암호가 일치하지 않습니다');
		history.go(-1);
		</script>");
	exit;		
} else {                  // 암호가 일치하는 경우
            echo("<meta http-equiv='Refresh' content='0; url=mypage.php'>");
}  

mysql_close($con);

?>