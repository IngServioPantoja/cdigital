<div class="personasProgramasSemestres index">
	<h2><?php echo __('Personas Programas Semestres'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('persona_id'); ?></th>
			<th><?php echo $this->Paginator->sort('programa_id'); ?></th>
			<th><?php echo $this->Paginator->sort('semestre_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($personasProgramasSemestres as $personasProgramasSemestre): ?>
	<tr>
		<td><?php echo h($personasProgramasSemestre['PersonasProgramasSemestre']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($personasProgramasSemestre['Persona']['nombre'], array('controller' => 'personas', 'action' => 'view', $personasProgramasSemestre['Persona']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($personasProgramasSemestre['Programa']['nombre'], array('controller' => 'programas', 'action' => 'view', $personasProgramasSemestre['Programa']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($personasProgramasSemestre['Semestre']['nivel'], array('controller' => 'semestres', 'action' => 'view', $personasProgramasSemestre['Semestre']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $personasProgramasSemestre['PersonasProgramasSemestre']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $personasProgramasSemestre['PersonasProgramasSemestre']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $personasProgramasSemestre['PersonasProgramasSemestre']['id']), null, __('Are you sure you want to delete # %s?', $personasProgramasSemestre['PersonasProgramasSemestre']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Personas Programas Semestre'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Programas'), array('controller' => 'programas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programa'), array('controller' => 'programas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semestres'), array('controller' => 'semestres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semestre'), array('controller' => 'semestres', 'action' => 'add')); ?> </li>
	</ul>
</div>
