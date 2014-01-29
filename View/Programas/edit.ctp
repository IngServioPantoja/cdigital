<div class="programas form">
<?php echo $this->Form->create('Programa'); ?>
	<fieldset>
		<legend><?php echo __('Edit Programa'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('facultad_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Programa.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Programa.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Programas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Facultades'), array('controller' => 'facultades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facultad'), array('controller' => 'facultades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
	</ul>
</div>
