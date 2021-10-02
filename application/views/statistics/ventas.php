<div class="container">
	
	<div class="col-sm-12">
		<h3 class="ms-title"><b>ESTADÍSTICAS VENTAS</b></h3>
	</div>	
	
	<div class="col-sm-12">
		<div class="panel panel-default border-left-primary">
            <div class="panel-heading text-center" ><h3>Total de Pedidos</h3></div>
			<div class="panel-body text-center">
                <h2><label><?= $count_orders ?></label></h2>
			</div>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="panel panel-default border-left-olive">
            <div class="panel-heading text-center" ><h3>Pagados</h3></div>
			<div class="panel-body text-center">
                <h2><label><?= $count_pagado ?></label></h2>
			</div>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="panel panel-default border-left-brown">
            <div class="panel-heading text-center" ><h3>Pendientes</h3></div>
			<div class="panel-body text-center">
                <h2><label><?= $count_pendiente ?></label></h2>
			</div>
			
		</div>
	</div>
    <div class="col-sm-12">
		<div class="panel panel-default border-left-brown">
            <div class="panel-heading text-center" ><h3>Pedidos Usuarios</h3></div>
			<div class="panel-body text-center">
                <canvas id="chartPedidosUsuarios" ></canvas>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-default border-left-primary">
            <div class="panel-heading text-center" ><h3>Pedidos por mes 2020</h3></div>
			<div class="panel-body text-center">
                <canvas id="chartEntraPedidos20" ></canvas>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-default border-left-primary">
            <div class="panel-heading text-center" ><h3>Pedidos por mes 2021</h3></div>
			<div class="panel-body text-center">
                <canvas id="chartEntraPedidos21" ></canvas>
			</div>
		</div>
	</div>
    <div class="col-sm-12">
		<div class="panel panel-default border-left-warning">
            <div class="panel-heading text-center" ><h3>Pedidos por Sucursales</h3></div>
			<div class="panel-body text-center">
                <canvas id="chartSucursal" ></canvas>
			</div>
		</div>
	</div>

</div>
