<?
if (!$UserID) {
	echo ("<script>
		window.alert('로그인 사용자만 리뷰 작성이 가능합니다')
		history.go(-1)
		</script>");
      exit;
} 
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result = mysql_query("select uname from member where uid='$UserID'", $con);
$name = mysql_result($result, 0, "uname");
function check($message) {
	echo ("
		<script>
		window.alert(\"$message\");
		history.go(-1);
		</script>
	");
	exit;
}
if (!$userfile){
}else{
	$savedir = "./memo";
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

if (!$wmemo) check("내용을 입력하세요");
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("class", $con);
$wdate = date("Y-m-d-H:i:s");

mysql_query("insert into memojang(name,wdate,message,code,userfile, id) values('$name', '$wdate','$wmemo','$code','$userfile_name','$UserID')", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code'>");

?>
