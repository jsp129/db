<?



$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

// 답변 글은 원본 글보다 깊이가 1 증가됨
$result=mysql_query("select space from munui where id=$id", $con);
$space=mysql_result($result, 0, "space");
$space=$space+1;
$wdate=date("Y-m-d-H:i:s"); // 단변 글을 쓴 날짜 저장

// 답변글이 추가되면 글의 개수가 하나 증가하므로 글 번호를 정리
$tmp = mysql_query("select id from munui", $con);
$total = mysql_num_rows($tmp);

while($total >= $id):
	mysql_query("update munui set id=id+1 where id=$total", $con);
	$total--;
endwhile;

// 원래 글 번호 위치에 답변 글을 삽입함
mysql_query("insert into munui(uid, id, writer, passwd, topic, content, hit, wdate, space) values ('$uid', $id, '관리자', '$passwd', '$topic','$content', 0, '$wdate',   $space)", $con);

mysql_close($con);

echo("<meta http-equiv='Refresh' content='0; url=munui-list.php'>");

?>
