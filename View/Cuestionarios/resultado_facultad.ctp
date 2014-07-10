<?php
if (!$this->request->is('ajax')) {
?>
<section class="index_body">
	<fieldset class="primer_fieldsetm">
		<legend class="primer_legend">Facultad</legend>
		<fieldset class="segunda_fieldset">
			<?php
			echo $this->Form->create('Facultad');
			echo $this->Form->select(
				'facultad', $facultades,array('id'=>'facultad','autocomplete' =>'off','empty'=>false,'class'=>'inputCorto left','value'=>$facultadvalue)
			
			);
			echo $this->Form->end();
			?>			
		</fieldset>
		</br>
	</fieldset>
	<fieldset class="primer_fieldsetm">
		<legend class="primer_legend">Datos generales</legend>
		<fieldset class="segunda_fieldset">
			<legend class="segunda_legend">Titulo</legend>
			<P class="parrafo_blanco">
			<?php
				echo $cuestionario['Cuestionario']['titulo'];
			?>
			</p>
		</fieldset>
		<fieldset class="segunda_fieldset">
			<legend class="segunda_legend">Descripción</legend>
			<P class="parrafo_blanco">
			<?php
				echo $cuestionario['Cuestionario']['descripcion'];
			?>
			</p>
		</fieldset>
		</br>
	</fieldset>
	<fieldset class="primer_fieldsetm">
		<legend class="primer_legend">Preguntas</legend>
		</br>
		
		<div id="contenedor_resultados">
<?php
}
?>
		

	<?php
	$competenciaActual=0;
	if(count($resultados_estudiante)>0)
	{
	?>
		<table id="exportacion" style="border:1px solid #999;display:block;">
			<thead>
					<tr>
						<th style="background-color:#ddd;">
							Competencia
						</th>
						<th style="background-color:#ddd;">
							Nivel de dominio
						</th>
						<th style="background-color:#ddd;">
							Porcentaje
						</th>
						<th style="background-color:#ddd;">
							Puntaje
						</th>
						<th style="background-color:#ddd;">
							Concepto
						</th>
					</tr>
			</thead>
			<tfoot>
	            <tr>
					<th style="background-color:#ddd;">Competencia</th>
					<th style="background-color:#ddd;">Nivel de dominio</th>
					<th style="background-color:#ddd;">Porcentaje</th>
					<th style="background-color:#ddd;">Puntaje</th>
					<th style="background-color:#ddd;">Concepto</th>
				</tr>
	        </tfoot>
			<tbody>
			<?php
			foreach ($resultados_estudiante as $resultado_estudiante) 
			{
				$competenciaElemento=$resultado_estudiante['CP']['id'];
				if($competenciaActual!=$competenciaElemento)
				{
					if($competenciaActual!=0)
					{
						?>
						</br>
						<?php
					}
				?>	

				<?php
				}

				?>
						<tr>	
							
							<td style="background-color:#<?php echo $resultado_estudiante[0]['color'];?>">
								<?php 
								echo $resultado_estudiante['CP']['nombre']; 
								?></td>
							<td style="background-color:#<?php echo $resultado_estudiante[0]['color'];?>">
								<?php echo $resultado_estudiante['dominios']['nombre'];?></td>
							<td style="background-color:#<?php echo $resultado_estudiante[0]['color'];?>">
								<?php
								echo ($resultado_estudiante[0]['puntajeescaladominio']/5)*100;
								echo "% ";
								?></td>	
							<td style="background-color:#<?php echo $resultado_estudiante[0]['color'];?>">
								<?php
								echo $resultado_estudiante[0]['puntajeescaladominio'];
								?></td>	
							<td style="background-color:#<?php echo $resultado_estudiante[0]['color'];?>">
								<?php
								echo $resultado_estudiante[0]['concepto'];
								?></td>
						</tr>
					
				<?php

				$competenciaActual=$competenciaElemento;

			}
		?>
				<script type="text/javascript">
					$(document).ready(function () {
						var tabla=
						$('#exportacion').dataTable( {
					        "paging":   false,
					        "dom": 'T<"clear">lrtip',
							"oTableTools": {
								"sSwfPath": "../js/copy_csv_xls_pdf.swf",
								"aButtons":    [ "xls", "pdf" ]
							}
				    } );

				});
				
				</script>
			</tbody>
		</table>
	<?php	
	}else
	{
	?>
		<label style="color:#fff;">Aun no se registran respuestas</label>
	<?php
	}
	?>
	</br>
<?php
if (!$this->request->is('ajax')) {
?>
		</div>
	</fieldset>
</section>

<?php
$this->Js->get('#facultad')->event('change',
	$this->Js->request(
	    array(
	        'action' => 'resultado_facultad',
	    ),
	    array(
	        'update'=>'#contenedor_resultados',
	        'async' => true,
	        'method' => 'post',
	        'dataExpression'=>true,
	        'data'=> $this->Js->serializeForm(array(
	            'isForm' => false,
	            'inline' => true
	        ))
	    )
	)
);
?>
<?php echo $this->Js->writeBuffer(); ?>

<?php
}
?>
