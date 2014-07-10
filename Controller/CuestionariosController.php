<?php
App::uses('AppController', 'Controller');
/**
 * Cuestionarios Controller
 *
 * @property Cuestionario $Cuestionario
 */
class CuestionariosController extends AppController {
var $components = array("RequestHandler");
var $uses = array('Cuestionario','Persona','Competencia','Dominio','Pregunta','Respuesta','PersonasCuestionario','Escala','Facultad','Programa');

	public function index() {
		$this->Cuestionario->recursive = 0;
		$this->set('cuestionarios', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->Cuestionario->exists($id)) {
			throw new NotFoundException(__('Invalid cuestionario'));
		}
		$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => $id));
		$this->set('cuestionario', $this->Cuestionario->find('first', $options));
	}
	public function resultado_opciones() 
	{
	
	}

	public function responder($id=null) {
		$Usuario=$this->Session->read("Usuario");
		$this->PersonasCuestionario->recursive = -1;
		$options = array('conditions' => array('PersonasCuestionario.persona_id'=> $Usuario['Persona']['id']));
		$existequest=$this->PersonasCuestionario->find('first', $options);
		$this->set('personacuestionario',$existequest);
		if(count($existequest)>0)
		{
			$id=$existequest['PersonasCuestionario']['id'];
		}
		
		$this->set('cuestionarioactual',$id);
		if (count($existequest)<=0) 
		{
			//si no esxiste este cuestionario vamos a crearlo
			$this->PersonasCuestionario->create();
			$personacuestionario=array();
	        $fecha = date_create();
			$fecha = date_format($fecha, 'Y-m-d H:i:s');
			$personacuestionario['PersonasCuestionario']['fecha realizacion']=$fecha;
			$personacuestionario['PersonasCuestionario']['persona_id']=$Usuario['Persona']['id'];
			$personacuestionario['PersonasCuestionario']['cuestionario_id']=1;
			if ($this->PersonasCuestionario->save($personacuestionario)) {
				$this->Cuestionario->recursive = 0;
				//Obtengo el cuestionario actual
				$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => 1));
				$cuestionario=$this->Cuestionario->find('first', $options);
				$options = array('conditions' => array('Competencia.cuestionario_id'=> $id),
					'order' => array('Competencia.orden asc'));
				$this->Competencia->recursive = -1;
				$this->Dominio->recursive = -1;
				$options = array('conditions' => array('Competencia.cuestionario_id'=>  $cuestionario['Cuestionario'] ['id']),
					'order' => array('Competencia.orden asc'));
				$competencias= $this->Competencia->find('all', $options);
				//buscamos los niveles de dominio
				$options = array('order' => array('Dominio.orden asc'));
				$dominios  = $this->Dominio->find('all', $options);
				//buscamos todas las preguntas
				$options = array('order' => array('Pregunta.orden asc'));
				$preguntas  = $this->Pregunta->find('all', $options);
				//print_r($dominios);
				$posicionc=0;
				$posicion=0;
				$posicionp=0;
				$selectNivel=array();
				foreach ($competencias as $competencia) 
				{	
					foreach ($dominios as $dominio) 
					{
						if($dominio['Dominio']['competencia_id']==$competencia['Competencia']['id'])
						{
							foreach ($preguntas as $pregunta) 
							{

								$pregunta['Pregunta']['dominio_id'];
								if($pregunta['Pregunta']['dominio_id']==$dominio['Dominio']['id'])
								{
									$this->Respuesta->create();
									$respuesta=array();
									$respuesta['Respuesta']['pregunta_id']=$pregunta['Pregunta']['id'];
									$respuesta['Respuesta']['personacuestionario_id']=$this->PersonasCuestionario->id;
									if ($this->Respuesta->save($respuesta)) {
										$this->redirect(array('action' => 'responder'));	

									}
								}
							}
						}

					}
				}
				$this->Session->setFlash(__('Cuestionario creado exitosamente'));
				$this->redirect(array('action' => 'responder/'.$this->PersonasCuestionario->id));
			}		
		}else
		{
			if ($this->request->is('post')) 
			{
				echo "Quiero completar el cuestionario";
				print_r($this->request->data);
				if ($this->PersonasCuestionario->save($this->request->data)) {
					$this->Session->setFlash(__('Cuestionario guardado exitosamente'));
					
					$this->redirect(array('action' => 'resultado_individual'));
					//toca continuar con la poción de completar cuestionri onada mas...
				}
		
			}else
			{
				$this->Cuestionario->recursive = 0;
				//Obtengo el cuestionario actual
				$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => 1));
				$cuestionario=$this->Cuestionario->find('first', $options);
				$options = array('conditions' => array('Competencia.cuestionario_id'=> $id),
					'order' => array('Competencia.orden asc'));
				$this->Competencia->recursive = -1;
				$this->Dominio->recursive = -1;
				$options = array('conditions' => array('Competencia.cuestionario_id'=>  $cuestionario['Cuestionario'] ['id']),
					'order' => array('Competencia.orden asc'));
				$competencias= $this->Competencia->find('all', $options);
				//buscamos los niveles de dominio
				$options = array('order' => array('Dominio.orden asc'));
				$dominios  = $this->Dominio->find('all', $options);
				//buscamos todas las preguntas
				$options = array('order' => array('Pregunta.orden asc'));
				$preguntas  = $this->Pregunta->find('all', $options);

				$options = array('order' => array('Respuesta.id asc'),'recursive'=>-1);
				$respuestas  = $this->Respuesta->find('all', $options);
				//print_r($dominios);
				$posicionc=0;
				$posicion=0;
				$posicionp=0;
				$selectNivel=array();
				foreach ($competencias as $competencia) 
				{	
					$posicionc=0;
					foreach ($dominios as $dominio) 
					{
						$posicionp=0;
						if($dominio['Dominio']['competencia_id']==$competencia['Competencia']['id'])
						{
							$competencias[$posicion]['Competencia']['Dominios'][$posicionc]=$dominio['Dominio'];
							$selectNivel[$competencia['Competencia']['nombre']][$dominio['Dominio']['id']]=$dominio['Dominio']['nombre'];
							foreach ($preguntas as $pregunta) 
							{

								$pregunta['Pregunta']['dominio_id'];
								if($pregunta['Pregunta']['dominio_id']==$dominio['Dominio']['id'])
								{
									$competencias[$posicion]['Competencia']['Dominios'][$posicionc]['Preguntas'][$posicionp]=$pregunta['Pregunta'];
									$existerespuesta=0;
									foreach ($respuestas as $respuesta) 
									{
										if ($pregunta['Pregunta']['id']==$respuesta['Respuesta']['pregunta_id'] && $respuesta['Respuesta']['personacuestionario_id']==$id) 
										{
											$existerespuesta=1;
											$competencias[$posicion]['Competencia']['Dominios'][$posicionc]['Preguntas'][$posicionp]['idrespuesta']=$respuesta['Respuesta']['id'];
											$competencias[$posicion]['Competencia']['Dominios'][$posicionc]['Preguntas'][$posicionp]['respuestavalue']=$respuesta['Respuesta']['valor'];
										}

									}
									if($existerespuesta==0)
									{

										$this->Respuesta->create();
										$respuesta=array();
										$respuesta['Respuesta']['pregunta_id']=$pregunta['Pregunta']['id'];
										$respuesta['Respuesta']['personacuestionario_id']=$id;
										if ($this->Respuesta->save($respuesta)) {

											$competencias[$posicion]['Competencia']['Dominios'][$posicionc]['Preguntas'][$posicionp]['idrespuesta']=$this->Respuesta->id;
											$competencias[$posicion]['Competencia']['Dominios'][$posicionc]['Preguntas'][$posicionp]['respuestavalue']=1;

										}



									}

								}
								++$posicionp;	
							}
							++$posicionc;
						}
					}
					++$posicion;
				}
				$cuestionario['Competencias']=$competencias;
				$this->request->data=$cuestionario;
				$this->set('cuestionario',$this->request->data);
				$this->set('dominios',$selectNivel);
			}

		}
		
		$personas = $this->Cuestionario->Persona->find('list');
		$this->set(compact('personas'));
	}
	public function resultado_opciones_lista() {
	}
	public function resultado_opciones_admin() {
	}

	public function resultado_individual($id=null) {

		$Usuario=$this->Session->read("Usuario");
		$this->PersonasCuestionario->recursive = -1;
		if(!isset($this->request->data['Cuestionario']['Cedula']))
		{
		$id=$Usuario['Persona']['id'];
		$encuestado=$Usuario['Persona']['identificacion'];
		$this->set('encuestado',$Usuario);
		}else
		{
			//Aqui entramos en caso de que si enviemos la cedula de la persona de quien deseamos mostrar le resultado
			$encuestado=$this->request->data['Cuestionario']['Cedula'];
			// aca soo faldt adecir qu esi se ha mandado un id que hace??
			$options = array('conditions' => array('Persona.identificacion' => $this->request->data['Cuestionario']['Cedula']));
			$personaEncuestada=$this->Persona->find('first', $options);
			if(!isset($personaEncuestada['Persona']['id']))
			{
				$this->redirect(array('action' => 'resultado_opciones_lista'));
			}else
			{
				$id=$personaEncuestada['Persona']['id'];
				$this->set('encuestado',$personaEncuestada);
			}

		}
		$options = array('conditions' => array('PersonasCuestionario.persona_id'=> $id));
		$existequest=$this->PersonasCuestionario->find('first', $options);
		if(count($existequest)>0)
		{
			$id=$existequest['PersonasCuestionario']['id'];
		}
		
		$this->set('cuestionarioactual',$id);

		/*
		Proceso almacenado ni tan almacenado
		*/

		//$result=$this->Cuestionario->query("call resultado_estudiante(".$encuestado.");");

		$result=$this->Cuestionario->query("
			select FA.id,
			FA.nombre,
			PR.id,
			PR.nombre,
			SE.nivel,
			PRS.identificacion,
			PRS.nombre,
			PRS.apellido,
			CP.id,
			CP.nombre,
			    
			(select sum(respuestas.valor) from respuestas 
				inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
			    inner join dominios on (preguntas.dominio_id = dominios.id) 
			    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
			    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
			    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
			    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PNS.id)
			 	where PNS.id=PRS.id   
			 	group by CPS.id having CPS.id=CP.id LIMIT 1) as totalcompetencia,
			    
			(select count(preguntas.id) from preguntas 
				inner join dominios on (preguntas.dominio_id = dominios.id) 
			    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
			    group by CPS.id having CPS.id = CP.id LIMIT 1) as preguntascompetencia,
			    
			truncate(((select sum(respuestas.valor) from respuestas 
				inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
			    inner join dominios on (preguntas.dominio_id = dominios.id) 
			    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
			    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
			    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
			    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PNS.id)
			 	where PNS.id=PRS.id   
			 	group by CPS.id having CPS.id=CP.id LIMIT 1)/
			          (select count(preguntas.id) from preguntas 
				inner join dominios on (preguntas.dominio_id = dominios.id) 
			    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
			    group by CPS.id having CPS.id = CP.id LIMIT 1)),2) as valorcompetencia,
			dominios.id,dominios.nombre,
			# Deseamos calcular el puntaje por el nivel de dominio             
			sum(respuestas.valor) as puntajetotaldominio,

			# Es la cantidad de preguntas por el nivel de dominio
			count(preguntas.id) as preguntasdominio,

			# Calculamos el puntaje de 0-5 del nivel de dominio
			(truncate((sum(respuestas.valor)/count(preguntas.id)),2))as puntajeescaladominio,
			#Concepto del puntaje
			(select escalas.concepto from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as concepto,
			#Color del puntaje
			(select escalas.color from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as color

			from respuestas inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
				inner join dominios on (preguntas.dominio_id = dominios.id) 
				inner join competencias CP on (dominios.competencia_id=CP.id) 
			    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
			    inner join personas  PRS on (personas_cuestionarios.persona_id = PRS.id) 
			    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PRS.id)
			    inner join programas PR on (personas_programas_semestres.programa_id = PR.id)
			    inner join semestres SE on (personas_programas_semestres.semestre_id = SE.id)
			    inner join facultades FA on (PR.facultad_id = FA.id)
			    where PRS.identificacion = $encuestado
			    group by PRS.id,dominios.id order by FA.nombre asc,PR.nombre asc,SE.nivel asc,PRS.apellido asc,CP.orden asc,dominios.orden asc,preguntas.orden asc;

		");

		/*   Consulta resultados */

		$this->set('resultados_estudiante',$result);

			$this->Cuestionario->recursive = 0;
			//Obtengo el cuestionario actual
			$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => 1));
			$cuestionario=$this->Cuestionario->find('first', $options);
			$this->request->data=$cuestionario;
			$this->set('cuestionario',$this->request->data);

	}

	public function resultado_programa($idPrograma=null) {

			
		

		$Usuario=$this->Session->read("Usuario");
		$this->PersonasCuestionario->recursive = -1;
		if(!isset($idPrograma))
		{
		
		$idPersona=$Usuario['Persona']['id'];
		$options = array('conditions' => array('Persona.id' => $Usuario['Persona']['id']));
		$personaEncuestada=$this->Persona->find('first', $options);
		$idPrograma=$personaEncuestada['Programa'][0]['id'];
		//echo $idPrograma['Programa'][0]['id'];

		if ($this->request->is('ajax')) {
			$idPrograma=$this->request->data['Programa']['programa'];
		}

		}

		$options = array('conditions' => array('PersonasCuestionario.persona_id'=> $idPersona));
		$existequest=$this->PersonasCuestionario->find('first', $options);
		if(count($existequest)>0)
		{
			$idPersona=$existequest['PersonasCuestionario']['id'];
		}
		
		
		$this->set('cuestionarioactual',$idPersona);

		/*  Proceso para programas  */
		$result=$this->Cuestionario->query("

		select FA.id,
		FA.nombre,
		PR.id,
		PR.nombre,
		SE.nivel,
		PRS.identificacion,
		PRS.nombre,
		PRS.apellido,
		CP.id,
		CP.nombre,
		    
		(select sum(respuestas.valor) from respuestas 
			inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		 	where PPS.programa_id = $idPrograma
		 	group by CPS.id having CPS.id=CP.id LIMIT 1) as totalcompetencia,
		    
		(select count(respuestas.id) from respuestas 
			inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		 	where PPS.programa_id = $idPrograma
		 	group by CPS.id having CPS.id=CP.id LIMIT 1) as preguntascompetencia,    
		    
		(truncate(((select sum(respuestas.valor) from respuestas 
			inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		 	where PPS.programa_id = $idPrograma
		 	group by CPS.id having CPS.id=CP.id LIMIT 1)/
		          (select count(respuestas.id) from respuestas 
			inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		 	where PPS.programa_id = $idPrograma
		 	group by CPS.id having CPS.id=CP.id LIMIT 1)),2)) as valorcompetencia,
		    
		dominios.id,dominios.nombre,
		# Deseamos calcular el puntaje por el nivel de dominio             
		sum(respuestas.valor) as puntajetotaldominio,

		# Es la cantidad de preguntas por el nivel de dominio
		count(preguntas.id) as preguntasdominio,

		# Calculamos el puntaje de 0-5 del nivel de dominio
		(truncate((sum(respuestas.valor)/count(preguntas.id)),2))as puntajeescaladominio,
		#Concepto del puntaje
		(select escalas.concepto from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as concepto,
		#Color del puntaje
		(select escalas.color from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as color

		from respuestas inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
			inner join dominios on (preguntas.dominio_id = dominios.id) 
			inner join competencias CP on (dominios.competencia_id=CP.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas  PRS on (personas_cuestionarios.persona_id = PRS.id) 
		    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PRS.id)
		    inner join programas PR on (personas_programas_semestres.programa_id = PR.id)
		    inner join semestres SE on (personas_programas_semestres.semestre_id = SE.id)
		    inner join facultades FA on (PR.facultad_id = FA.id)
		    where PR.id = $idPrograma
		    group by dominios.id order by FA.nombre asc,PR.nombre asc,SE.nivel asc,PRS.apellido asc,CP.orden asc,dominios.orden asc,preguntas.orden asc;
		");    
		/*  Proceso para programas  */
		$this->set('resultados_estudiante',$result);

			$this->Cuestionario->recursive = 0;
			//Obtengo el cuestionario actual
			$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => 1));
			$cuestionario=$this->Cuestionario->find('first', $options);
			$this->request->data=$cuestionario;
			$this->set('cuestionario',$this->request->data);
			$this->set('programas',$this->Programa->find('list'));
			$this->set('programaactual',$idPrograma);	



	}

	public function resultado_universidad($idUniversidad=null) {

			
		

		$Usuario=$this->Session->read("Usuario");
		$this->PersonasCuestionario->recursive = -1;

		if ($this->request->is('ajax')) {
			$idPrograma=$this->request->data['Programa']['programa'];
		}

		$idPersona=$Usuario['Persona']['id'];
		$options = array('conditions' => array('PersonasCuestionario.persona_id'=> $idPersona));
		$existequest=$this->PersonasCuestionario->find('first', $options);
		if(count($existequest)>0)
		{
			$idPersona=$existequest['PersonasCuestionario']['id'];
		}
		
		$this->set('cuestionarioactual',$idPersona);

		/*   Consulta resultados */
		$result=$this->Cuestionario->query("

		select FA.id,
		FA.nombre,
		PR.id,
		PR.nombre,
		SE.nivel,
		PRS.identificacion,
		PRS.nombre,
		PRS.apellido,
		CP.id,
		CP.nombre,
		    
		(select sum(respuestas.valor) from respuestas 
		    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		    inner join programas PRS on (PPS.programa_id = PRS.id)
		    inner join semestres SES on (PPS.semestre_id = SES.id)
		    inner join facultades FAS on (PRS.facultad_id = FAS.id)
		    group by CPS.id having CPS.id=CP.id LIMIT 1) as totalcompetencia,
		    
		(select count(respuestas.id) from respuestas 
		    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		    inner join programas PRS on (PPS.programa_id = PRS.id)
		    inner join semestres SES on (PPS.semestre_id = SES.id)
		    inner join facultades FAS on (PRS.facultad_id = FAS.id)
		    group by CPS.id having CPS.id=CP.id LIMIT 1) as preguntascompetencia,    
		    
		(truncate(((select sum(respuestas.valor) from respuestas 
		    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		    inner join programas PRS on (PPS.programa_id = PRS.id)
		    inner join semestres SES on (PPS.semestre_id = SES.id)
		    inner join facultades FAS on (PRS.facultad_id = FAS.id)
		    group by CPS.id having CPS.id=CP.id LIMIT 1)/
		          (select count(respuestas.id) from respuestas 
		    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		    inner join programas PRS on (PPS.programa_id = PRS.id)
		    inner join semestres SES on (PPS.semestre_id = SES.id)
		    inner join facultades FAS on (PRS.facultad_id = FAS.id)
		    group by CPS.id having CPS.id=CP.id LIMIT 1)),2)) as valorcompetencia,
		    
		dominios.id,dominios.nombre,
		# Deseamos calcular el puntaje por el nivel de dominio             
		sum(respuestas.valor) as puntajetotaldominio,

		# Es la cantidad de preguntas por el nivel de dominio
		count(preguntas.id) as preguntasdominio,

		# Calculamos el puntaje de 0-5 del nivel de dominio
		(truncate((sum(respuestas.valor)/count(preguntas.id)),2))as puntajeescaladominio,
		#Concepto del puntaje
		(select escalas.concepto from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as concepto,
		#Color del puntaje
		(select escalas.color from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as color

		from respuestas inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CP on (dominios.competencia_id=CP.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas  PRS on (personas_cuestionarios.persona_id = PRS.id) 
		    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PRS.id)
		    inner join programas PR on (personas_programas_semestres.programa_id = PR.id)
		    inner join semestres SE on (personas_programas_semestres.semestre_id = SE.id)
		    inner join facultades FA on (PR.facultad_id = FA.id)
		    group by dominios.id order by FA.nombre asc,PR.nombre asc,SE.nivel asc,PRS.apellido asc,CP.orden asc,dominios.orden asc,preguntas.orden asc;	


		");
		/*   Consulta resultados */
		$this->set('resultados_estudiante',$result);

			$this->Cuestionario->recursive = 0;
			//Obtengo el cuestionario actual
			$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => 1));
			$cuestionario=$this->Cuestionario->find('first', $options);
			$this->request->data=$cuestionario;
			$this->set('cuestionario',$this->request->data);
			$this->set('programas',$this->Programa->find('list'));
	}

	public function resultado_facultad($idFacultad=null) {

			
		

		$Usuario=$this->Session->read("Usuario");
		$this->PersonasCuestionario->recursive = -1;
		if(!isset($idFaultad))
		{
		
		$idPersona=$Usuario['Persona']['id'];
		$options = array('conditions' => array('Persona.id' => $Usuario['Persona']['id']));
		$personaEncuestada=$this->Persona->find('first', $options);
		$idFacultad=$personaEncuestada['Programa'][0]['facultad_id'];
		
		if ($this->request->is('ajax')) {
			$idFacultad=$this->request->data['Facultad']['facultad'];

		}

		//sIMPLEMENTE ME FALTA TEMIRNAR EL CASO DE USO DE REUSTLAODS PRO FACUTLA DY MEURE ESTA MIERDA..
		}
		$options = array('conditions' => array('PersonasCuestionario.persona_id'=> $idPersona));
		$existequest=$this->PersonasCuestionario->find('first', $options);
		if(count($existequest)>0)
		{
			$idPersona=$existequest['PersonasCuestionario']['id'];
		}
		
		$this->set('cuestionarioactual',$idPersona);
		/* Resutlados por facultad*/
		$result=$this->Cuestionario->query("

			
		select FA.id,
		FA.nombre,
		PR.id,
		PR.nombre,
		SE.nivel,
		PRS.identificacion,
		PRS.nombre,
		PRS.apellido,
		CP.id,
		CP.nombre,
		    
		(select sum(respuestas.valor) from respuestas 
		    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		    inner join programas PRS on (PPS.programa_id = PRS.id)
		    inner join semestres SES on (PPS.semestre_id = SES.id)
		    inner join facultades FAS on (PRS.facultad_id = FAS.id)
		    where FA.id = $idFacultad
		    group by CPS.id having CPS.id=CP.id LIMIT 1) as totalcompetencia,
		    
		(select count(respuestas.id) from respuestas 
		    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		    inner join programas PRS on (PPS.programa_id = PRS.id)
		    inner join semestres SES on (PPS.semestre_id = SES.id)
		    inner join facultades FAS on (PRS.facultad_id = FAS.id)
		    where FA.id = $idFacultad
		    group by CPS.id having CPS.id=CP.id LIMIT 1) as preguntascompetencia,    
		    
		(truncate(((select sum(respuestas.valor) from respuestas 
		    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		    inner join programas PRS on (PPS.programa_id = PRS.id)
		    inner join semestres SES on (PPS.semestre_id = SES.id)
		    inner join facultades FAS on (PRS.facultad_id = FAS.id)
		    where FA.id = $idFacultad
		    group by CPS.id having CPS.id=CP.id LIMIT 1)/
		          (select count(respuestas.id) from respuestas 
		    inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CPS on (dominios.competencia_id=CPS.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas PNS on (personas_cuestionarios.persona_id = PNS.id) 
		    inner join personas_programas_semestres PPS on (PPS.persona_id = PNS.id)
		    inner join programas PRS on (PPS.programa_id = PRS.id)
		    inner join semestres SES on (PPS.semestre_id = SES.id)
		    inner join facultades FAS on (PRS.facultad_id = FAS.id)
		           where FA.id = $idFacultad
		    group by CPS.id having CPS.id=CP.id LIMIT 1)),2)) as valorcompetencia,
		    
		dominios.id,dominios.nombre,
		# Deseamos calcular el puntaje por el nivel de dominio             
		sum(respuestas.valor) as puntajetotaldominio,

		# Es la cantidad de preguntas por el nivel de dominio
		count(preguntas.id) as preguntasdominio,

		# Calculamos el puntaje de 0-5 del nivel de dominio
		(truncate((sum(respuestas.valor)/count(preguntas.id)),2))as puntajeescaladominio,
		#Concepto del puntaje
		(select escalas.concepto from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as concepto,
		#Color del puntaje
		(select escalas.color from escalas where (truncate((sum(respuestas.valor)/count(preguntas.id)),2)>=escalas.valorInicio and truncate((sum(respuestas.valor)/count(preguntas.id)),2)<escalas.valorFin) limit 1)as color

		from respuestas inner join preguntas on (respuestas.pregunta_id = preguntas.id) 
		    inner join dominios on (preguntas.dominio_id = dominios.id) 
		    inner join competencias CP on (dominios.competencia_id=CP.id) 
		    inner join personas_cuestionarios on (personacuestionario_id=personas_cuestionarios.id) 
		    inner join personas  PRS on (personas_cuestionarios.persona_id = PRS.id) 
		    inner join personas_programas_semestres on (personas_programas_semestres.persona_id = PRS.id)
		    inner join programas PR on (personas_programas_semestres.programa_id = PR.id)
		    inner join semestres SE on (personas_programas_semestres.semestre_id = SE.id)
		    inner join facultades FA on (PR.facultad_id = FA.id)
		    where FA.id = $idFacultad
		    group by dominios.id order by FA.nombre asc,PR.nombre asc,SE.nivel asc,PRS.apellido asc,CP.orden asc,dominios.orden asc,preguntas.orden asc;	



		");
		/* Resutlados por facultad*/
		$this->set('resultados_estudiante',$result);

			$this->Cuestionario->recursive = 0;
			//Obtengo el cuestionario actual
			$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => 1));
			$cuestionario=$this->Cuestionario->find('first', $options);
			$this->request->data=$cuestionario;
			$this->set('cuestionario',$this->request->data);
			$this->set('facultades',$this->Facultad->find('list'));
			$this->set('facultadvalue',$idFacultad);


	}


	public function actualizar_pregunta()
	{
		$this->autoRender = false;
		$pregunta=array();
		$pregunta['Pregunta']['id']=$_POST['id'];
		$pregunta['Pregunta']['titulo']=$_POST['titulo'];		
		$this->Pregunta->save($pregunta);
				//$this->redirect(array('action' => 'index'));
			
			

	}
		public function actualizar_respuesta()
	{
		$this->autoRender = false;
		$respuesta=array();
		$respuesta['Respuesta']['id']=$_POST['id'];
		$respuesta['Respuesta']['valor']=$_POST['valor'];		
		$this->Respuesta->save($respuesta);
				//$this->redirect(array('action' => 'index'));
			
			

	}

	public function edit($id = null) {
		if (!$this->Cuestionario->exists($id)) {
			throw new NotFoundException(__('Invalid cuestionario'));
		}
		if ($this->request->is('post')) {

			echo "quiero agregar una pregunta";
			$opciones=array(
				'joins' => array(
			        array(
			            'table' => 'dominios',
			            'alias' => 'Dominio',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Dominio.id = Pregunta.dominio_id'
			            	)
			        	)
	    		),
			    'fields' => array('Pregunta.orden','Dominio.id'),
			    'recursive' => -1,
			    'order'=>array('Pregunta.orden desc'),
			    'limit'=>1
			);
			$dominio=$this->Pregunta->find('first', $opciones);
			$this->Pregunta->create();
			$this->request->data['Pregunta']['orden']=$dominio['Pregunta']['orden']+1;
			if ($this->Pregunta->save($this->request->data)) {

				$this->Session->setFlash(__('Pregunta agregada exitosamente'));
				$this->redirect(array('action' => 'edit/1'));
			} else {
				$this->Session->setFlash(__('The cuestionario could not be saved. Please, try again.'));
			}
		}else
		{
			$this->Cuestionario->recursive = 0;
			//Obtengo el cuestionario actual
			$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => $id));
			$cuestionario=$this->Cuestionario->find('first', $options);
			$options = array('conditions' => array('Competencia.cuestionario_id'=> $id),
				'order' => array('Competencia.orden asc'));
			$this->Competencia->recursive = -1;
			$this->Dominio->recursive = -1;
			$options = array('conditions' => array('Competencia.cuestionario_id'=>  $cuestionario['Cuestionario'] ['id']),
				'order' => array('Competencia.orden asc'));
			$competencias= $this->Competencia->find('all', $options);
			//buscamos los niveles de dominio
			$options = array('order' => array('Dominio.orden asc'));
			$dominios  = $this->Dominio->find('all', $options);
			//buscamos todas las preguntas
			$options = array('order' => array('Pregunta.orden asc'));
			$preguntas  = $this->Pregunta->find('all', $options);
			//print_r($dominios);
			$posicionc=0;
			$posicion=0;
			$posicionp=0;
			$selectNivel=array();
			foreach ($competencias as $competencia) 
			{	
				$posicionc=0;
				foreach ($dominios as $dominio) 
				{
					$posicionp=0;
					if($dominio['Dominio']['competencia_id']==$competencia['Competencia']['id'])
					{
						$competencias[$posicion]['Competencia']['Dominios'][$posicionc]=$dominio['Dominio'];
						$selectNivel[$competencia['Competencia']['nombre']][$dominio['Dominio']['id']]=$dominio['Dominio']['nombre'];
						foreach ($preguntas as $pregunta) 
						{

							$pregunta['Pregunta']['dominio_id'];
							if($pregunta['Pregunta']['dominio_id']==$dominio['Dominio']['id'])
							{
								$competencias[$posicion]['Competencia']['Dominios'][$posicionc]['Preguntas'][$posicionp]=$pregunta['Pregunta'];
							}
							++$posicionp;	
						}
						++$posicionc;
					}

				}
				++$posicion;
			}
			$cuestionario['Competencias']=$competencias;
			$this->request->data=$cuestionario;
			$this->set('cuestionario',$this->request->data);
			$this->set('dominios',$selectNivel);
		}
		}

	public function actualizar_general() {
		print_r($this->request->data);
		$id=$this->request->data['Cuestionario']['id'];
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cuestionario->save($this->request->data)) {
				//$this->Session->setFlash(__('The cuestionario has been saved'));
				//$this->redirect(array('action' => 'index'));
				
			} else {
				//$this->Session->setFlash(__('The cuestionario could not be saved. Please, try again.'));
			}
		}
		$this->render('/cuestionarios/actualizar_general');

	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cuestionario->id = $id;
		if (!$this->Cuestionario->exists()) {
			throw new NotFoundException(__('Invalid cuestionario'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cuestionario->delete()) {
			$this->Session->setFlash(__('Cuestionario deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Cuestionario was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
