<div class="personasProgramasSemestres view">
<h2><?php  echo __('Personas Programas Semestre'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($personasProgramasSemestre['PersonasProgramasSemestre']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Persona'); ?></dt>
		<dd>
			<?php echo $this->Html->link($personasProgramasSemestre['Persona']['nombre'], array('controller' => 'personas', 'action' => 'view', $personasProgramasSemestre['Persona']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Programa'); ?></dt>
		<dd>
			<?php echo $this->Html->link($personasProgramasSemestre['Programa']['nombre'], array('controller' => 'programas', 'action' => 'view', $personasProgramasSemestre['Programa']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Semestre'); ?></dt>
		<dd>
			<?php echo $this->Html->link($personasProgramasSemestre['Semestre']['nivel'], array('controller' => 'semestres', 'action' => 'view', $personasProgramasSemestre['Semestre']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Personas Programas Semestre'), array('action' => 'edit', $personasProgramasSemestre['PersonasProgramasSemestre']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Personas Programas Semestre'), array('action' => 'delete', $personasProgramasSemestre['PersonasProgramasSemestre']['id']), null, __('Are you sure you want to delete # %s?', $personasProgramasSemestre['PersonasProgramasSemestre']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas Programas Semestres'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personas Programas Semestre'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Programas'), array('controller' => 'programas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programa'), array('controller' => 'programas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semestres'), array('controller' => 'semestres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semestre'), array('controller' => 'semestres', 'action' => 'add')); ?> </li>
	</ul>
</div>
