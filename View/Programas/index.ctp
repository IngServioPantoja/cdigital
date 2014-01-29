<div class="programas index">
	<h2><?php echo __('Programas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('facultad_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($programas as $programa): ?>
	<tr>
		<td><?php echo h($programa['Programa']['id']); ?>&nbsp;</td>
		<td><?php echo h($programa['Programa']['nombre']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($programa['Facultad']['nombre'], array('controller' => 'facultades', 'action' => 'view', $programa['Facultad']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $programa['Programa']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $programa['Programa']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $programa['Programa']['id']), null, __('Are you sure you want to delete # %s?', $programa['Programa']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Programa'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Facultades'), array('controller' => 'facultades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facultad'), array('controller' => 'facultades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
	</ul>
</div>
