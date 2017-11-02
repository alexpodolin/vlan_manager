<?
// Соединение с БД
function db_conn() {
	$db_server = "192.168.156.91";
	$db_name = "dhcpd";
	$db_user = "manager";
	$db_passwd = "7Sh5sUhu";

	try {
		$conn = new PDO("mysql:host=$db_server;dbname=dhcpd;charset=UTF8", $db_user, $db_passwd);
		// set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // echo "Connected successfully"; 	
	}
	catch(PDOException $e) {
    	echo "Connection failed: " . $e->getMessage();
    }

    return $conn;
}
// Результат работы функции запишем в переменную
$conn = db_conn();
?>