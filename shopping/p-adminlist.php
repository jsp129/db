<head>
<title>참살이반찬</title>
<link rel="shortcut icon" type="image?x-icon" href="/db/shopping/logo.png">
</head>
<?
include("top.html");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
	
$result = mysql_query("select * from product order by code", $con);

$total = mysql_num_rows($result);

echo ("<table border=0 width=690 align=center cellspacing=0>
	<tr bgcolor=lightgray><td align=center><font size=2>상품코드</td>
	<td colspan=2 align=center><font size=2>상품명</td>
	<td align=center><font size=2>판매가격</td>
	<td align=center><font size=2>수정/삭제</td></tr>");
							
if (!$total) {

  echo("<tr><td colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");

} else {

	$counter = 0;

	while ($counter < $total) :

		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price1=mysql_result($result,$counter,"price1");

		echo ("
		   <tr bgcolor=#FCFBE9><td width=100 align=center><font size=2>$code</td>
			 <td align=center width=30><img src=./photo/$userfile width=40 height=40 border=0></td>
			   <td width=350 align=left><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td align=right width=70><font size=2>$price1&nbsp;원</td>
			   <td width=70 align=center><font size=2><a href=p-modify.php?code=$code>수정</a>/<a href=p-delete.php?code=$code>삭제</a></td></tr>
			   <tr bgcolor=#FCFBE9><td colspan=5 height=5><hr width=100%></td></tr>");

		$counter++;
	endwhile;
}

echo ("</table>");
	     
mysql_close($con);
include("bottom.html");
?>
