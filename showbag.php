<?
if (!isset($UserID)) {
	echo ("<script>
		window.alert('로그인 사용자만 이용하실 수 있어요')
		history.go(-1)
		</script>");
	exit;
}
include("top.html");
?>
<br><br>
<table width=690 border=0 align=center>
<tr><td align=center><font size=3><b>쇼핑 카트</b><br><br></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>님의 현재 쇼핑 카트 내용</td>
</table>

<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=0 width=690 align=center cellspacing=0>
    <tr bgcolor=lightgray><td width=100 align=center><font size=2>상품사진</td>
	<td width=300 align=center><font size=2>상품이름</td>
	<td width=90 align=center><font size=2>가격(단가)</td>
	<td width=50 align=center><font size=2>수량</td>
	<td width=100 align=center><font size=2>품목별합계</td>
	<td width=50 align=center><font size=2>삭제</td></tr>
");

if (!$total) {
     echo("<tr><td colspan=6 align=center height=50><font size=2>쇼핑백에 담긴 상품이 없습니다.</td></tr></table><br><br>");
} else {

    $counter=0;
    $totalprice=0;    // 총 구매 금액  

    while ($counter < $total) :
       $pcode = mysql_result($result, $counter, "pcode");
       $quantity = mysql_result($result, $counter, "quantity");
   
       $subresult = mysql_query("select * from product where code='$pcode'", $con);
       $userfile = mysql_result($subresult, 0, "userfile");
       $pname = mysql_result($subresult, 0, "name");

       $price = mysql_result($subresult, 0, "price1");
       
       $subtotalprice = $quantity * $price;
       $totalprice = $totalprice + $subtotalprice; 
	   
		switch(strlen($subtotalprice)) {
		  case 6: 
			 $subtotalprice = substr($subtotalprice, 0, 3) . "," . substr($subtotalprice, 3, 3);
			 break;
		  case 5:
			 $subtotalprice = substr($subtotalprice, 0, 2) . "," . substr($subtotalprice, 2, 3);
			 break;
		  case 4:
			 $subtotalprice = substr($subtotalprice, 0, 1) . "," . substr($subtotalprice, 1, 3);
			 break;		   
		}
		switch(strlen($price)) {
		  case 6: 
			 $price = substr($price, 0, 3) . "," . substr($price, 3, 3);
			 break;
		  case 5:
			 $price = substr($price, 0, 2) . "," . substr($price, 2, 3);
			 break;
		  case 4:
			 $price = substr($price, 0, 1) . "," . substr($price, 1, 3);
			 break;		   
		}
		echo ("<tr><td align=center>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=50   border=0></a></td>
			<td align=left><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
			<td align=right><font size=2>$price&nbsp;원</td>
			<td align=center>
			<form method=post action=qmodify.php?pcode=$pcode><input type=text name=newnum size=3 value=$quantity>&nbsp;<input type=submit value=변경>
			</td></form>
			<td align=right><font size=2>$subtotalprice&nbsp;원</td>
			<td align=center>
			<form method=post action=itemdelete.php?pcode=$pcode><input type=submit value=삭제></td></form>
			</tr>");

		$counter++;
    endwhile;
 	switch(strlen($totalprice)) {
		  case 6: 
			 $totalprice = substr($totalprice, 0, 3) . "," . substr($totalprice, 3, 3);
			 break;
		  case 5:
			 $totalprice = substr($totalprice, 0, 2) . "," . substr($totalprice, 2, 3);
			 break;
		  case 4:
			 $totalprice = substr($totalprice, 0, 1) . "," . substr($totalprice, 1, 3);
			 break;		   
		}
     echo("<tr><td colspan=6 align=right><font size=2>총 구매 금액: $totalprice 원</td></tr></table><br><br>");

}

mysql_close($con);	//데이터베이스 연결해제

echo ("<table width=690 border=0 align=center>
	<tr><td align=center><font size=2><a href=buy.php><img src='/db/shopping/logo/go.png'></a> &nbsp; <a href=p-list.php><img src='/db/shopping/logo/continue.png'></a></td></tr></table><br><br>");

include("bottom.html");
?>
