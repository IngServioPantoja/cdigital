<div class="programas view">
<h2><?php  echo __('Programa'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($programa['Programa']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($programa['Programa']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facultad'); ?></dt>
		<dd>
			<?php echo $this->Html->link($programa['Facultad']['nombre'], array('controller' => 'facultades', 'action' => 'view', $programa['Facultad']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Programa'), array('action' => 'edit', $programa['Programa']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Programa'), array('action' => 'delete', $programa['Programa']['id']), null, __('Are you sure you want to delete # %s?', $programa['Programa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Programas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programa'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Facultades'), array('controller' => 'facultades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facultad'), array('controller' => 'facultades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Personas'); ?></h3>
	<?php if (!empty($programa['Persona'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Identificacion'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Apellido'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Programa Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($programa['Persona'] as $persona): ?>
		<tr>
			<td><?php echo $persona['id']; ?></td>
			<td><?php echo $persona['identificacion']; ?></td>
			<td><?php echo $persona['nombre']; ?></td>
			<td><?php echo $persona['apellido']; ?></td>
			<td><?php echo $persona['email']; ?></td>
			<td><?php echo $persona['programa_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'personas', 'action' => 'view', $persona['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'personas', 'action' => 'edit', $persona['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'personas', 'action' => 'delete', $persona['id']), null, __('Are you sure you want to delete # %s?', $persona['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
