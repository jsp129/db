<?
include("top.html");
if ($UserID != 'admin') {
	echo ("<script>
		window.alert('관리자만 접근 가능한 기능입니다')
		history.go(-1)
		</script>");
    exit;
} 

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("class",   $con);
	
$result = mysql_query("select * from member order by uname", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=0 width=690 align=center>
    <tr><td align=center><font size=3><b>[회원 목록 조회]</b></td></tr>
	<tr><td align=right><font size=2>[<a href=admin.php>Back</a>]</td>
	</tr></table> ");
	   
$i = 0;	

echo ("
	<table border=0 width=690 align=center cellspacing=0>
	<tr height=35 bgcolor=lightgray>
	<td align=center width=60><font size=2><b>ID</b></td>
	<td align=center width=50><font   size=2><b>이름</b></td>
	<td align=center width=340><font size=2><b>주소</b></td>
	<td align=center width=100><font size=2><b>전화번호</b></td>
	<td align=center width=100><font size=2><b>이메일</b></td></tr>
	
");	

while($i < $total):
	$uid = mysql_result($result, $i, "UID");
	$uname = mysql_result($result, $i, "UNAME");
	$zip = mysql_result($result, $i, "ZIPCODE");
	$addr1 = mysql_result($result, $i, "ADDR1");
	$addr2 = mysql_result($result, $i, "ADDR2");
	$mphone = mysql_result($result, $i, "MPHONE");
	$email = mysql_result($result, $i, "EMAIL");
	

	$address = "(" . $zip .   ")" . "&nbsp;" . $addr1 . "&nbsp;" .   $addr2;
	
    echo ("<tr height=30 bgcolor=#FDFABA><td align=center><font size=2>$uid</td>
		<td align=center><font size=2>$uname</td>
		<td><font size=2>$address</td>
		<td align=center><font size=2>$mphone</td>
		<td align=center><font size=2>$email</td></tr>
		<tr bgcolor=#FDFABA><td colspan=5 height=5><hr width=100%></td></tr>");
		
	      
	$i++;
endwhile;

echo ("</table>");
mysql_close($con);
include("bottom.html");
?>
