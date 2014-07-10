<section class="index_body">
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
			<?php 
			if(isset($cuestionario['Competencias']))
			{
				foreach ($cuestionario['Competencias'] as $competencia) {
				?>
				<fieldset class="primer_fieldsetm">
					<legend class="primer_legend"><?php echo $competencia['Competencia']['nombre']; ?></legend>
						<?php 
						if(isset($competencia['Competencia']['Dominios']))
						{
							foreach ($competencia['Competencia']['Dominios'] as $dominio) 
							{
							?>
							<fieldset class="primer_fieldset">
								<legend class="primer_legend"><?php echo $dominio['nombre']; ?></legend>
									<?php
									if(isset($dominio['Preguntas']))
									{
										$preguntanumero=1;
										foreach ($dominio['Preguntas'] as $pregunta) 
										{
										?>
										<fieldset class="segunda_fieldset">
											<legend class="segunda_legend">
												Pregunta:
												<?php
												echo $preguntanumero;
												?>
											</legend>
											<p class="parrafo_blanco">
												<?php
													echo $pregunta['titulo'];
												?>
									
												<?php
													echo $this->Form->create('Respuesta');

												?>
												<?php
												$options = array('1' => '1', '2' => '2','3'=>'3','4'=>'4','5'=>'5');
												$attributes = array('legend' => false,'onClick'=>'actualizar_pregunta(this)','idrespuesta'=>$pregunta['idrespuesta'],'value'=>$pregunta['respuestavalue']);
												echo $this->Form->radio('valor', $options, $attributes);
												?>
												<div class='div_loading'>
													<?php echo $this->Html->image('loader1.gif', array('alt' => 'loader',"class" => "img_loader", 'id' => $pregunta['idrespuesta'])); ?>
												</div>
												<?php
													echo $this->Form->end();
												?>
											</p>
										</fieldset>
										<?php
										++$preguntanumero;
										}
									}
									?>
							</fieldset>
							<?php
							}
						}
						?>
						</br>
				</fieldset>
				<?php
				}
			}
			?>
			</br></br>
			<?php
			print_r($cuestionario);
			echo $this->Form->create('PersonasCuestionario');
			echo $this->Form->hidden('id',array('value'=>$cuestionarioactual));
			echo $this->Form->hidden('terminado',array('value'=>1));
			echo $this->Form->end("Completar cuestionario");
			?>
			</br></br>
	</fieldset>
</section>
<script>
	
	function actualizar_pregunta(e)
	{	
		var valor=$(e).val();
		var id=$(e).attr("idrespuesta");
		var respuesta=$.ajax
		(
			{
			  type: 'post',
	          dataType: 'json',
	          url: "<?php echo $this->Html->url(array('action' => 'actualizar_respuesta')); ?>",
			  data: 'id='+id+'&valor='+valor,
			  beforeSend: function() {
				$("#"+id).fadeIn();

			  }
			}
		);
		respuesta.always(function() 
		{
		$("#"+id).fadeOut();
		}
		)
	}

</script>
<?php echo $this->Js->writeBuffer(); ?>