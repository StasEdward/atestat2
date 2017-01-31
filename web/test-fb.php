<?php
	foreach (PDO::getAvailableDrivers() as $drv) {
		echo $drv."<br/>";
	}

//	phpinfo();
//	print_r(get_loaded_extensions(false));
/*
	echo "stas";
	    $link=ibase_connect('10.10.14.61:d:/home/administrator/firebird_dbs/atemaindb.fdb','test','test','win1251', 0,1,'main');
	    var_dump($link);
*/


?>
