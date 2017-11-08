<?php

sleep(0.5);

if(isset($_POST['row_id_modal_delete']) ) {

	require_once("{$_SERVER[DOCUMENT_ROOT]}/func/db_conn.php");

	$remove_subnet = "DELETE FROM net_ipv4 WHERE id={$_POST['row_id_modal_delete']}";
	echo $remove_subnet;

	$conn->exec($remove_subnet);


}




// function remove_subnet(db_conn()) {
// if(isset($_POST['row_id_modal_delete']) && $_POST['row_id_modal_delete'] != '') {	

// //	$row_id = $_POST['row_id_modal_delete'];
// //	echo $row_id;
// 	$remove_subnet = "DELETE FROM net_ipv4 WHERE id={$_POST['row_id_modal_delete']}";
// //	echo $remove_subnet;
// 	$conn->exec($remove_subnet);

// 	var_dump(db_conn());
// 	print_r(db_conn());
// }
	

// //echo $remove_subnet = "DELETE FROM net_ipv4 WHERE id={$_POST['row_id_modal_delete']}";

// }
// remove_subnet($conn);	

?>