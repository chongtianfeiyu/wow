<?
$link = mysql_connect("localhost" , "root" , "");
if($link){
    mysql_select_db("wow",$link);
    mysql_query('SET NAMES UTF8',$link);
}
else
    echo "database ERROR";
?>
