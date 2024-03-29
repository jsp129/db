<?
include("top.html");
if (!$key) {
	echo("<script>
		window.alert('검색어를 입력하세요');
		history.go(-1);
		</script>");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result=mysql_query("select * from product where name like '%$key%'",$con);
$total = mysql_num_rows($result);

echo("
   <table border=0 width=700 align=center>
   <tr><td><small>검색어:$key , 찾은 개수:$total 개</small></td>
   <td align=right><a href=index.html><small>[전체목록]</small></a></td></tr>
   </table>
");

echo ("<table border=0 width=1000 align=center cellspacing=20><tr>");

if (!$total){
	echo ("<td align=center><font color=red>아직 등록된 상품이 없습니다</td>");
} else {

	$counter=0;

	while($counter<$total):

		if ($counter > 0 && ($counter % 4) == 0) echo ("</tr><tr><td colspan=4></td></tr><tr>");
		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price2=mysql_result($result,$counter,"price1");
		$result2 = mysql_query("select * from memojang where code='$code'", $con);
		$total2 = mysql_num_rows($result2);

	
		switch(strlen($price2)) {
		  case 6: 
			 $price2 = substr($price2, 0, 3) . "," . substr($price2, 3, 3);
			 break;
		  case 5:
			 $price2 = substr($price2, 0, 2) . "," . substr($price2, 2, 3);
			 break;
		  case 4:
			 $price2 = substr($price2, 0, 1) . "," . substr($price2, 1, 3);
			 break;		   
		}
		
		echo ("	
				<td width=200 align=center>
				<font color=green size=2 align=left>[상품리뷰:$total2]</font><br>
				<a href=p-show.php?code=$code><img src='./photo/$userfile' width=300 border=0></a><br>
				<font style='text-decoration:none; font-size:10pt;'>$name</font><br>");
		echo ("<font color=green size=2>$price2&nbsp;원</font><hr size=1 color=#EEEDED width=100%></td>");

		$counter = $counter + 1;

	endwhile;

	echo("</table>");
}

mysql_close($con);
include("bottom.html");

?>
