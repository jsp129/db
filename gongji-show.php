
<script>
function clearText(thefield){
if (thefield.defaultValue==thefield.value)
        thefield.value = ""
		thefield.type = "password"
} 
function clearText1(thefield){
if (thefield.defaultValue==thefield.value)
        thefield.value = ""
} 

</script>
<?
include ("top.html");
echo("<br><br>");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result = mysql_query("select * from gongji where id=$id", $con);
$total = mysql_num_rows($result);
$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");
$wdate=mysql_result($result,0,"wdate");
$date=substr("$wdate",0,10);
$userfile=mysql_result($result,0,"filename");

// ��ǰ�� ��ȸ���� �о�ͼ� 1 ������Ų ���� ������Ʈ ������ ����
$hit=mysql_result($result,0,"hit");
$hit++;
mysql_query("update gongji set hit=$hit where id=$id", $con);
echo("<table width=1000 border=0 align=center cellspacing=0>
		<tr bgcolor=lightgray>
			<td height=35>
				&nbsp;<small><b>$topic</b></small>
			</td>
			<td align=right>
				<small>realkimchi</small> &nbsp;
			</td>
		</tr>		
		<tr>
			<td colspan=2 align=right height=30>
				<small>post at $date</small>
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<hr width=100%>
			</td>
		</tr>
		<tr>
			<td colspan=2 align=center>
				<br>
				 $content
			</td>
		</tr>
		<tr>
			<td colspan=2 align=center>
				 <img src='./gongji/$userfile'>
			</td>
		</tr>
	</table>
	<br>
	");
	echo("<hr width=1000>");
	
	$result1 = mysql_query("select * from gongjimemo where id=$id order by wdate desc", $con);
	$total1 = mysql_num_rows($result1);
	
	if (!$total1)   {
	echo ("<table align=center border=1 width=1000 height=50 cellspacing=0 bordercolor=#E0E0E0>
		<tr><td align=center colspan=4>��ϵ� ����� �����ϴ�</td></tr></table>");
	} 
	else{
		if ($cpage=='') $cpage=1;    // $cpage -  ���� ������ ��ȣ
		$pagesize = 5;                // $pagesize - �� �������� ����� ��� ����

		$totalpage = (int)($total1/$pagesize);
		if (($total1%$pagesize)!=0) $totalpage = $totalpage + 1;
		
		$i = 0;	
		echo("<table width=1000 border=0 align=center cellspacing=0>");
		while ( $i   < $pagesize ) :
			$counter = $pagesize * ($cpage - 1) + $i;
			if ($counter == $total1) break;
			$name = mysql_result($result1, $counter, "name");
			$wdate = mysql_result($result1, $counter, "wdate");
			$date=substr($wdate,0,10);
			$message = mysql_result($result1, $counter, "message");				
			echo ("				
				<tr >
					<td width=100 align=right>
						<font color=#A4A2A2><small>$name </small>��</font>
					</td>
					<td width=750>
						&nbsp;<small>$message</small>
					</td>
					<td width=150 align=center>
						<small>$date<br>
						<a href=gongjimemo-delete.php?id=$id&wdate=$wdate>����</a></small>
					</td>
				</tr>
				<tr>
					<td colspan=3><hr></td>
				</tr>
				
			");
			$i++;
		endwhile;
		echo ("</table>");	
		echo ("<table border=0 width=1000 align=center>
			  <tr><td align=center>");		   
		// ȭ�� �ϴܿ� ������ ��ȣ ���
		if ($cblock=='') $cblock=1;   // $cblock - ���� ������ ��ϰ�
		$blocksize = 5;             // $blocksize - ȭ��� ����� ������ ��ȣ ����
		$pblock = $cblock - 1;      // ���� ����� ���� ��� - 1
		$nblock = $cblock + 1;     // ���� ����� ���� ��� + 1		
		// ���� ����� ù ������ ��ȣ
		$startpage = ($cblock - 1) * $blocksize + 1;	
		$pstartpage = $startpage - 1;  // ���� ����� ������ ������ ��ȣ
		$nstartpage = $startpage + $blocksize;  // ���� ����� ù ������ ��ȣ
		if ($pblock > 0)        // ���� ����� �����ϸ� [�������] ��ư�� Ȱ��ȭ
			echo ("<a href=gongji-show.php?id=$id&cblock=$pblock&cpage=$pstartpage>�� </a> ");
		// ���� ��Ͽ� ���� ������ ��ȣ�� ���	
		$i =   $startpage;
		while($i < $nstartpage):
		   if ($i > $totalpage) break;  // ������ �������� ��������� ������\
		   if ($i == $cpage){
				echo ("<a href=gongji-show.php?id=$id&cblock=$cblock&cpage=$i><font color=red><b>[$i]</b></font></a>");
		   }else {
				echo ("<a href=gongji-show.php?id=$id&cblock=$cblock&cpage=$i><b>[$i]</b></a>");
		   }
		   $i = $i + 1;
		endwhile;	 
		// ���� ����� ���� �������� ��ü ������ ������ ������ [�������] ��ư Ȱ��ȭ  
		if ($nstartpage <= $totalpage)   
			echo ("<a href=gongji-show.php?id=$id&cblock=$nblock&cpage=$nstartpage> ��</a> ");
		echo ("</td></tr></table>");
	}

	echo("<br><br><table width=1000 align=center border=0>
			<form method=post action=gongji-memo.php?id=$id align=center>
			<tr>
				<td>				
				<font  size=2>�̸�</font>
				<input type=text size=10 name=name value=�̸� style=background-color:#FAF9F9; onFocus=clearText1(this)>
				<font  size=2>��й�ȣ</font>
				<input type=text size=15 maxlength=100 name=passwd value=��й�ȣ style=background-color:#FAF9F9; onFocus=clearText(this)>
				</td>
			</tr>
			<tr>
				<td>
				<textarea name=content rows=4 cols=120 value=���� style=background-color:#FAF9F9; onFocus=clearText1(this)></textarea>
				<input type=image src='/db/shopping/logo/board_btn_review.gif' name=submit value=Submit width=90>			
				</td>
			</tr>
			</form>
		</table><br><br>");
include ("bottom.html");
mysql_close($con);
?>