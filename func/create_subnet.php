<?
// Извлечем подинтерфейсы для которых можно сделать настройку
function get_subinterfaces() {

	// Получим список интерфейсов, при соединении по ssh
	$pty = true;
	
	$ssh_conn = ssh2_connect('192.168.156.91', 22);

	if  (ssh2_auth_password($ssh_conn, 'manager', '7Sh5sUhu')) {
		$get_int = ssh2_exec($ssh_conn, '/usr/bin/sudo /usr/bin/cat /etc/sysconfig/network-scripts/ifcfg-enp4s0f0.* | grep -i device | sort | uniq', $pty);
	    
	    // Устанавливает блокирующий/неблокирующий режим на потоке
	    stream_set_blocking($get_int, $pty);
	    // Получение расширенного потока данных
		$stream_out = ssh2_fetch_stream($get_int, SSH2_STREAM_STDIO);
		// Читает оставшуюся часть потока в строку
		$stream_to_str = stream_get_contents($stream_out);		

		preg_match_all('/DEVICE=enp4s0f0.\d+[0-9]/ ', $stream_to_str, $matches);
		foreach ($matches as $key => $device) {
			foreach ($device as $item => $value) {
				$value = preg_replace('/DEVICE=enp4s0f0./', '', $value);
				$options .= "<option value='{$value}'>$value</option>";
			}
		}
	}
	else {
		die('Authentication Failed...');
	}

	return $options;
}

// Обработка формы создания подсети
function create_subnet() {

}

$options = get_subinterfaces();
create_subnet($conn);
?>
