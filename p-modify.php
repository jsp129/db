<!-- include libraries(jQuery, bootstrap) -->
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  
  <!-- include summernote css/js -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

  <!-- summernote 실행 및 기본설정 [ Deep dive - Initialization options 참고 ] -->
  <script>
    $(document).ready(function() {
        $('#summernote').summernote({
		
		height: 100,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true                  // set focus to editable area after initializing summernote
  
  
		});
    });
  </script>
<?
include("top.html");
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);

$result = mysql_query("select * from product where code='$code'", $con);

$class=mysql_result($result,0,"class");
$name=mysql_result($result,0,"name");
$price1=mysql_result($result,0,"price1");
$content=mysql_result($result,0,"content");
$maxdate=mysql_result($result,0,"maxdate");
$userfile=mysql_result($result,0,"userfile");
$userfile2=mysql_result($result,0,"userfile2");
echo ("
    <table align=center border=0 width=750>     
	<form method=post action=p-modify2.php?code=$code enctype='multipart/form-data'>
	<tr><td width=200 align=center>상품코드</td>
	<td width=550><b>$code</b></td></tr>
	<tr><td align=center>상품분류</td>
	<td><select name=class>");

switch($class) {
    case 1:
		echo ("<option value=1 selected>배추김치</option>
			<option value=2>기타김치</option>");
		break;
	case 2:
		echo ("<option value=1>배추김치</option>
			<option value=2 selected>기타김치</option>");
		break;
	case 3:
       echo ("<option value=1>배추김치</option>
			<option value=2>기타김치</option>");
		break;
}

echo ("</select></td></tr>
	<tr><td align=center>상품이름</td><td><input type=text name=name size=70 value='$name'></td></tr>
	<tr><td align=center>원재료/함량</td><td><textarea name=content rows=5 cols=75 id=summernote>$content</textarea></td></tr>
	<tr><td align=center>유통기한</td><td><textarea name=maxdate rows=3 cols=75 id=summernote>$maxdate</textarea></td></tr>
	<tr><td align=center>정상가격</td><td><input type=text name=price1 size=15 value=$price1>원</td></tr>
	<tr><td align=center>상품사진</td><td><input type=file size=30 name=userfile><-- $userfile</td></tr>
	<tr><td align=center>내용사진</td><td><input type=file size=30 name=userfile2><-- $userfile2</td></tr>
	<tr><td align=center colspan=2><input type=submit value=수정완료></td></tr>
	</form>
	</table>");

mysql_close($con);
include("bottom.html");
?>
