<head>
<title>참살이반찬</title>
<link rel="shortcut icon" type="image?x-icon" href="/db/shopping/logo.png">
</head>
<?include("top.html");?>
<table border=0 width=700 align=center>
<form method=post action=p-process.php enctype='multipart/form-data'>
<tr height=30>
<td width=150 align=right>상품분류</td>
<td width=550>
	<select name=class>
	<option value=1>반찬 류</option>
	<option value=2>국 류</option>
	</select>
</td>
</tr>
<tr height=30>
<td align=right>상품코드</td>
<td><input type=text name=code size=20></td>
</tr>
<tr height=30>
<td align=right>상품이름</td>
<td><input type=text name=name size=70></td>
</tr>
<tr height=30>
<td align=right>유통기한</td>
<td><textarea name=maxdate rows=1 cols=75 ></textarea></td>
</tr>
<tr height=30>
<td align=right>배송비</td>
<td><textarea name=content rows=1 cols=75 ></textarea></td>
</tr>
<tr height=30>
<td align=right>가격</td>
<td><input type=text name=price1 size=15>원</td>
</tr>
<tr height=30>
<td align=right>상품사진</td>
<td><input type=file size=30 name=userfile></td>
</tr>
<tr height=30>
<td align=right>내용사진</td>
<td><input type=file size=30 name=userfile2></td>
</tr>
<tr height=30>
<td align=center colspan=5>
<input type=submit value=등록하기></td>
</tr>
</form>
</table>
<?include("bottom.html");?>
