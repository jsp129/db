<style type="text/css">

	#cont{
	position : absolute;
	left: 15%;
	top: 200;
	}
	#float_layer{
	top: 30px;
	margin-right: 10px;
	text-align: center;
	}
</style>

<?

include("top.html");
	
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	$result = mysql_query("select * from gongji order by id desc", $con);
	$total = mysql_num_rows($result);
	
	echo("
	<table border=0 width=800 align=center cellspacing=0>
		<tr>
			<td colspan=6 align=right>
				<small>Total $total Articles</small>
			</td>
		</tr>
		<tr bgcolor=#cce6c3 ><td align=center width=50><b><small>��ȣ</b></td>
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
		$topic=mysql_result($result,$newcounter,"topic");
		$hit=mysql_result($result,$newcounter,"hit");
		$wdate=mysql_result($result,$newcounter,"wdate");
		$space=mysql_result($result,$newcounter,"space");
		$filename=mysql_result($result,$newcounter,"filename");
		$date=substr("$wdate",0,10);
		$t="";
		$result2 = mysql_query("select * from gongjimemo where id=$id", $con);
		$total2 = mysql_num_rows($result2);

		if   ($space>0) {
			for ($i=0 ; $i<=$space ; $i++)
				$t = $t . "&nbsp;";     // �亯 ���� ��� ���� �� �κп� ������ ä��
		}
		echo("
			<tr><td align=center>$id</td>
			");
		if(!$filename){
			echo("
			<td align=center><img src='/db/shopping/logo/neo_default.gif'></td>");
		}else{
			echo("
			<td align=center><img src='/db/shopping/logo/neo_jpg.gif'></td>");
		}
		if(!$total2){
			echo("<td><a href=gongji-show.php?id=$id><small>$topic</small></a></td>");
		}
		else{
			echo("
			<td><a href=gongji-show.php?id=$id><small>$topic [$total2]</small></a></td>");
		}
		echo("
			<td align=center><small>realkimchi</small></td>
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
		echo ("[<a href=gongji.php?cblock=$pblock&cpage=$pstartpage>�������</a>] ");

	// ���� ��Ͽ� ���� ������ ��ȣ�� ���	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // ������ �������� ��������� ������
	   echo ("<a href=gongji.php?cblock=$cblock&cpage=$i><small>[$i]</a>");
	   $i = $i + 1;
	endwhile;
	 
	// ���� ����� ���� �������� ��ü ������ ������ ������ [�������] ��ư Ȱ��ȭ  
	if ($nstartpage <= $totalpage)   
		echo ("[<a href=gongji.php?cblock=$nblock&cpage=$nstartpage>�������</a>] ");

	echo ("</td></tr></table>");
}
	
mysql_close($con);
	
	include("bottom.html");


echo("
<div id=cont>
<div id=float_layer valign=top>
<img src=/db/shopping/logo/notice.png width=120 height=120>
</div>
</div>
");


?>