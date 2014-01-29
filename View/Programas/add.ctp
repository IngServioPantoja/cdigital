<div id="programas_sucess">
</div>
<div class="programas form">
<?php echo $this->Form->create('Programa'); ?>
	<fieldset>
		<legend><?php echo __('Add Programa'); ?></legend>
	<?php echo $this->Form->input('nombre');?>
	<?php echo $this->Form->input('facultad_id',array('value'=>1,'type'=>'number'));?>
	</fieldset>
<?php echo $this->Js->submit('Enviar', array(
              'update'=>'#programas_sucess'

            ));   ?>
<?php echo $this->Form->submit('normal submit'); ?>
<?php echo $this->Form->end(); ?>


</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Programas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Facultades'), array('controller' => 'facultades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facultad'), array('controller' => 'facultades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
	</ul>
</div>
