<?
include("top.html");
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result=mysql_query("select * from gongji where id=$id",$con);
$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");


echo("<table align=center>
	<tr>
		<td>
			<font size=5><b>공지 수정</b></font>
		</td>
	</tr>
</table>
<table border=0 width=700 align=center>
<form method=post action=mprocess.php?id=$id enctype='multipart/form-data'>
<tr height=30>
<td align=right>제목</td>
<td><input type=text name=topic value='$topic' size=73></textarea></td>
</tr>
<tr height=30>
<td align=right>내용</td>
<td><textarea name=content value='$content' rows=15 cols=75 ></textarea></td>

</tr>
<tr height=30>
<td align=right>내용사진</td>
<td><input type=file size=30 name=userfile></td>
</tr>
<tr height=30>
<td align=center colspan=5>
<input type=submit value=등록하기></td>
</tr>
</form>
</table>");

mysql_close($con);
include("bottom.html");
?>
