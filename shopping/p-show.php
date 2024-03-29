<head>
<title>참살이반찬</title>
<link rel="shortcut icon" type="image?x-icon" href="/db/shopping/logo.png">
</head>
<style type="text/css">
#SCROLL { 
    POSITION: absolute;  
    PADDING-BOTTOM: 10pt;  
    MARGIN: 0pt;  
    PADDING-LEFT: 20px;  
    PADDING-RIGHT: 30pt;  
    RIGHT: 0px;  
    PADDING-TOP: 10pt;  
    TOP: 1715px; 
	width:130;
	background-color: #F8ECE0;
	color:gray;
}
</style>
<script type="text/javascript"> 
    var BASE = 150; // 스크롤 시작 위치    
    var RIGHT = 120; // 오른쪽 여백    
    var TOP1 = 300; // 위쪽 여백    
    var TOP2 = 100; // 스크롤시 브라우저 위쪽과 떨어지는 거리    
    var ActiveSpeed = 10;    
    var ScrollSpeed = 50;    
    var Timer;      

    function RefreshM()  
    {     
        var StartPoint, EndPoint;     
        StartPoint = parseInt(document.getElementById('SCROLL').style.top, 10);    
        EndPoint = Math.max(document.documentElement.scrollTop, document.body.scrollTop) + TOP2;     

        if (EndPoint < TOP1) EndPoint = TOP1;     
        if (StartPoint != EndPoint)  
        {      
            ScrollAmount = Math.ceil( Math.abs( EndPoint - StartPoint ) / 15 );                                   
			document.getElementById('SCROLL').style.top = parseInt(document.getElementById('SCROLL').style.top, 10) + (( EndPoint<StartPoint )? -ScrollAmount : ScrollAmount ) + "px";      
            RefreshTimer = ScrollSpeed;      
       } 
       Timer = setTimeout("RefreshM();", ActiveSpeed);    
     }    
    function InitializeM()  
    {    
        document.getElementById('SCROLL').style.right = RIGHT + "px";                              
        document.getElementById('SCROLL').style.top = document.body.scrollTop + BASE + "px";     
        RefreshM(); 
}
 </script>
 <script>
	function mySubmit(index){
		if (index == 1) {
		document.myForm.action='buybuy.php';
		}
		if (index == 2) {
		document.myForm.action='tobag.php';
		}
		
		document.myForm.submit();
	}
</script>
<body onload="InitializeM();">
<div style="position:relative;"> 
<div id="SCROLL">
	<b>반찬 바로가기</b><br><br><small>
	<a href=p-show.php?code=14655201370100>▶잡채</a><br>
	<a href=p-show.php?code=14655164223500>▶즉석두부조림</a><br>
	<a href=p-show.php?code=14654650478500>▶오징어볶음</a><br>
	<a href=p-show.php?code=14655242829900>▶오이도라지무침</a><br>
	<a href=p-show.php?code=14654348253100>▶시금치나물</a><br>
	<a href=p-show.php?code=14655190280700>▶코다리조림</a><br>
	<a href=p-show.php?code=14655160010200>▶메추리알조림</a><br>
	<a href=p-show.php?code=14655281535500>▶매콤고추장진미채</a><br>
	<a href=p-show.php?code=14654611894400>▶감자햄채볶음</a><br>
	<a href=p-show.php?code=14654399753500>▶매콤콩나물무침</a><br>
	<a href=p-show.php?code=14655158454600>▶감자조림</a><br>
	<a href=p-show.php?code=14655187723800>▶소고기장조림</a><br>
	<a href=p-show.php?code=14637091469100>▶소고기뭇국 700g</a><br>
	<a href=p-show.php?code=14637091074400>▶소고기미역국 700g</a><br>
	<a href=p-show.php?code=14637090335600>▶육개장 700g</a><br>
	<a href=p-show.php?code=14637088485600>▶바지락순두부찌개 700g</a><br>
	<a href=p-show.php?code=14637088767200>▶오징어뭇국 700g</a><br>
	<a href=p-show.php?code=14637089987600>▶콩비지찌개 700g</a><br>
	<a href=p-show.php?code=14637090675000>▶아욱국 700g</a><br>
	<a href=p-show.php?code=14637090846500>▶청국장 700g</a><br>
	<a href=p-show.php?code=14637089773000>▶돼지고기김치찌개 700g</a><br>
	<a href=p-show.php?code=15100667807200>▶부대지개(반조리)</a>
	<a href=p-show.php?code=14637089030600>▶콩나물김칫국 700g</a><br></small>
</div> 
</div>

<?
 include ("top.html");
 echo("<br><br>");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result = mysql_query("select * from product where code='$code'", $con);
$total = mysql_num_rows($result);

