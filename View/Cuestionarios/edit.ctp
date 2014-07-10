<section class="index_body">
	<fieldset class="primer_fieldsetm">
		<legend class="primer_legend">Datos generales</legend>
		<fieldset class="segunda_fieldset">
			<legend class="segunda_legend">Titulo</legend>
			<?php echo $this->Form->create('Cuestionario'); ?>
			<?php
			echo $this->Form->input('id');
			?>
			<?php
			echo $this->Form->input('titulo', array("label" => false,
													"required" => "required",
													"class" => "cuestionario_titulo_input",
													"rows"=>"3",'id' =>'titulo'));
			?>
			<?php echo $this->Form->end(); ?>
			<div class='div_loading'>
			<?php echo $this->Html->image('loader1.gif', array('alt' => 'loader',"class" => "img_loader", 'id' => 'img_loader')); ?>
			</div>
		</fieldset>
		<fieldset class="segunda_fieldset">
			<legend class="segunda_legend">Descripción</legend>
			<?php echo $this->Form->create('Cuestionario'); ?>
			<?php
			echo $this->Form->input('id');
			?>
			<?php
			echo $this->Form->input('descripcion', array("label" => false,
													"class" => "cuestionario_titulo_input",
													"rows"=>"4",'id' =>'descripcion'));
			?>
			<?php echo $this->Form->end(); ?>
			<div class='div_loading'>
			<?php echo $this->Html->image('loader1.gif', array('alt' => 'loader',"class" => "img_loader", 'id' => 'img_loader2')); ?>
			</div>
		</fieldset>
		</br>
	</fieldset>
	</br>
	<fieldset class="primer_fieldsetm">
		<fieldset class="segunda_fieldset">
			<legend class="segunda_legend">Nueva pregunta</legend>
		<?php
			echo $this->Form->create('Pregunta',array('url' => array('controller' => 'cuestionarios', 'action' => 'edit/1')));
		?>
		<?php
			echo $this->Form->input('titulo', array("label" => false,'type'=>'text',"class" => "cuestionario_titulo_input","rows"=>"4",'id' =>'titulo','required'=>'required'));
		?>
		<?php
			echo $this->Form->select(
				'dominio_id', $dominios,array('id'=>'dominio_id','autocomplete' =>'off','empty'=>false,'class'=>'inputCorto left')
			);
		?>
		<?php 
			echo $this->Form->end(array('label' => 'Agregar pregunta','div' => array('class' => 'div_submit_centrado_2')));
		?>
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
											
											
												<p>
													<?php
														echo $this->Form->create('Pregunta',array('action'=>'lolll','update'=>'#asd'));

													?>
													<?php
														echo $this->Form->input('id',array('type'=>'hidden','value'=>$pregunta['id']));
													?>
													<?php
														echo $this->Form->input('titulo', array("label" => false,'type'=>'text',"class" => "cuestionario_titulo_input",
																							"rows"=>"4",'id' =>'titulo','value'=>$pregunta['titulo'],'onBlur'=>'actualizar_pregunta(this)','idpregunta'=>$pregunta['id']));
													?>
													<div class='div_loading'>
														<?php echo $this->Html->image('loader1.gif', array('alt' => 'loader',"class" => "img_loader", 'id' => $pregunta['id'])); ?>
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
								</br>
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

	</fieldset>
</section>
<?php
$this->Js->get('#titulo')->event('blur',
	$this->Js->request(
	    array(
	        'action'=>'actualizar_general',
	    ),
	    array(
	    	'evalScripts' => true,
      		'before' => "$('#img_loader').fadeIn();",
      		'complete' => "$('#img_loader').fadeOut();",
	       	'async' => true,
	        'method' => 'post',
	        'dataExpression'=>true,
	        'data'=> $this->Js->serializeForm(array(
	            'isForm' => false,
	            'inline' => true
	        )),

	    )
	)
);
?>
<?php
$this->Js->get('#descripcion')->event('blur',
	$this->Js->request(
	    array(
	        'action'=>'actualizar_general',
	    ),
	    array(
	    	'evalScripts' => true,
      		'before' => "$('#img_loader2').fadeIn();",
      		'complete' => "$('#img_loader2').fadeOut();",
	       	'async' => true,
	        'method' => 'post',
	        'dataExpression'=>true,
	        'data'=> $this->Js->serializeForm(array(
	            'isForm' => false,
	            'inline' => true
	        )),

	    )
	)
);
?>
<script>
	
	function actualizar_pregunta(e)
	{	
		var valor=$(e).val();
		var id=$(e).attr("idpregunta");
		var respuesta=$.ajax
		(
			{
			  type: 'post',
	          dataType: 'json',
	          url: "<?php echo $this->Html->url(array('action' => 'actualizar_pregunta')); ?>",
			  data: 'id='+id+'&titulo='+valor,
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