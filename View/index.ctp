<section class="index_body">
	<div class="personas index">
		<fieldset class="primer_fieldsetm">
			</br>
			<?php echo $this->Html->link(__('Nuevo'), array('action' => 'add'),array('class' => 'link_agregar')); ?> 
			</br>
			<legend class="primer_legend">Usuarios</legend>
				<table class="tabla_indexm" id="table_personas">
					<thead>
						<tr>
							<th>ID</th>
							<th>identificacion</th>
							<th>nombre</th>
							<th>Apellido</th>
							<th>Semestre</th>
							<th>Programa</th>
							<th>Facultad</th>
							<th class ="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
				</body>
			<?php foreach ($personas as $persona): ?>
					<tr>
						<td><?php echo h($persona['Persona']['id']); ?>&nbsp;</td>
						<td><?php echo h($persona['Persona']['identificacion']); ?>&nbsp;</td>
						<td><?php echo h($persona['Persona']['nombre']); ?>&nbsp;</td>
						<td><?php echo h($persona['Persona']['apellido']); ?>&nbsp;</td>
						<td><?php echo h($persona['Programa'][0]['Semestre'][0]['nivel']); ?>&nbsp;</td>
						<td><?php echo h($persona['Programa'][0]['nombre']); ?></td>
						<td><?php echo h($persona['Programa'][0]['Facultad']['nombre']); ?></td>
<!--						<td><?php 
						foreach ($persona['Semestre'] as $semestre) {
							echo $this->Html->link($semestre['nivel'], array('controller' => 'programas', 'action' => 'view', $semestre['id'])); 
						}
						?></td>
						<td><?php 
						foreach ($persona['Programa'] as $programa) {
							echo $this->Html->link($programa['nombre'], array('controller' => 'programas', 'action' => 'view', $programa['id'])); 
						}
						?></td>
-->
						<td class="actions">
							<?php echo $this->Form->create('Cuestionario',array('controller'=>'cuestionarios','action'=>'resultado_individual')); 
								echo $this->Form->hidden('Cedula',array('value'=>$persona['Persona']['identificacion']));
								echo $this->Form->end(__('Resultado')); ?>
							<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $persona['Persona']['id'])); ?>
							<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $persona['Persona']['id'])); ?>
							<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $persona['Persona']['id']), null, __('¿Realmente desea eleiminar a %s?', $persona['Persona']['nombre']." ".$persona['Persona']['apellido'])); ?>
						</td>
					</tr>
				<?php endforeach;?>
					</tbody>
				</table>
		</fieldset>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function () {
		var tabla=
		$('#table_personas').dataTable( {
			"oLanguage": {
			"sSearch": "Busqueda",
			"sLengthMenu": '_MENU_'
			},
	    } );

	});
				
</script>
