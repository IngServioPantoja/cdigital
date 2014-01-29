<section class="index_body">
	<div class="personas index">
		<fieldset class="primer_fieldsetp">
			<legend class="primer_legend">Busqueda</legend>
				<div class="div_busqueda">
								<?php echo $this->Form->create('Busqueda',array('class' => 'busqueda_form')); ?>
								<?php echo $this->Form->select("itemBusqueda",$listaBusqueda);?>
								<?php echo $this->Form->input("valorBusqueda",array('label' => false));?>
								<?php echo $this->Form->end(array('label' => 'Buscar','div' => array('class' => 'div_submit_centrado_3')));?>

								<?php echo $this->Html->link(__('Nuevo'), array('action' => 'add'),array('class' => 'link_agregar')); ?> 
		        </div>
		</fieldset>
		<fieldset class="primer_fieldsetm">
			<legend class="primer_legend">Usuarios</legend>
				<table class="tabla_indexm">
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('identificacion'); ?></th>
						<th><?php echo $this->Paginator->sort('nombre'); ?></th>
						<th><?php echo $this->Paginator->sort('apellido'); ?></th>
						<th><?php echo $this->Paginator->sort('email'); ?></th>
						<th class ="actions"><?php echo __('Actions'); ?></th>
					</tr>
			<?php foreach ($personas as $persona): ?>
					<tr>
						<td><?php echo h($persona['Persona']['id']); ?>&nbsp;</td>
						<td><?php echo h($persona['Persona']['identificacion']); ?>&nbsp;</td>
						<td><?php echo h($persona['Persona']['nombre']); ?>&nbsp;</td>
						<td><?php echo h($persona['Persona']['apellido']); ?>&nbsp;</td>
						<td><?php echo h($persona['Persona']['email']); ?>&nbsp;</td>
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
							<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $persona['Persona']['id'])); ?>
							<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $persona['Persona']['id'])); ?>
							<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $persona['Persona']['id']), null, __('Are you sure you want to delete # %s?', $persona['Persona']['id'])); ?>
						</td>
					</tr>
				<?php endforeach;?>
					<tr>
						<td colspan="7">
							<?php
								echo $this->Paginator->prev('< ', array(), null, array('class' => 'prev disabled'));
								echo $this->Paginator->numbers(array('separator' => ' '));
								echo $this->Paginator->next(' >', array(), null, array('class' => 'next disabled'));
							?>
						</td>
					</tr>
				</table>
		</fieldset>
	</div>
</section>