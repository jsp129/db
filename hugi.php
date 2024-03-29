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
$result = mysql_query("select * from product order by code", $con);
$total = mysql_num_rows($result);

echo ("<table border=0 width=00 align=center cellspacing=20><tr>");
if (!$total){
	echo ("<td align=center><font color=red>아직 등록된 상품이 없습니다</td>");
} else {

	$counter = 0;

	while ($counter < $total) :
		
		if ($counter > 0 && ($counter % 4) == 0) echo ("</tr><tr><td colspan=4></td></tr><tr>");
		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price2=mysql_result($result,$counter,"price1");
		$result2 = mysql_query("select * from memojang where code='$code' order by userfile desc", $con);
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
				<td width=200 valign=top >
				<font color=green size=2 align=left><center>[상품리뷰:$total2]</center></font>
				<a href=p-show.php?code=$code><img src='./photo/$userfile' width=200 border=0></a><br>
				<font style='text-decoration:none; font-size:10pt;'><center>$name</center></font>");
		echo ("<font color=green size=2><center>$price2&nbsp;원</center></font><hr size=1 color=#EEEDED width=100%>");
		if(!$total2){
			echo("<small>등록된 상품 후기가 없습니다.</small><hr></td>");
		}else{
			$i=0;
			if($total2>4) $total2=3;
			while($i<$total2):
				$filename=mysql_result($result2,$i,"userfile");
				$message=mysql_result($result2,$i,"message");
				if($filename){
				echo("<img src='/db/shopping/memo/$filename' width=30 > $message <hr>");
				}else{
					echo(" $comment <hr>");
				}
			$i++;
		endwhile;
		}
		echo("</td>");

		$counter++;
	endwhile;
}

echo ("</tr></table>");


echo("
<div id=cont>
<div id=float_layer>
<img src=/db/shopping/logo/review1.png width=150 heigth=150>
</div>
</div>
");

include("bottom.html");
?>