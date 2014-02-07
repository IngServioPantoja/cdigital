<!DOCTYPE html>
<html lang='es_Es'>
    <head>
        <title>
            Software con CakePHP
        </title>
        <meta charset="utf-8"/>
        <?php 
			echo $this->Html->css(array('layout','normalize','style','extjs')); 
            echo $this->Html->script(array('jquery',)); 
        ?> 
    </head>
        <body id="body_layout">
             <?php 
             $jeje=$this->Session->flash();
                if($jeje!=null)
                {   
            ?>
                    <div class='mensaje_flash'>
                    <?php echo $jeje; ?>
                    </div>
            <?php
                }
             
             ?>
        
    	<div class="principal">
        <header class="layout_header">
        	<?php
                    echo $this->Html->image('escudo.gif', array('alt' => 'COMPDIG','height' => '70px', 'width' => '70px'));
			?>
            <div class="layout_title">
                <h1>
                    COMPDIG: HERRAMIENTA TECNOLOGICA PARA LA CARACTERIZACIÓN DE COMPETENCIAS DIGITALES
                </h1>
            </div>
        </header>
        <nav class="layout_nav">
            <!-- Barra de estado -->
           
            <?php
                    if($this->Session->check("Menu")==true){
                        foreach($this->Session->read("Menu") as $i => $v){
                            ?>
                            <ul> <?php echo $this->html->link($i, $v)." "; ?></ul>
                            <?php
                        }
                    } else {
            ?>
                <ul>    <?php    echo $this->html->link('Inicio','/')." "; ?> </ul>
                <ul>    <?php    echo $this->html->link('Registro','/personas/add_invitado'); ?> </ul>
            <?php
                    }
            ?>
        </nav>
            
            <section class="layout_contenido">
                <?php 
                    echo $content_for_layout; 
                ?>
            </section>
	<footer class="layout_footer">
  Abraham Arturo Cabrera Gil
    </footer>
</div>
<?php echo $this->Js->writeBuffer(array('cache'=>TRUE)); ?>  

</body>
</html>