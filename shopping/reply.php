<?
include("top.html");
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

// �ش� �Խù��� ��� ������ �о����
$result=mysql_query("select * from munui where id=$id",$con);

$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");



// ���� �� ������ �յڿ� ������ ǥ��
$pre_content=   "\n\n\n--------------< ������ >-------------\n" . $content . "\n";	

// �亯 �� �Է� ��
echo("<br><br>
	<form method=post action=rprocess.php?uid=$uid&id=$id>
	<table width=700 border=0 align=center>
	<tr>
	<td align=right>���� </td>
	<td><input type=text name=topic size=60 value='$topic'></td>
	</tr>
	<tr>
	<td align=right>���� </td>
	<td><textarea name=content rows=12 cols=60>$pre_content</textarea> </td>
	</tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=�亯�Ϸ�>
	<input type=reset value=�����></td>
	</tr>
	</table>
	</form>
	<br><br>
");

mysql_close($con);
include("bottom.html");
?>
