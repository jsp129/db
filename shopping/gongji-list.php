<?
	include("top.html");
	
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	$result = mysql_query("select * from gongji order by id desc", $con);
	$total = mysql_num_rows($result);
	
	echo("
	<table border=0 width=850 align=center cellspacing=0>
		<tr>
			<td colspan=7 align=right>
				<small>Total $total Articles,  of  Pages</small>
			</td>
		</tr>
		<tr bgcolor=lightgray ><td align=center width=50><b>번호</b></td>
			<td align=center width=50></td>
			<td align=center width=400><small><b>제목</b></small></td>
			<td align=center width=100><b>글쓴이</b></td>
			<td align=center width=100><b>날짜</b></td>
			<td align=center width=50><b>조회</b></td>
			<td align=center width=50></td>
		</tr>
	");
	if (!$total){
		echo("
			<tr><td colspan=6 align=center>아직 등록된 글이 없습니다.</td></tr>
		");
	}else {

	if   ($cpage=='') $cpage=1;    // $cpage -  현재 페이지 번호
	$pagesize = 20;                // $pagesize - 한 페이지에 출력할 목록 개수

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
		$date=substr("$wdate",0,10);
		$filename=mysql_result($result,$newcounter,"filename");
		$t="";
		if   ($space>0) {
			for ($i=0 ; $i<=$space ; $i++)
				$t = $t . "&nbsp;";     // 답변 글의 경우 제목 앞 부분에 공백을 채움
		}
		echo("
			<tr><td align=center>$id</td>");
		if(!$filename){
			echo("
			<td align=center><img src='/db/shopping/logo/neo_default.gif'></td>");
		}else{
			echo("
			<td align=center><img src='/db/shopping/logo/neo_jpg.gif'></td>");
		}
		echo("
			<td><a href=gongji-show.php?id=$id><small>$topic</small></a></td>
			<td align=center>banchangage</td>
			<td align=center>$date</td><td align=center>$hit</td>
			<td><font size=2><a href=modify.php?id=$id>[수정]</a>
				<a href=delete.php?id=$id>[삭제]</a></td>
			</tr>
		");
		$counter = $counter + 1;

	endwhile;

	echo("</table>");
	
	echo ("<table border=0 width=800 align=center>
		  <tr><td align=left>");
		   
	// 화면 하단에 페이지 번호 출력
	if ($cblock=='') $cblock=1;   // $cblock - 현재 페이지 블록값
	$blocksize = 5;             // $blocksize - 화면상에 출력할 페이지 번호 개수

	$pblock = $cblock - 1;      // 이전 블록은 현재 블록 - 1
	$nblock = $cblock + 1;     // 다음 블록은 현재 블록 + 1
		
	// 현재 블록의 첫 페이지 번호
	$startpage = ($cblock - 1) * $blocksize + 1;	

	$pstartpage = $startpage - 1;  // 이전 블록의 마지막 페이지 번호
	$nstartpage = $startpage + $blocksize;  // 다음 블록의 첫 페이지 번호

	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("[<a href=gongji-list.php?cblock=$pblock&cpage=$pstartpage>이전블록</a>] ");

	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
	   echo ("[<a href=gongji-list.php?cblock=$cblock&cpage=$i>$i</a>]");
	   $i = $i + 1;
	endwhile;
	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("[<a href=gongji-list.php?cblock=$nblock&cpage=$nstartpage>다음블록</a>] ");

	echo ("</td></tr></table>");
}
	
mysql_close($con);
	
	include("bottom.html");
?>