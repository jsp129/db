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
<tr><td align=center><font size=3><b>��ǰ ���� �ܰ�</b></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>���� ���� ����   ǰ��</td>
</table>
<?
if (!$UserID) {
	echo ("<script>
		window.alert('�α��� ����ڸ� ���� �����մϴ�')
		history.go(-1)
		</script>");
      exit;
} 
if ($quantity < 1 || $quantity > 100) {
	echo ("<script>
		window.alert('�����ϰ��� �ϴ� ������ ������ �ʰ��մϴ�')
		history.go(-1)
		</script>");
      exit;
}
if (!isset($quantity)) $quantity = 1;

$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

// �̹� ���ι鿡 ���� �����̸� ������ ���� 
$result = mysql_query("select * from shoppingbag where session='$Session' and pcode='$code'", $con);
$total = mysql_num_rows($result);

if ($total) $oldnum = mysql_result($result, 0, "quantity");
$wdate = date("Y-m-d-H:i:s");
if ($oldnum) {
     $quantity = $oldnum + $quantity;
     mysql_query("update shoppingbag set quantity=$quantity where   session='$Session' and pcode='$code'", $con);
} else {
     mysql_query("insert into shoppingbag(id, session, pcode, quantity, wdate) values ('$UserID','$Session', '$code', $quantity, '$wdate')", $con);
}

mysql_close($con);	//�����ͺ��̽� ��������

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

// ��ü ���ι� ���̺����� Ư�� ������� ���� �������� �о��
$result = mysql_query("select * from shoppingbag where session='$Session' order by wdate desc", $con);
$total = mysql_num_rows($result);
$result1 = mysql_query("select * from member where uid='$UserID'", $con);

$name = mysql_result($result1, 0, "uname");
$phone = mysql_result($result1, 0, "mphone");
$zip = mysql_result($result1, 0, "zipcode");
$addr1 = mysql_result($result1, 0, "addr1");
$addr2 = mysql_result($result1, 0, "addr2");

echo ("
	<table border=0 width=690 align=center cellspacing=0>
    <tr bgcolor=lightgray><td width=100 align=center><font size=2>��ǰ����</td>
	<td width=300 align=center><font size=2>��ǰ�̸�</td>
	<td width=90 align=center><font size=2>����(�ܰ�)</td>
	<td width=90 align=center><font size=2>���� ����Ʈ</td>	
	<td width=50 align=center><font ssize=2>����</td>
	<td width=100 align=center><font size=2>ǰ���հ�</td></tr>
	");

if (!$total) {
     echo("<tr><td colspan=5 align=center><font   size=2><b>���ι鿡 ��� ��ǰ��   �����ϴ�.</b>
        </font></td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;    // �� ���� �ݾ�  

    
		$pcode = mysql_result($result, 0, "pcode");
		$quantity = mysql_result($result, 0, "quantity");
      
		$subresult = mysql_query("select * from product where code='$pcode'", $con);
		$userfile = mysql_result($subresult, 0, "userfile");
		$pname = mysql_result($subresult, 0, "name");
		$price = mysql_result($subresult, 0, "price1");
		$point = $price/100;
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
		echo("<tr><td align=center><a href=#   onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=50 border=0></a></td>
			<td align=left><font size=2><a href=p-show.php?code=$pcode>$pname</a></td>
			<td align=right><font size=2>$price&nbsp;��</td>
			<td align=center><font size=2>$point&nbsp;p</td>
			<td align=center><font size=2>$quantity&nbsp;��</td>			
			<td align=right><font size=2>$subtotalprice&nbsp;��</td></tr>");

 
     echo("<tr bgcolor=#FEFED8><td colspan=3><font size=2>��밡�� ����Ʈ : $point2 &nbsp;&nbsp; �� ���� ����Ʈ : $totalpoint</td> <td align=right colspan=3><font size=2>�� ���� �ݾ�: $totalprice ��</right></td></tr></table>");
}
	echo("<table align=center width=690 border=0>
			<form method=post action=endshopping.php name=buy>
			<tr bgcolor=#FEFED8>
				<td width=100>
					<font size=2>����� ����Ʈ :
				</td>
				<td>
					
					<input type=text name=usepoint size=10>p
				</td>
			</tr>
		</table>
		");
mysql_close($con);	//�����ͺ��̽� ��������

echo ("<br>
		<table border=0 width=690 align=center>
        <tr><td align=center><font size=2>�Ա� ����: <b>īī����ũ 3333-08-4498444 (������: ������)</b><br><br>
		* �����Ͻ� ��ǰ�� �Ա� Ȯ���� ��۵Ǹ�, �ֹ� ���� ��Ȳ�� �������������� Ȯ���Ͻ� �� �ֽ��ϴ�.<br>
		* ��ǰ ��� ������ �ֹ� ��Ҹ� ���Ͻø� �������������� ���� �ֹ� ��� ��û�� �Ͻø� �˴ϴ�.<br>
		* ��ǰ�� ��� ������ �Ŀ� ���� ��Ҹ� ���Ͻø� ��������(��ȭ:010-7370-6808)�� �����ּ���.
       </td></tr>
       </table>");

echo("
    <br><br>
	<table width=690 border=0 align=center>
	<tr><td align=center><font size=3><b>������� �Է�</b></td></tr>
	<tr><td align=right><input type=checkbox name=chk onClick=send()><small>����� �ּ����� ����</small></td></tr>
	</table>

	<table width=690 border=0 align=center>
	<tr><td align=right><font size=2>�޴���</td>
	<td><input type=text name=receiver size=10></td>
	</tr>
	<tr>
	<td align=right><font size=2>��ȭ��ȣ</td>
	<td><input type=text name=phone   size=20></td>
	</tr>
	<tr><td height=30 align=right><font size=2>����ּ�</td>
	<td align=left><input type=text size=6 name=zip readonly=readonly>
	<font size=2>[<a href='javascript:go_zip()'>������ȣ�˻�</a>]<br>
	<input type=text size=55 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;'>
	<input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;'></td>
	<tr><td align=right><font size=2>�ֹ��䱸����</td>
	<td><textarea name=message rows=3 cols=65></textarea></td></tr>
	<tr><td align=center colspan=2>
	<input type=submit value=���ſϷ�></td></tr>
	</table>
	</form>
	</center>
");
include("bottom.html");
?>