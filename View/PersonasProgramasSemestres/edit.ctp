<div class="personasProgramasSemestres form">
<?php echo $this->Form->create('PersonasProgramasSemestre'); ?>
	<fieldset>
		<legend><?php echo __('Edit Personas Programas Semestre'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('persona_id');
		echo $this->Form->input('programa_id');
		echo $this->Form->input('semestre_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PersonasProgramasSemestre.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PersonasProgramasSemestre.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Personas Programas Semestres'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Programas'), array('controller' => 'programas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programa'), array('controller' => 'programas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semestres'), array('controller' => 'semestres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semestre'), array('controller' => 'semestres', 'action' => 'add')); ?> </li>
	</ul>
</div>
