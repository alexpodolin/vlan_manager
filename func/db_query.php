<?
// Извлечем из БД Информацию о доступных подсетях
function select_subnet_param($conn) {

	$select_subnets = 'SELECT id, interface, INET_NTOA(subnet_ipv4) AS subnet_ipv4, INET_NTOA(netmask) AS netmask, INET_NTOA(default_gw) AS default_gw, INET_NTOA(broadcast) AS broadcast, INET_NTOA(ip_range_start) AS ip_range_start, INET_NTOA(ip_range_end) AS ip_range_end, failover_peer FROM net_ipv4';

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
						<td>
							<a href='#' class='action__icon btn' title='редактировать'>
								<img src='/images/glyphicons-31-pencil.png' alt='редактировать'>
							</a>

							<a href='#' class='action__icon btn' data-toggle='modal' data-target='remove__subnet' title='удалить' row-id='{$row['id']}' onclick=show_modal_delete(this);>
								<img src='/images/glyphicons-17-bin.png' alt='удалить'>
							</a>
						</td>						
						</tr>";
	}

	return $table_subnets;	
}

$table_subnets = select_subnet_param($conn);
?>