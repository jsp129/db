<?
include("top.html");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result = mysql_query("select * from munui order by id desc", $con);
$total = mysql_num_rows($result);
echo("
	<table border=0 width=800 align=center cellspacing=0>
		<tr>
			<td colspan=6 align=right>
				<small>Total $total Articles,  of  Pages</small>
			</td>
		</tr>
		<tr bgcolor=lightgray ><td align=center width=50><b><small>��ȣ</b></td>
			<td align=center width=50></td>
			<td align=center width=400><b><small>����</small></b></td>
			<td align=center width=100><b><small>�۾���</small></b></td>
			<td align=center width=100><b><small>��¥</small></b></td>
			<td align=center width=50><b><small>��ȸ</small></b></td>
		</tr>
	");
if (!$total){
	echo("
		<tr><td colspan=6 align=center>���� ��ϵ� ���� �����ϴ�.</td></tr>
	");
}else {

	if   ($cpage=='') $cpage=1;    // $cpage -  ���� ������ ��ȣ
	$pagesize = 20;                // $pagesize - �� �������� ����� ��� ����

	$totalpage = (int)($total/$pagesize);
	if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

	$counter=0;

	while($counter<$pagesize):
		$newcounter=($cpage-1)*$pagesize+$counter;
		if ($newcounter == $total) break;
		

		$id=mysql_result($result,$newcounter,"id");
		$uid=mysql_result($result,$newcounter,"uid");
		$writer=mysql_result($result,$newcounter,"writer");
		$topic=mysql_result($result,$newcounter,"topic");
		$passwd=mysql_result($result,$newcounter,"passwd");
		$hit=mysql_result($result,$newcounter,"hit");
		$wdate=mysql_result($result,$newcounter,"wdate");
		$space=mysql_result($result,$newcounter,"space");
		$filename=mysql_result($result,$newcounter,"filename");
		$date=substr("$wdate",0,10);
		$t="";

		if   ($space>0) {
			for ($i=0 ; $i<=$space ; $i++)
				$t = $t . "&nbsp;";     // �亯 ���� ��� ���� �� �κп� ������ ä��
		}
		echo("
			<tr><td align=center>$id</td>
			<td align=center><img src='/db/shopping/logo/lock.gif'></td>");
		if($writer!='������'){
			echo("
			<td><a href=munui-show.php?id=$id&uid=$uid><img src='/db/shopping/logo/question.gif'><small>$topic</small></a></td>");
		}else{
			echo("
			<td><a href=munui-show.php?id=$id&uid=$uid><img src='/db/shopping/logo/answer.gif'><small>$topic</small></a></td>");
		}
		if($writer=='������'){
		echo("
			<td align=center><img src='/db/shopping/logo/boardicon_yb1880.gif'></td>");
		}else{
			echo("
			<td align=center><small>$writer</small></td>");
		}
		echo("
			<td align=center><small>$date</td><td align=center><small>$hit</small></td>
			</tr>
		");
		$counter = $counter + 1;

	endwhile;

	echo("</table>");
	
	echo ("<table border=0 width=750 align=center>
		  <tr><td align=left>");
		   
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
		echo ("[<a href=munui.php?cblock=$pblock&cpage=$pstartpage>�������</a>] ");

	// ���� ��Ͽ� ���� ������ ��ȣ�� ���	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // ������ �������� ��������� ������
	   echo ("<a href=munui.php?cblock=$cblock&cpage=$i><small>[$i]</a>");
	   $i = $i + 1;
	endwhile;
	 
	// ���� ����� ���� �������� ��ü ������ ������ ������ [�������] ��ư Ȱ��ȭ  
	if ($nstartpage <= $totalpage)   
		echo ("[<a href=munui.php?cblock=$nblock&cpage=$nstartpage>�������</a>] ");

	echo ("</td></tr></table>");
}
	
mysql_close($con);




include("bottom.html");
?>