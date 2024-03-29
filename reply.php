<?
include("top.html");
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

// 해당 게시물의 모든 내용을 읽어들임
$result=mysql_query("select * from munui where id=$id",$con);

$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");



// 원본 글 본문의 앞뒤에 구분자 표시
$pre_content=   "\n\n\n--------------< 원본글 >-------------\n" . $content . "\n";	

// 답변 글 입력 폼
echo("<br><br>
	<form method=post action=rprocess.php?uid=$uid&id=$id>
	<table width=700 border=0 align=center>
	<tr>
	<td align=right>제목 </td>
	<td><input type=text name=topic size=60 value='$topic'></td>
	</tr>
	<tr>
	<td align=right>내용 </td>
	<td><textarea name=content rows=12 cols=60>$pre_content</textarea> </td>
	</tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=답변완료>
	<input type=reset value=지우기></td>
	</tr>
	</table>
	</form>
	<br><br>
");

mysql_close($con);
include("bottom.html");
?>
