<?php

include('db_connect.php');
echo "News<br />\n";
$datastuff = mysql_query("SELECT article,author,date FROM CMS_news ORDER BY date DESC LIMIT 0,5 ");

while($data = mysql_fetch_row($datastuff)){

echo("<br /><div class=\"post\">Author: $data[1]<br />Date: $data[2]</div><br /><p>$data[0]</p>");
}

?>