$name=mysql_result($result,0,"name");
$content=mysql_result($result,0,"content");
$content=nl2br($content);
$maxdate=mysql_result($result,0,"maxdate");
$maxdate=nl2br($maxdate);
$price1=mysql_result($result,0,"price1");
$userfile=mysql_result($result,0,"userfile");
$userfile2=mysql_result($result,0,"userfile2");
// 상품의 조회수를 읽어와서 1 증가시킨 다음 업데이트 쿼리를 적용
$hit=mysql_result($result,0,"hit");
$hit++;
mysql_query("update product set hit=$hit where code='$code'", $con);
echo ("
	<table width=900 border=0 align=center>
    <tr><td width=250 align=center>
	<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=350 border=0></a></td>
    <td width=400 valign=top>
    <table border=0 width=100% cellspacing=0>
	  <tr>
		<td colspan=3><font color=#018A0F>&nbsp;&nbsp;<b>$name</b></font></td>
	  </tr>
	  <tr height=10></tr>
	  <tr bgcolor=lightgray><td align=center width=33%><small>판매가격</small> </td>
	  <td align=center colspan=2><b><small>&nbsp;&nbsp;&nbsp;$price1&nbsp;원</small></b></td></tr>
	  <tr>
			<td align=center height=60>
				<small>유통기한</small>
			</td>
			<td colspan=2><small>$maxdate</small>
			</td>
	  </tr>	 
	 <tr>
			<td align=center height=60>
				<small>배송비</small>
			</td>
			<td colspan=2><small>$content</small>
			</td>
	  </tr>

    	 <tr><td align=center height=60><small>수량</small></td>
		 <td colspan=2>
	     <form method=post name='myForm'>
	     <input type=text size=2 name=quantity value=1>&nbsp;개
	     </td></tr>
		<tr>
			<td colspan=4 align=center>
				<hr>
			</td>
		</tr>
		<tr>
			<td width=50% align=right>
				<input type=image src='/db/shopping/cart.png' width=70 height=70 name=aa value=2 onclick='mySubmit(2);'>
			</td>
			<td></td>
			</td>
			<td width=50%>
			<input type=hidden name=code value=$code>
				<input type=image src='/db/shopping/buy.png' width=70 height=70 name=aa value=1 onclick='mySubmit(1);'>
				
			
		</tr>
		</form>
	</table>
	</td>
	</tr>
	</table>	
	<br>
	<table width=650 border=0 align=center>
		<tr><td align=center>[상품 상세 설명]</td></tr>
		<tr><td></td></tr>
		<tr><td><br><img src='./photo2/$userfile2'></td></tr>
	</table>
");
$result2 =   mysql_query("select * from memojang where code='$code' order by wdate desc", $con);
$total2 =   mysql_num_rows($result2);

echo("
		<form method=post action=memo.php?code=$code enctype='multipart/form-data'>
			<table width=950 border=0 align=center>
				<tr>
					<td colspan=2><small><b>REVIEW</b> │ <font color=gray>악의적인 비방글은 무통보 삭제됩니다.</font></small></td>
				</tr>
				<tr>
					<td colspan=3><textarea name=wmemo rows=8 cols=130></textarea></td>
				</tr>
				<tr>
					<td><input type=file name='userfile' size=45 maxlength=80></td>
					<td align=right><input type=image src='/db/shopping/logo/writing.png' weight=50 height=50></td>
				</tr>
			</table>
		</form>");
echo("	<table width=950 border=0 align=center cellspacing=0>
			<tr>
				<td colspan=2>
				<small><b>REVIEW</b><font color=green>  [$total2]</font></small><br><hr>
				</td>
			</tr>
		</table>");
			


echo("<table align=center>");
if (!$total2)   {
	echo ("<table align=center border=1 width=950 height=50 cellspacing=0 bordercolor=#E0E0E0>
		<tr><td align=center colspan=4>등록된 리뷰가 없습니다</td></tr></table>");
} 
else{

	if   ($cpage=='') $cpage=1;    // $cpage -  현재 페이지 번호
	$pagesize = 5;                // $pagesize - 한 페이지에 출력할 목록 개수

	$totalpage = (int)($total2/$pagesize);
	if (($total2%$pagesize)!=0) $totalpage = $totalpage + 1;
	
	$i = 0;	
	while ( $i   < $pagesize ) :
		$counter = $pagesize * ($cpage - 1) + $i;
		if ($counter == $total2) break;
		$id= mysql_result($result2, $counter, "id");
		$name = mysql_result($result2, $counter, "name");
		$wdate = mysql_result($result2, $counter, "wdate");
		$date=substr($wdate,0,16);
		$message = mysql_result($result2, $counter, "message");
		$userfile=mysql_result($result2, $counter,"userfile");
		
		echo ("
			<table width=950 border=0 align=center cellspacing=0>
			<tr>
				<td rowspan=2 width=250 height=200 valign=top align=center bgcolor=#FDFBEE>
					<font color=gray>작성자</font><br>
					$name <br> ($id)
					<hr><font color=gray>작성일</font><br>
					$wdate<br>
				</td>
				<td height=130 valign=top margin=5>
					$message
				</td>
				<td width=150 align=center valign=top>
					<a href=cdelete.php?code=$code&id=$id&date=$wdate>삭제</a>
				</td>
			</tr>
			<tr>
				<td height=100 colspan=2>
				");
				if(!$userfile){
					echo("");
				}else{
				echo("<a href=# onclick=\"window.open('./memo/$userfile', '_new', 'width=450, height=450')\"><img src='./memo/$userfile' width=100 border=0></a>");}
				echo("				
				</td>
			</tr>
			<tr>
				<td colspan=3>
					<hr>
				</td>
			</tr>
			
		</table>
		");
		$i++;
	endwhile;
	echo ("</table>");	
	echo ("<table border=0 width=900 align=center>
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
		echo ("<a href=p-show.php?code=$code&cblock=$pblock&cpage=$pstartpage>◀ </a> ");
	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함\
	   if ($i == $cpage){
			echo ("<a href=p-show.php?code=$code&cblock=$cblock&cpage=$i><font color=red><b>[$i]</b></font></a>");
	   }else {
			echo ("<a href=p-show.php?code=$code&cblock=$cblock&cpage=$i><b>[$i]</b></a>");
	   }
	   $i = $i + 1;
	endwhile;	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("<a href=p-show.php?code=$code&cblock=$nblock&cpage=$nstartpage> ▶</a> ");
	echo ("</td></tr></table>");
}


include ("bottom.html");
mysql_close($con);

?>
