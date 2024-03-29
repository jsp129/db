<head>
<title>레알 김치</title>
<link rel="shortcut icon" type="image?x-icon" href="/db/shopping/logo.png">
</head>
<?include("top.html");?>
<table align=center>
	<tr>
		<td>
			<font size=5><b>공지 등록</b></font>
		</td>
	</tr>
</table>
<table border=0 width=700 align=center>
<form method=post action=gongji-process.php enctype='multipart/form-data'>
<tr height=30>
<td align=right>제목</td>
<td><input type=text name=topic size=73></textarea></td>
</tr>
<tr height=30>
<td align=right>내용</td>
<td><textarea name=content rows=15 cols=75></textarea></td>
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
</table>
<?include("bottom.html");?>