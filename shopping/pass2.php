<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
$result=mysql_query("select passwd from $board where id=$id",$con);
           // ��ȣ�� ��ġ�ϴ� ���
    switch ($mode) {
        case 0:          // ���� ���α׷� ȣ��
            echo("<meta   http-equiv='Refresh' content='0; url=modify.php?id=$id'>");
            break;
        case 1:          // ���� ���α׷� ȣ��
            echo("<meta   http-equiv='Refresh' content='0; url=delete.php?id=$id'>");
            break;

mysql_close($con);

?>
