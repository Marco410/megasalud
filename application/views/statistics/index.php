<div class="container">
	
	<div class="col-sm-12">
		<h3 class="ms-title"><b>ESTADÍSTICAS</b></h3>
	</div>	
	
	<div class="col-sm-6">
		<div class="panel panel-default border-left-primary">
            <div class="panel-heading text-center" ><h3>Total de Pacientes</h3></div>
			<div class="panel-body text-center">
                <h2><label><?= $count_pacientes ?></label></h2>
			</div>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="panel panel-default border-left-olive">
            <div class="panel-heading text-center" ><h3>Citas Realizadas</h3></div>
			<div class="panel-body text-center">
                <h2><label><?= $count_citas ?></label></h2>
			</div>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="panel panel-default border-left-brown">
            <div class="panel-heading text-center" ><h3>Sexo Pacientes</h3></div>
			<div class="panel-body text-center">
                <canvas id="chartSexo" ></canvas>
			</div>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="panel panel-default border-left-brown">
            <div class="panel-heading text-center" ><h3>Edades Pacientes</h3></div>
			<div class="panel-body text-center">
                <canvas id="chartEdad" ></canvas>
			</div>
		</div>
	</div>
    <div class="col-sm-12">
		<div class="panel panel-default border-left-warning">
            <div class="panel-heading text-center" ><h3>Lugares</h3></div>
			<div class="panel-body text-center">
                <canvas id="chartLugar" ></canvas>
			</div>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="panel panel-default border-left-primary">
            <div class="panel-heading text-center" ><h3>Entrada de Pacientes por mes</h3></div>
			<div class="panel-body text-center">
                <canvas id="chartEntraP" ></canvas>
			</div>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="panel panel-default border-left-warning">
            <div class="panel-heading text-center" ><h3>Representantes</h3></div>
			<div class="panel-body text-center">
                <canvas id="chartPFrom" ></canvas>
			</div>
		</div>
	</div>
    
    

</div>
