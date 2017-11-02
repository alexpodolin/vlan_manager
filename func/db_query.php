<?
// Извлечем из БД Информацию о доступных подсетях
function select_subnet_param($conn) {

	$select_subnets = 'SELECT interface, INET_NTOA(subnet_ipv4) AS subnet_ipv4, INET_NTOA(netmask) AS netmask, INET_NTOA(default_gw) AS default_gw, INET_NTOA(broadcast) AS broadcast, INET_NTOA(ip_range_start) AS ip_range_start, INET_NTOA(ip_range_end) AS ip_range_end, failover_peer FROM net_ipv4';

	$res = $conn->query($select_subnets);
	
	foreach ($res as $row) {
		// Запишем извлеченные данные в таблицу
		$table_subnets .= "<tr>
						<td>{$row['interface']}</td>
						<td>{$row['subnet_ipv4']}</td>
						<td>{$row['netmask']}</td>
						<td>{$row['default_gw']}</td>
						<td>{$row['broadcast']}</td>
						<td>{$row['ip_range_start']}</td>
						<td>{$row['ip_range_end']}</td>
						<td>{$row['failover_peer']}</td>
						</tr>";
	}

	return $table_subnets;
}

$table_subnets = select_subnet_param($conn);
?>