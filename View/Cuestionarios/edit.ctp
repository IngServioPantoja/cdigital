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
			<fieldset class="primer_fieldsetm">
				<legend class="primer_legend">Uso de las Tic</legend>
					<fieldset class="primer_fieldset">
						<legend class="primer_legend">Primer nivel de dominio</legend>
							<fieldset class="segunda_fieldset">
								<legend class="segunda_legend">Preguntas 1</legend>
							</fieldset>
					</fieldset>
					<fieldset class="primer_fieldset">
						<legend class="primer_legend">Segundo nivel de dominio</legend>
							<fieldset class="segunda_fieldset">
								<legend class="segunda_legend">Preguntas 1</legend>
							</fieldset>
					</fieldset>
					<fieldset class="primer_fieldset">
						<legend class="primer_legend">Tercer nivel de dominio</legend>
							<fieldset class="segunda_fieldset">
								<legend class="segunda_legend">Preguntas 1</legend>
							</fieldset>
					</fieldset>
			</fieldset>
			</br>
			<fieldset class="primer_fieldsetm">
				<legend class="primer_legend">Gestion de bases de datos</legend>
					<fieldset class="primer_fieldset">
						<legend class="primer_legend">Primer nivel de dominio</legend>
							<fieldset class="segunda_fieldset">
								<legend class="segunda_legend">Preguntas 1</legend>
							</fieldset>
					</fieldset>
					<fieldset class="primer_fieldset">
						<legend class="primer_legend">Segundo nivel de dominio</legend>
							<fieldset class="segunda_fieldset">
								<legend class="segunda_legend">Preguntas 1</legend>
							</fieldset>
					</fieldset>
					<fieldset class="primer_fieldset">
						<legend class="primer_legend">Tercer nivel de dominio</legend>
							<fieldset class="segunda_fieldset">
								<legend class="segunda_legend">Preguntas 1</legend>
							</fieldset>
					</fieldset>
			</fieldset>
			</br>
			<fieldset class="primer_fieldsetm">
				<legend class="primer_legend">Uso de las TIC para la búsqueda y tratamiento de la información</legend>
					<fieldset class="primer_fieldset">
						<legend class="primer_legend">Primer nivel de dominio</legend>
							<fieldset class="segunda_fieldset">
								<legend class="segunda_legend">Preguntas 1</legend>
							</fieldset>
					</fieldset>
			</fieldset>
	</fieldset>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>

			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Cuestionario.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Cuestionario.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List Cuestionarios'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('List Preguntas'), array('controller' => 'preguntas', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Pregunta'), array('controller' => 'preguntas', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
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