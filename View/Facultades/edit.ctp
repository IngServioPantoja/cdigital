<div class="facultades form">
<?php echo $this->Form->create('Facultad'); ?>
	<fieldset>
		<legend><?php echo __('Edit Facultad'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Facultad.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Facultad.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Facultades'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Programas'), array('controller' => 'programas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programa'), array('controller' => 'programas', 'action' => 'add')); ?> </li>
	</ul>
</div>
