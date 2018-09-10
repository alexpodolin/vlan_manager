<?
if(isset($_POST['row_id_edit'])) {

	require_once("{$_SERVER[DOCUMENT_ROOT]}/func/db_conn.php");
	$select_row = "SELECT interface, INET_NTOA(subnet_ipv4) AS subnet_ipv4, INET_NTOA(netmask) AS netmask, INET_NTOA(default_gw) AS default_gw, INET_NTOA(broadcast) AS broadcast, INET_NTOA(ip_range_start) AS ip_range_start, INET_NTOA(ip_range_end) AS ip_range_end, dns_suffix, INET_NTOA(dns_srv_01) AS dns_srv_01, INET_NTOA(dns_srv_02) AS dns_srv_02, failover_peer  FROM net_ipv4 WHERE id={$_POST['row_id_edit']}";	

	$result = $conn->query($select_row);
	
	foreach ($result as $row) {

		// сформируем масив из полученных значений
		// закодируем его в json
		// передадим в javascript
		// ключ в массиве, это id поля в верстке формы
		$row_data = array(
						'choose_interface' => $row['interface'],
						'subnet' => $_GET{$row['subnet_ipv4']},
						'netmask' => $row['netmask'],
						'gw' => $row['default_gw'],
						'broadcast' => $row['broadcast'],
						'ip_start' => $row['ip_range_start'],
						'ip_end' => $row['ip_range_end'],
						'dns_sfx' => $row['dns_suffix'],
						'dns_prm' => $row['dns_srv_01'],
						'dns_sec' => $row['dns_srv_02'],
						'failover_peer' => $row['failover_peer'],
					);

		$row_data = json_encode($row_data);

	}
}
?>
