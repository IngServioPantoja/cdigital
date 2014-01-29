<!-- Des aqui haceos la adaptaciond e codigo -->
<section class="index_body">
	<div class="personas form">
	<fieldset class="primer_fieldsetp">
			<legend class="primer_legend">Usuario</legend>
		<fieldset class="segunda_fieldset">
			<legend class="segunda_legend">Datos generales</legend>
				<table>
					<tr>	
						<th>Id</th>
						<td><?php echo h($persona['Persona']['id']); ?></td>
					</tr>
					<tr>	
						<th>Identificacion</th>
						<td><?php echo h($persona['Persona']['identificacion']); ?></td>
					</tr>
					<tr>	
						<th>Nombre</th>
						<td><?php echo h($persona['Persona']['nombre']); ?></td>
					</tr>
					<tr>	
						<th>Apellido</th>
						<td><?php echo h($persona['Persona']['apellido']); ?></td>
					</tr>
					<tr>	
						<th>Fecha de nacimiento</th>
						<td><?php echo h($persona['Persona']['fecha de nacimiento']); ?></td>
					</tr>
					<tr>	
						<th>Programa</th>
						<td><?php echo h($persona['Programa']['nombre']); ?></td>
					</tr>
				</table>
		</fieldset>
		<fieldset class="segunda_fieldset">
			<legend class="segunda_legend">Datos de la cuenta</legend>
				<table>
					<tr>
						<th>Correo electronico</th>
						<td><?php echo h($persona['Persona']['email']); ?></td>
					</tr>
					<tr>
						<th>Nivel de acceso</th>
						<td><?php echo h($persona['Nivel']['nombre']); ?></td>
					</tr>
					</table>
		</fieldset>
	</br>
	<table class="acciones">
		<tr>
			<td>
				<?php echo $this->Html->link(__('Nuevo'), array('action' => 'add'),array('class' => 'acciones_agregar')); ?> 
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $persona['Persona']['id']),array('class' => 'acciones_editar')); ?>
				<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $persona['Persona']['id']),array('class' => 'acciones_eliminar'), __('Esta seguro que desea eliminar a %s?', $persona['Persona']['nombre']." ".$persona['Persona']['apellido'])); ?>
			</td>
		</tr>
	</table>
	</br>
	</fieldset>
	</div>
</section>