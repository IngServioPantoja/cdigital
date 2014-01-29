<?php
if(isset($validar_contraseña)){
$estado_contraseña="Las contraseñas no coinciden";
}else
{
$estado_contraseña="";
}
if(isset($validar_correo)){
$estado_correo="Correo ya registrado";
}else
{
$estado_correo="";
}
$fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-15 year' , strtotime ( $fecha ) ) ;
$nuevafecha2 = strtotime ( '-55 year' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$nuevafecha2 = date ( 'Y-m-d' , $nuevafecha2 );
?>
<section class="index_body">
	<div class="personas form">
	<fieldset class="primer_fieldsetp">
			<legend class="primer_legend">Registro encuestado</legend>
	<?php echo $this->Form->create('Persona'); ?>
		<fieldset class="segunda_fieldset">
			<legend class="segunda_legend">Datos generales</legend>
				<table>
					<tr>	
						<th>
							Tipo de identificacion
						</th>
						<td>
							<?php echo $this->Form->input("tiposidentificacion_id",array("required" => "required",'label' => false)); ?>
						</td>
					</tr>
					<tr>
						<th>
							Identificacion
						</th>
						<td>
							<?php echo $this->Form->input("identificacion", array("label" => false,"required" => "required","pattern"=>"[0-9]+"));?>
						</td>
					</tr>
					<tr>	
						<th>
							Nombre
						</th>
						<td>
							<?php echo $this->Form->input("nombre", array("label" => false,"required" => "required","pattern"=>"[a-zA-Z]+"));?>
						</td>
					</tr>
					<tr>	
						<th>
							Apellido
						</th>
						<td>
							<?php echo $this->Form->input("apellido", array("label" => false,"required" => "required","pattern"=>"[a-zA-Z]+"));?>
						</td>
					</tr>
					<tr>	
						<th>
							Fecha de nacimiento
						</th>
						<td>
							<input type="date" required="required" name="data[Persona][fecha de nacimiento2]" min="<?php echo $nuevafecha2; ?>" max="<?php echo $nuevafecha; ?>">
						</td>
					</tr>
					<div>
						<?php echo $this->Form->create('PersonasProgramasSemestre'); ?>
							<tr>	
								<th>
									Programa
								</th>
								<td>
									<?php echo $this->Form->input("programa_id",array("required" => "required", 'label' => false)); ?>
								</td>
							</tr>
							<tr>	
								<th>
									Semestre
								</th>
								<td>
									<?php echo $this->Form->input("semestre_id",array("required" => "required", 'label' => false)); ?>

								</td>
							</tr>
					</div>
				</table>
		</fieldset>
		<fieldset class="segunda_fieldset">
			<legend class="segunda_legend">Datos de la cuenta</legend>
				<table>
					<tr>
						<td colspan="2">
							<p class="estado_c_e">
								<?php echo $estado_correo; ?>
							</p>
						</td>
					</tr>
					<tr>
						<th>
							Correo electronico
						</th>
						<td>
							<?php echo $this->Form->input('Correo',array("type" =>"email","label" =>false,"name" => "data[Persona][email]","required" => "required","pattern"=>"[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9.-]+"));?>
						</td>
					</tr>
					<?php echo $this->Form->create('User'); ?>
					<tr>
						<td colspan="2">
							<p class="estado_c_e">
								<?php echo $estado_contraseña;?>
							</p>
						</td>
					</tr>
					<tr>
						<th>
							Contraseña
						</th>
						<td>
							<?php echo $this->Form->input('password',array("type" =>"password","label" =>false,"required" => "required")); ?>
						</td>
					</tr>
					<tr>
						<th>
							Repita contraseña
						</th>
						<td>
							<?php echo $this->Form->input('password_confirmacion',array("type" =>"password","label" =>false,"required" => "required"));?>
						</td>
					</tr>
				</table>
		</fieldset>
		</br>
	<?php echo $this->Form->end(array('label' => 'Agregar','div' => array('class' => 'div_submit_centrado_2')));?>
	</br>
	</fieldset>
	</div>
</section>