<?
include("top.html");
$result = mysql_query("select * from receivers where id='$UserID' order by buydate desc", $con);
$total = mysql_num_rows($result);

echo ("<br><br>
	<table width=800 border=0 align=center > 
	<tr><td   align=center><b>[���ų���]</b><br><br></td></tr>
	<tr><td>* <font color=red   size=2>�ֹ� ��ǰ�� ��� ���� �ܰ��̸� �¶������� �ֹ�   ��Ұ� �����մϴ�.</td></tr>
	<tr><td>* <font size=2>������̰ų� ���� �Ϸ�� ��ǰ�� ���� ��ǰ �� ȯ�� ��û��     ��� ������(��ȭ: 010-7370-6808)�� ���ǹٶ��ϴ�.<br><br></td></tr>
	</table>

	<table border=1 width=800 align=center cellspacing=0>
	<tr><td align=center><font size=2>���Ź�ȣ</td>
	<td align=center><font size=2>��������</td>
	<td align=center><font size=2>�ֹ�����</td>
	<td align=center><font size=2>�ݾ�</td>
	<td align=center><font size=2>�ֹ�����</td></tr>");	

if ($total > 0) {	
	$counter = 0;
	while($counter < $total) :
		$session = mysql_result($result, $counter, "session");
		$buydate = mysql_result($result, $counter, "buydate");
		$ordernum = mysql_result($result, $counter, "ordernum");
		$status = mysql_result($result, $counter, "status");
		$oldstatus = $status;
	 
		switch ($status) {
		  case 1:
				$status = "�ֹ���û";
				break;
		  case 2:
				$status = "�ֹ�����";
				break;
		  case 3: 
				$status = "����غ���";
				break;
		  case 4:
				$status = "�����";
				break;
		  case 5:
				$status = "��ۿϷ�";
				break;
		  case 6:
				$status = "���ſϷ�";
				break;
		}
	 
		$subresult = mysql_query("select * from orderlist where session='$session'",   $con);
        $subtotal =  mysql_num_rows($subresult);

        $subcounter=0;
        $totalprice=0;

        while ($subcounter <   $subtotal) :
             $pcode = mysql_result($subresult, $subcounter, "pcode");
             $quantity = mysql_result($subresult, $subcounter, "quantity");
      
             $tmpresult = mysql_query("select * from product where code='$pcode'", $con);
             $pname = mysql_result($tmpresult, 0, "name");
			 
			
             $subtotalprice = $quantity * $price;
             $totalprice = $totalprice + $subtotalprice;
             $subcounter++;
			
	
        endwhile;
	
		$items = $subtotal - 1;
	
        echo ("<tr><td align=center><font size=2>
			<a href=# onclick=\"window.open('detailview.php?ordernum=$ordernum', '_new',   'width=940, height=250, scrollbars=yes');\">$ordernum</a></td><td   align=center><font size=2>$buydate</td>
			<td><font size=2>$pname �� $items ��</td><td align=right><font size=2> $totalprice ��</td>
			<td align=center><font size=2>$status");
      
		if ($oldstatus < 4) echo ("<br>(<a href=ordercancel.php?ordernum=$ordernum>�ֹ����</a>)");

		echo ("</td></tr>");

		$counter++;
	endwhile;

} else {

	echo ("<tr><td align=center colspan=5><font size=2><b>�ֹ� ������ �������� �ʽ��ϴ�</b></td></tr>");

}

echo ("</table><br><br>");
include("bottom.html");
?>