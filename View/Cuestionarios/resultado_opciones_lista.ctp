<section class="index_body">
	<fieldset class="primer_fieldsetm" style="padding:0px;overflow:hidden;">
		<?php
			echo $this->Form->create('Cuestionario',array('action'=>'resultado_individual'));
			echo "<label style='color:#777;text-shadow:0px 0px 5px #fff;'> Cedula </label>";
			echo $this->Form->input(
				'Cedula',array('label'=>false));
			echo $this->Form->end(" Buscar");
			?>	


	</fieldset>
</section>