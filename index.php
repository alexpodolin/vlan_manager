<?
// В первую очередь принудительно подключим файл 
// в котором соединимся с БД
require_once("{$_SERVER[DOCUMENT_ROOT]}/func/db_conn.php");

// подключим оставшиеся файлы с функциями
$file_dir = "{$_SERVER[DOCUMENT_ROOT]}/func/";  
$file_name = scandir($file_dir); 
// уберем . и .. в имени файла
$file_name = array_slice($file_name, 2); 

foreach ($file_name as $item) {
	$path = $file_dir . $item;	
	require_once($path);
	}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Управление подсетями телефонии</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/normalize.css" media="all">
	<link rel="stylesheet" href="css/bootstrap.css" media="all">
	<!-- GUP ATS css -->
    <link href="css/style.css" rel="stylesheet">  

	<style media="all,print,screen"></style>

	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

	<!--[if it IE]>
          <script type="text/javascript" src="js/html5shiv.js"></script>
    <![endif]-->

    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
</head>

<body>
<div class="container-fluid ">
	<div class="row-fluid wrapper">
		<div class="row col-lg-3 col-md-4 col-sm-12 col-xs-12 form_block">
			<!-- <form class="form-control int" action="#" method="GET" name="int_add">
				<fieldset>
					<legend>Настройка сетевого интерфейса</legend>

					<div class="form-group">
						<label for="choose_int">Выберите физический интерфейс:</label>
						<select id="choose_int" class="form-control">
							<option value="enp4s0f0" selected="selected">enp4s0f0</option>
							<option value="enp5s0f0">enp5s0f0</option>
						</select>
					</div>

					<div class="form-group">
						<label for="vlan_id">Номер vlan:</label>
						<input class="form-control" type="text" id="vlan_id" maxlength="4" pattern="[0-9]{4}" required size="5" placeholder="введите vlan number">
					</div>

					<div class="form-group">
						<label for="ip">Ip адрес интерфейса:</label>
						<input class="form-control" type="text" id="ip" maxlength="15" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}" required size="15" placeholder="введите ip адрес интерфейса">
					</div>

					<div class="form-group">
						<label for="prefix">Префикс:</label>
						<input class="form-control" type="text" id="prefix" maxlength="2" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}" required size="2" placeholder="введите префикс подсети">
					</div>

					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" name="int__create_int">Сконфигурировать интерфейс</button>
					</div>
				</fieldset>			
			</form> -->

			<form class="form-control config" method="POST" autocomplete="on">
				<fieldset>
					<legend>Настройки конфига подсети</legend>
					<small>* если в списке не отображаются нужный vlan, то необходимо его создать на всех серверах</small>

					<div class="form-group">
						<label for="choose_interface">Выберите интерфейс:</label>
						<select id="choose_interface" name="choose_interface" class="form-control" required>
							<option value="">---</option>
							<?=$options?>										
						</select>
					</div>

					<div class="form-group">
						<label for="subnet">Адрес подсети:</label>
						<input class="form-control" type="text" id="subnet" name="subnet" maxlength="15" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}" required size="15" placeholder="введите адрес подсети">
					</div>

					<div class="form-group">
						<label for="netmask">Маска подсети:</label>
						<input class="form-control" type="text" id="netmask" name="netmask" maxlength="15" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}" required size="15" placeholder="введите маску подсети">
					</div>

					<div class="form-group">
						<label for="gw">Шлюз по умолчанию:</label>
						<input class="form-control" type="text" id="gw" name="gw" maxlength="15" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}" required size="15" placeholder="введите шлюз по умолчанию">
					</div>

					<div class="form-group">
						<label for="broadcast">Укажите broadcast:</label>
						<input class="form-control" type="text" id="broadcast" name="broadcast" maxlength="15" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}" required size="15" placeholder="широковещательный адрес">
					</div>

					<div class="form-group">
						<label for="ip_start">Начальный адрес:</label>
						<input class="form-control" type="text" id="ip_start" name="ip_start" maxlength="15" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}" required size="15" placeholder="начальный адрес диапазона">
					</div>

					<div class="form-group">
						<label for="ip_end">Конечный адрес:</label>
						<input class="form-control" type="text" id="ip_end" name="ip_end" maxlength="15" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}" required size="15" placeholder="конечный адрес диапазона">
					</div>

					<div class="form-group">
						<label for="failover_peer">failover peer:</label>
						<input class="form-control" type="text" id="failover_peer" name="failover_peer"  required size="30" value="nr-dhcpd-failover">
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block" name="int__add_config">Сконфигурировать подсеть</button>
					</div>
				</fieldset>
			</form>
		</div>

		<div class="row col-lg-9 col-md-8 col-sm-12 col-xs-12 wrapper">
			<!-- <p>Сконфигурированные сети и интерфейсы</p>
			<table class="table table-hover table-responsive">				
				<thead class="text-nowrap">	
					<tr>				
						<th>Интерфейс</th>
						<th>Vlan</th>
						<th>ip адрес</th>
						<th>Префикс</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>enps0f0.743</td>
						<td>743</td>
						<td>111.222.333.444</td>
						<td>29</td>
					</tr>
					
				</tbody>
			</table> -->


			<p>Доступные подсети</p>
			<table class="table table-responsive" id="subnets_content">		
				<thead class="text-nowrap">		
					<tr>			
						<th>Interface</th>
						<th>Subnet</th>
						<th>Netmask</th>
						<th>Default Gateway</th>
						<th>Broadcast</th>
						<th>Start ip</th>
						<th>End ip</th>
						<th>Failover peer</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						
					</tr>					
				</tbody>
				<?=$table_subnets?>
			</table>
		</div>

		<div id="remove__subnet" class="modal remove__subnet" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Удаление подсети</h4>
						<button type="button" class="close" onclick="close_modal_delete();">×</button>
					</div>

					<div class="modal-body">Удалить подсеть ?</div>
					
					<div class="modal-footer">			
						<button type="button" class="btn btn-default" onclick="remove_row();">Да</button>		
						<button type="button" class="btn btn-danger" onclick="close_modal_delete();">Нет</button>						
					</div>
				</div>
			</div>
		</div>

		<div class="progress__spin"></div>

	</div>	
</div>
</body>
</html>