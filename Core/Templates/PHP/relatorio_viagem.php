﻿<?php
	
	include_once 'conexao.php';
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Relatório Viagem</title>
		<link rel="stylesheet"  href="Static/CSS/Estilo_relatorio_viagens.css">
		<link rel="stylesheet" href="Static/CSS/estilomenu.css" type="text/css">
		<link rel="stylesheet" href="Static/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="Static/bootstrap/dist/css/jquery.dataTables.css">
		<link rel="stylesheet" href="Static/bootstrap/dist/css/dataTables.bootstrap.css">
		<link rel="stylesheet" href="Static/bootstrap/dist/css/buttons.bootstrap.min.css" >
		<link rel="stylesheet" href="Static/bootstrap/dist/css/dataTables.bootstrap4.css">
		<link rel="stylesheet" href="Static/bootstrap/dist/css/dataTables.foundation.min.css">
		<link rel="stylesheet" href="Static/bootstrap/dist/css/dataTables.jqueryui.min.css">
		<link rel="stylesheet" href="Static/bootstrap/dist/css/dataTables.semanticui.min.css">
		<link rel="stylesheet" href="Static/bootstrap/dist/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="Static/bootstrap/dist/css/responsive.bootstrap.min.css" >
		<link rel="stylesheet" href="Static/bootstrap/dist/css/scroller.bootstrap.min.css" >
	</head>
	<body class="tudo">
		<!-- 
			=================
			INICIO DO MENU
			=================
		-->
		<?php include 'menu.php' ?>
		<!-- 
			=================
			FIM DO MENU
			=================
		-->
		<br/>
		<br/>
		<br/>
		<div class="cont">
			<div class="col-xs-12 col-md-3">
				<label for="fullname">Motorista:</label>
				<select class="select2_single js-example-basic-single form-control" name="motorista" id="motorista">
					<option></option>
					<?php 
						$select_mot = 'select * from motorista';
						$select_mot_query = mysqli_query($con,$select_mot);
						$num_row = mysqli_num_rows($select_mot_query);

						if ($num_row > 0){
						$row = mysqli_fetch_array($select_mot_query);
							echo "<option value='{$row[0]}'>{$row[1]}</option>";
						};
					?>
				</select>
			</div>
			<div class=" col-xs-1 col-md-1">
						<button class="btn btn-default bot" onclick="javascript: validabusca()" >Buscar</button>
				</div>
			</div>
			<div>
				<span style="color:red; margin-top:10px; margin-left:10px; display:none" id="alerta">Selecione o motorista!!</span>
			</div>
		</div>
		<br/>
		<br/>
		<!--Relatório viagem-->
		
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-12" id="table">		
				
			</div>
		</div>	
	</body>
</html>
<script src="Static/js/jquery.min.js"></script>
<script>
 


function validabusca(){
	$("#table").html("<img src='img/loading.gif' style='margin-left:40%' />")
	var id_mot = $('#motorista').val();
	if(id_mot == ''){
		document.getElementById('motorista').focus();
		document.getElementById('alerta').style.display = "block";
	}else{
		document.getElementById('alerta').style.display = "none";
		busca(id_mot);
	}
}

function busca(id_mot){
	
	$.ajax({
		type: "POST",
		url: "pesquisaformulario.php",
		data:{id_mot:id_mot},
		success: function(html){
			$("#table").html(html);
		},
		error:function(html){
			$("#table").html('<div class="alert alert-danger"><strong>ERRO!</strong> '+html+'</div>');

		}
		
	})
}



</script>