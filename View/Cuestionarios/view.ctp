<div class="cuestionarios view">
<h2><?php  echo __('Cuestionario'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cuestionario['Cuestionario']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Titulo'); ?></dt>
		<dd>
			<?php echo h($cuestionario['Cuestionario']['titulo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($cuestionario['Cuestionario']['descripcion']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cuestionario'), array('action' => 'edit', $cuestionario['Cuestionario']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cuestionario'), array('action' => 'delete', $cuestionario['Cuestionario']['id']), null, __('Are you sure you want to delete # %s?', $cuestionario['Cuestionario']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cuestionarios'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cuestionario'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Preguntas'), array('controller' => 'preguntas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pregunta'), array('controller' => 'preguntas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas'), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona'), array('controller' => 'personas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Preguntas'); ?></h3>
	<?php if (!empty($cuestionario['Pregunta'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Orden'); ?></th>
		<th><?php echo __('Titulo'); ?></th>
		<th><?php echo __('Tipospregunta Id'); ?></th>
		<th><?php echo __('Cuestionario Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cuestionario['Pregunta'] as $pregunta): ?>
		<tr>
			<td><?php echo $pregunta['id']; ?></td>
			<td><?php echo $pregunta['orden']; ?></td>
			<td><?php echo $pregunta['titulo']; ?></td>
			<td><?php echo $pregunta['tipospregunta_id']; ?></td>
			<td><?php echo $pregunta['cuestionario_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'preguntas', 'action' => 'view', $pregunta['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'preguntas', 'action' => 'edit', $pregunta['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'preguntas', 'action' => 'delete', $pregunta['id']), null, __('Are you sure you want to delete # %s?', $pregunta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pregunta'), array('controller' => 'preguntas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Personas'); ?></h3>
	<?php if (!empty($cuestionario['Persona'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Tiposidentificacion Id'); ?></th>
		<th><?php echo __('Identificacion'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Apellido'); ?></th>
		<th><?php echo __('Fecha De Nacimiento'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cuestionario['Persona'] as $persona): ?>
		<tr>
			<td><?php echo $persona['id']; ?></td>
			<td><?php echo $persona['tiposidentificacion_id']; ?></td>
			<td><?php echo $persona['identificacion']; ?></td>
			<td><?php echo $persona['nombre']; ?></td>
			<td><?php echo $persona['apellido']; ?></td>
			<td><?php echo $persona['fecha de nacimiento']; ?></td>
			<td><?php echo $persona['email']; ?></td>
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
