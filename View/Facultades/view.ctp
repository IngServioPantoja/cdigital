<div class="facultades view">
<h2><?php  echo __('Facultad'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($facultad['Facultad']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($facultad['Facultad']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Facultad'), array('action' => 'edit', $facultad['Facultad']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Facultad'), array('action' => 'delete', $facultad['Facultad']['id']), null, __('Are you sure you want to delete # %s?', $facultad['Facultad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Facultades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facultad'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Programas'), array('controller' => 'programas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programa'), array('controller' => 'programas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Programas'); ?></h3>
	<?php if (!empty($facultad['Programa'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Facultad Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($facultad['Programa'] as $programa): ?>
		<tr>
			<td><?php echo $programa['id']; ?></td>
			<td><?php echo $programa['nombre']; ?></td>
			<td><?php echo $programa['facultad_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'programas', 'action' => 'view', $programa['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'programas', 'action' => 'edit', $programa['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'programas', 'action' => 'delete', $programa['id']), null, __('Are you sure you want to delete # %s?', $programa['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Programa'), array('controller' => 'programas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
