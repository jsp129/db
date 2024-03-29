<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result = mysql_query("select * from product where code='$code'", $con);
$total = mysql_num_rows($result);

$name=mysql_result($result,0,"name");
$content=mysql_result($result,0,"content");
$content=nl2br($content);

$price1=mysql_result($result,0,"price1");
$price2=mysql_result($result,0,"price2");
$userfile=mysql_result($result,0,"userfile");

echo ("
	<table width=650 border=0 align=center>
    <tr><td width=250 align=center>
	<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=150 border=1></a></td>
    <td width=400 valign=top>
    <table border=0 width=100%>
	  <tr><td width=80 align=center>상품코드: </td>
	  <td width=320>&nbsp;&nbsp;$code</td></tr>
	  <tr><td align=center>상품이름: </td>
	  <td>&nbsp;&nbsp;$name</td></tr>
	  <tr><td align=center>상품가격: </td>
	  <td>&nbsp;&nbsp;<strike>$price1&nbsp;원</strike></td></tr>
	  <tr><td align=center>할인가격: </td>
	  <td>&nbsp;&nbsp;<b>$price2&nbsp;원</b></td></tr>
    	  <tr><td colspan=2 height=100 valign=bottom align=center>
	     <form method=post action=tobag.php?code=$code>
	     <input type=text size=3 name=quantity value=1>&nbsp;
	     <input type=submit value=담기>
	     </td></tr></form>
	</table>
	</td>
	</tr>
	</table>	
	<br>
	<table width=650 border=0 align=center>
	<tr><td align=center>[상품 상세 설명]</td></tr>
	<tr><td><hr size=1></td></tr>
	<tr><td>$content</td></tr>
	</table>
");
			 
mysql_close($con);

?>
