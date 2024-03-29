<?
include ("top.html");
echo("<br><br>");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result = mysql_query("select * from munui where id=$id", $con);
$total = mysql_num_rows($result);
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");
$wdate=mysql_result($result,0,"wdate");
$date=substr("$wdate",0,10);
$userfile=mysql_result($result,0,"filename");
$userid= mysql_result($result,0,"uid");
$result2=mysql_query("select * from member where uid='$UserID'",$con);
$uid=mysql_result($result2,0,"uid");

if($uid=='admin'){
}else if($uid != $userid){
	echo("
		<script>
		window.alert('다른 회원의 글입니다.')
		history.go(-1)
		</script>
	");
	exit;
}

// 상품의 조회수를 읽어와서 1 증가시킨 다음 업데이트 쿼리를 적용
$hit=mysql_result($result,0,"hit");
$hit++;
mysql_query("update munui set hit=$hit where id=$id", $con);
echo("<table width=1000 border=0 align=center cellspacing=0>
		<tr bgcolor=lightgray>
			<td height=35>
				&nbsp;<small><b>$topic</b></small>
			</td>
			<td align=right>
				<small>$writer</small> &nbsp;
			</td>
		</tr>		
		<tr>
			<td colspan=2 align=right height=30>
				<small>post at $date</small>
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<hr width=100%>
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<br>
				 $content
			</td>
		</tr>");
		if($userfile){
		echo("
		<tr>
			<td colspan=2 align=center>
				 <img src='./munui/$userfile'>
			</td>
		</tr>
		");
		}
		echo("
	</table>
	<br>
	");
	echo("<hr width=1000>");
	if($UserID == 'admin'){
		echo("<table border=0 align=center width=1000>
				<tr>
					<td align=right>
						<a href=reply.php?id=$id&uid=$userid>[답변하기]</a>
					</td>
				</tr>
			</table>
		");
	
	}
	
	

	
include ("bottom.html");
mysql_close($con);
?>