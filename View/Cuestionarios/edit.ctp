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
		<legend class="primer_legend">Preguntas</legend>
			<?php 
			foreach ($cuestionario['Competencia'] as $key) {
			echo $this->Form->create('Competencia');
			?>
			<fieldset class="primer_fieldsetm">
				<legend class="primer_legend"><?php echo $key['nombre']; ?></legend>
					<?php 
					foreach ($key['Dominio'] as $value) 
					{
					?>
					<fieldset class="primer_fieldset">
						<legend class="primer_legend"><?php echo $value['nombre']; ?></legend>
							<fieldset class="segunda_fieldset">
								<legend class="segunda_legend">Preguntas 1</legend>
							</fieldset>
					</fieldset>
					<?php
					}
					?>
					</br>
			</fieldset>
			<?php
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
<?php echo $this->Js->writeBuffer(); ?>