<head>
<title>�����̹���</title>
<link rel="shortcut icon" type="image?x-icon" href="/db/shopping/logo.png">
</head>
<?include("top.html");?>
<table border=0 width=700 align=center>
<form method=post action=p-process.php enctype='multipart/form-data'>
<tr height=30>
<td width=150 align=right>��ǰ�з�</td>
<td width=550>
	<select name=class>
	<option value=1>���� ��</option>
	<option value=2>�� ��</option>
	</select>
</td>
</tr>
<tr height=30>
<td align=right>��ǰ�ڵ�</td>
<td><input type=text name=code size=20></td>
</tr>
<tr height=30>
<td align=right>��ǰ�̸�</td>
<td><input type=text name=name size=70></td>
</tr>
<tr height=30>
<td align=right>�������</td>
<td><textarea name=maxdate rows=1 cols=75 ></textarea></td>
</tr>
<tr height=30>
<td align=right>��ۺ�</td>
<td><textarea name=content rows=1 cols=75 ></textarea></td>
</tr>
<tr height=30>
<td align=right>����</td>
<td><input type=text name=price1 size=15>��</td>
</tr>
<tr height=30>
<td align=right>��ǰ����</td>
<td><input type=file size=30 name=userfile></td>
</tr>
<tr height=30>
<td align=right>�������</td>
<td><input type=file size=30 name=userfile2></td>
</tr>
<tr height=30>
<td align=center colspan=5>
<input type=submit value=����ϱ�></td>
</tr>
</form>
</table>
<?include("bottom.html");?>
