<script language='Javascript'>
	function go_zip(){
		window.open('zipcode2.php', 'zipcode',   'width=470, height=180, scrollbars=yes');
	}
	function send(){ 
		var thisForm = document.cheform; 
		var name = $name; 
		var phone = $phone;
		var zip = $zip; 
		var addr1 = $addr1; 
		var addr2 = $addr2; 		
		thisForm.name2.value = name3; 
		thisForm.addres2.value = address; 
	}
</script>
<?include("top.html");?>
<table width=690 border=0 align=center>
<tr><td align=center><font size=3><b>상품 구매 단계</b></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>님의 구입 예정   품목</td>
</table>

<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);
$result1 = mysql_query("select * from member where uid='$UserID'", $con);

$name = mysql_result($result1, 0, "uname");
$phone = mysql_result($result1, 0, "mphone");
$zip = mysql_result($result1, 0, "zipcode");
$addr1 = mysql_result($result1, 0, "addr1");
$addr2 = mysql_result($result1, 0, "addr2");

echo ("
	<table border=0 width=690 align=center cellspacing=0>
    <tr bgcolor=lightgray><td width=100 align=center><font size=2>상품사진</td>
	<td width=300 align=center><font size=2>상품이름</td>
	<td width=90 align=center><font size=2>가격(단가)</td>
	<td width=90 align=center><font size=2>적립 포인트</td>	
	<td width=50 align=center><font ssize=2>수량</td>
	<td width=100 align=center><font size=2>품목별합계</td></tr>
	");

if (!$total) {
     echo("<tr><td colspan=5 align=center><font   size=2><b>쇼핑백에 담긴 상품이   없습니다.</b>
        </font></td></tr></table>");
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
		$point = $totalprice/100;
		$result2 = mysql_query("select * from member where uid='$UserID'", $con);
		$point2 = mysql_result($result2,0,"point");
		$totalpoint = $totalpoint + $point;
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
		echo("<tr bgcolor=#FADFEF><td align=center><a href=#   onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=50 border=0></a></td>
			<td align=left><font size=2><a href=p-show.php?code=$pcode>$pname</a></td>
			<td align=right><font size=2>$price&nbsp;원</td>
			<td align=center><font size=2>$point&nbsp;p</td>
			<td align=center><font size=2>$quantity&nbsp;개</td>
			<td align=right><font size=2>$subtotalprice&nbsp;원</td></tr>");

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
     echo("<tr bgcolor=#FEFED8><td colspan=3><font size=2>사용가능 포인트 : $point2 &nbsp;&nbsp; 총 적립 포인트 : $totalpoint</td> <td align=right colspan=3><font size=2>총 구매 금액: $totalprice 원</right></td></tr></table>");
}
	echo("<table align=center width=690 border=0>
			<form method=post action=endshopping.php name=buy>
			<tr bgcolor=#FEFED8>
				<td width=100>
					<font size=2>사용할 포인트 :
				</td>
				<td>
					
					<input type=text name=usepoint size=10>p
				</td>
			</tr>
		</table>
		");
mysql_close($con);	//데이터베이스 연결해제

echo ("<br>
		<table border=0 width=690 align=center>
        <tr><td align=center><font size=2>입금 계좌: <b>카카오뱅크 3333-08-4498444 (예금주: 박지수)</b><br><br>
		* 구입하신 물품은 입금 확인후 배송되며, 주문 진행 상황은 마이페이지에서 확인하실 수 있습니다.<br>
		* 물품 배송 이전에 주문 취소를 원하시면 마이페이지에서 직접 주문 취소 요청을 하시면 됩니다.<br>
		* 물품을 배송 받으신 후에 구매 취소를 원하시면 고객센터(전화:010-7370-6808)로 연락주세요.
       </td></tr>
       </table>");

echo("
    <br><br>
	<table width=690 border=0 align=center>
	<tr><td align=center><font size=3><b>배송정보 입력</b></td></tr>
	<tr><td align=right><input type=checkbox name=chk onClick=send()><small>사용자 주소지와 동일</small></td></tr>
	</table>

	<table width=690 border=0 align=center>
	<tr><td align=right><font size=2>받는이</td>
	<td><input type=text name=receiver size=10></td>
	</tr>
	<tr>
	<td align=right><font size=2>전화번호</td>
	<td><input type=text name=phone   size=20></td>
	</tr>
	<tr><td height=30 align=right><font size=2>배송주소</td>
	<td align=left><input type=text size=6 name=zip readonly=readonly>
	<font size=2>[<a href='javascript:go_zip()'>우편번호검색</a>]<br>
	<input type=text size=55 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;'>
	<input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;'></td>
	<tr><td align=right><font size=2>주문요구사항</td>
	<td><textarea name=message rows=3 cols=65></textarea></td></tr>
	<tr><td align=center colspan=2>
	<input type=submit value=구매완료></td></tr>
	</table>
	</form>
	</center>
");
include("bottom.html");
?>
