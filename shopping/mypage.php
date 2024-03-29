<script   language='Javascript'>
function passwordCheckk(){
	var password = document.getElementById("password").value;
	var passwordCheck = document.getElementById("passwordCheck").value;
	if ( passwordCheck == ""){  
		   document.getElementById("passwordCheckText").innerHTML = "" 
	} 
	else if ( password != passwordCheck ){
		document.getElementById("passwordCheckText").innerHTML = "<font color=red size=1pt> 비밀번호가 일치하지 않습니다.. </font>"
	}else{
		document.getElementById("passwordCheckText").innerHTML = "<font color=red size=1pt> 비밀번호가 일치합니다. </font>"	
	}
}

function   id_check() {
var id = document.comma.uid.value;
if (id.length < 5) {
	window.alert('ID는 5글자 이상 입력해주세요');
} else {
	window.open('id_check.php?id=' + id, 'IDCHECK', 'width=450, height=180, scrollbars=yes');
}
}

function   go_zip() {
window.open('zipcode.php','ZIP','width=470, height=180, scrollbars=yes');
}
</script>
<?
include("top.html");
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("class",   $con);
$result = mysql_query("select * from member where uid='$UserID'", $con);
	
$uid = mysql_result($result, 0,   "UID");
$uname = mysql_result($result, 0,   "UNAME");
$email = mysql_result($result, 0,   "EMAIL");
$zip = mysql_result($result, 0,   "ZIPCODE");
$addr1 = mysql_result($result, 0,   "ADDR1");
$addr2 = mysql_result($result, 0,   "ADDR2");
$mphone = mysql_result($result, 0,   "MPHONE");
$point= mysql_result($result, 0,   "point");
?>
<br><br>
<table width=800 border=0 align=center>
<tr><td align=left><b>회원 정보 수정</b><br><hr><br></td></tr>
<tr><td align=left><font size=3><b>회원정보</b></font></td></tr>
</table>
<form action=register2.php method=post name=comma>
<table border=1 width=800 height=450 align=center cellspacing=0 bordercolor=#E0E0E0>
	<tr>
		<td>
			<table border=0 width=700 align=center height=300 cellspacing=0>
				<tr>
					<td width=120 ><font size=2><font color=orange>*</font>이름</font></td>
					<td width=120><font size=2><? echo("$uname"); ?></td>
				</tr>
				<tr height=2>
					<td colspan=2><hr></td>
				</tr>
				<tr>
					<td ><font size=2 ><font color=orange>*</font>아이디</font></td>
					<td><font size=2><? echo("$UserID"); ?></td>
				</tr>
				<tr height=2>
					<td colspan=2><hr></td>
				</tr>
				<tr>
				<tr>
					<td ><font size=2 ><font color=orange>*</font>비밀번호</font></td>
					<td><font size=2><input type=password maxlength=15 style="height:20;" size=20 name=upass1 id=password><span><font size=1 color=gray>  비밀번호는 4~16자로 입력해 주세요. </font></span></td>
				</tr>
				<tr height=2>
					<td colspan=2><hr></td>
				</tr>
				<tr>
				<tr>
					<td ><font size=2 ><font color=orange>*</font>비밀번호 확인</font></td>
					<td><font size=2><input type=password   maxlength=15 style="height:20;" size=20 name=upass2 id=passwordCheck style="background-color: #e2e2e2;" onkeyup=passwordCheckk()><span id=passwordCheckText></span></td>
				</tr>
				<tr height=2>
					<td colspan=2><hr></td>
				</tr>
				<tr>
				<tr>
					<td width=80 ><font size=2><font color=orange>*</font>휴대전화</font></td>
					<td width=140><font size=2><input type=text size=20 name=mphone value=<? echo ("$mphone"); ?>></td>
				</tr>
				<tr height=2>
					<td colspan=2><hr></td>
				</tr>
				<tr>
				<tr>
					<td width=80 ><font size=2><font color=orange>*</font>이메일</font></td>
					<td width=170><font size=2><input type=text size=30 name=email value=<? echo ("$email"); ?>></td></tr>
				</tr>
				<tr height=2>
					<td colspan=2><hr></td>
				</tr>
				<tr>
				<tr>
					<td height=30 ><font size=2><font color=orange>*</font>집주소</font></td>
					<td><input type=text size=7 name=zip value=<?echo("$zip");?> readonly=readonly> <font size=2>[<a   href='javascript:go_zip()'>우편번호검색</a>]</font><br>
						<input type=text size=50 name=addr1 value=<?echo("'$addr1'");?> readonly=readonly><br><input type=text size=35 name=addr2 value=<?echo("'$addr2'");?>> </td>
				</tr>
				<tr height=2>
					<td colspan=2><hr></td>
				</tr>
				<tr>
					<td height=30 ><font size=2><font color=orange>*</font>보유 포인트</font></td>
					<td>
						<?echo("<font size=2>$point p");?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br><br>
<table align=center width=200 height=30 border=0>
	<tr align=center>
		<td><input type='image' src=/db/shopping/logo/modify.gif></td>
		<td><a href=index.html><img src=/db/shopping/logo/back.gif></a></td>
	</tr>
</table>

<br><br>

<?

mysql_close($con);	
include("bottom.html");
?>
