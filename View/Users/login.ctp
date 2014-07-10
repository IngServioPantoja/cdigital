<section class="index_body">
    <section class="index_contenido">
        <header>
        Iniciar sesión
        </header>
        <article>
            <?php
                echo $this->Form->create("User");
            ?>
            <table>
                <tr>
                    <td><b>Usuario: </b></td>
                    <td><?php echo $this->Form->input("username",
                            array("label" => false, "required" => "required", "pattern"=>"[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9.-]+"));?></td>
                </tr>
                <tr>
                    <td><b>Clave: </b></td>
                    <td><?php echo $this->Form->input("password",
                            array("label" => false, "required" => "required"));?></td>
                </tr>
            </table>
            <?php

                echo $this->Form->end(array(
                    'label' => 'Entrar',
                    'div' => array(
                        'class' => 'div_submit_centrado'
                    )));
            ?>  
        </article>
    </section>
    <section class="index_contenido">
        <header>
            ¿ Que es COMPDIG ?
        </header>
        <article>
            <p>
                La herramienta Compdig es una herramienta de ámbito web creada bajo el paradigma de programación orientado a objetos, para su desarrollo también se requiere el framework Cake Php y el entorno de desarrollo Xampp Server entre otros. El fin de esta herramienta  es evaluar las competencias digitales de los estudiantes de la Institución Universitaria CESMAG a través de un cuestionario web.  De igual forma esta herramienta contara con diversas opciones como la consulta de resultados del cuestionario y contara con tipos de usuarios, teniendo al usuario administrador y al usuario general, en la cual el usuario administrador tendrá privilegios exclusivos como la opción de administración de usuarios entre otras opciones.
            </p>
        </article>
    </section>
</section>
