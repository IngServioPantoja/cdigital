<div class="facultades index">
	<h2><?php echo __('Facultades'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($facultades as $facultad): ?>
	<tr>
		<td><?php echo h($facultad['Facultad']['id']); ?>&nbsp;</td>
		<td><?php echo h($facultad['Facultad']['nombre']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $facultad['Facultad']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $facultad['Facultad']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $facultad['Facultad']['id']), null, __('Are you sure you want to delete # %s?', $facultad['Facultad']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Facultad'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Programas'), array('controller' => 'programas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programa'), array('controller' => 'programas', 'action' => 'add')); ?> </li>
	</ul>
</div>
