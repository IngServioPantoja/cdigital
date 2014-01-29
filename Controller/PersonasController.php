<?php
App::uses('AppController', 'Controller');
/**
 * Personas Controller
 *
 * @property Persona $Persona
 */
class PersonasController extends AppController {
/* Clase encargada de controlar las vistas de personas, interactua en gran cantidad con el modelo personas y el modelo user
puesto que al registrar una personas es necesario ingresar tanto sus datos personas que estan en la tabla personas como sus
datos de logueo es decir username y password que se encuentran en la tabla users */
var $uses = array('Persona','User','Nivel','Programa','Semestre','Tiposidentificacion','PersonasProgramasSemestre');
function beforeFilter(){
        $this->Auth->allow('add_invitado');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() { 
		$this->Persona->recursive = 1;
		if(isset($this->request->data['Busqueda'])){ 
			if ($this->request->data['Busqueda']['itemBusqueda']!=NULL and $this->request->data['Busqueda']['valorBusqueda']!=NULL) {
				$criterio=$this->request->data['Busqueda']['itemBusqueda'];
				$valor=$this->request->data['Busqueda']['valorBusqueda'];
				$this->set('personas', $this->paginate('Persona',array('Persona.'.$criterio.' LIKE' => '%'.$valor.'%')));
			}else{ 
				$this->set('personas', $this->paginate('Persona'));
			}
		}else{ 
			$this->set('personas', $this->paginate('Persona'));
		}
		$findTabla =$this->Persona->query("SELECT * FROM personas LIMIT 1;");
		foreach ($findTabla as $lbaKey => $lbaValue) {
			foreach ($lbaValue as $lveKey => $lveValue) {
			}
		}
		$keysarray=(array_keys($lveValue));
		$count=(count($keysarray));
		$listaBusqueda=array(); 
		for($a=0;$a<$count;$a++)
		{
			if (strpos($keysarray[$a], '_id') == false) 
				{
					$listaBusqueda[$keysarray[$a]]=$keysarray[$a]; 
				}
		}
		$this->set("listaBusqueda", $listaBusqueda);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		$this->User->recursive = 1;
		$optionspe = array('conditions' => array('Persona.' . $this->Persona->primaryKey => $id));
		$datospesona=$this->User->find('first', $optionspe);
		$optionspro = array('conditions' => array('Programa.' . $this->Programa->primaryKey => $datospesona['Persona']['programa_id']));
		$datosprograma=$this->Programa->find('first', $optionspro);
		$datospesona['Programa']=$datosprograma['Programa'];
		$this->set('persona',$datospesona);

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$semestres = $this->Semestre->find('list');
		$this->set('semestres',$semestres);
		$tiposidentificaciones = $this->Tiposidentificacion->find('list');
		$this->set('tiposidentificaciones',$tiposidentificaciones);
		$niveles = $this->Nivel->find('list');
		$this->set('niveles',$niveles);
		$programas = $this->Programa->find('list');
		$this->set('programas',$programas);
		if ($this->request->is('post')) {
			if($this->request->data['User']['password']==$this->request->data['User']['password_confirmacion']){
				$registrado = $this->User->find('first',
				array(
			    	'conditions' => 
			            array(
			                'User.username' => $this->request->data['Persona']['email']
			            	)
			    	)
				);
				if(count($registrado)<1){
					$this->request->data['User']['password']=Security::hash($this->request->data['User']['password'], null, true);
					$this->request->data['User']['username']=$this->request->data['Persona']['email'];
					$this->Persona->create();
					$this->User->create();
					$this->PersonasProgramasSemestre->create();
					if ($this->Persona->User->saveall($this->request->data)) {
						$this->request->data['PersonasProgramasSemestre']['persona_id']=$this->Persona->getInsertID();
						$this->PersonasProgramasSemestre->save($this->request->data);
						$this->Session->setFlash(__('The persona has been saved'));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The persona could not be saved. Please, try again.'));
					}


				}else{
					$this->set('validar_correo',$validar_correo=1);				
				}	
			}else{
				$this->set('validar_contraseña',$validar_contraseña=1);
				$registrado = $this->User->find('first',
				array(
			    	'conditions' => 
			            array(
			                'User.username' => $this->request->data['Persona']['email']
			            	)
			    	)
				);
				if(count($registrado)>1)
				{
					$this->set('validar_correo',$validar_correo=1);	
				}
			}		
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add_invitado() {

		$semestres = $this->Semestre->find('list');
		$this->set('semestres',$semestres);
		$tiposidentificaciones = $this->Tiposidentificacion->find('list');
		$this->set('tiposidentificaciones',$tiposidentificaciones);
		$niveles = $this->Nivel->find('list');
		$this->set('niveles',$niveles);
		$programas = $this->Programa->find('list');
		$this->set('programas',$programas);
		if ($this->request->is('post')) {
			$this->request->data['Persona']['fecha de nacimiento']['month']=substr($this->request->data['Persona'] ['fecha de nacimiento2'],5,-3);
			$this->request->data['Persona']['fecha de nacimiento']['day']=substr($this->request->data['Persona'] ['fecha de nacimiento2'],-2);
			$this->request->data['Persona']['fecha de nacimiento']['year']=substr($this->request->data['Persona'] ['fecha de nacimiento2'],0,-6);
			unset($this->request->data['Persona']['fecha de nacimiento2']);
			if($this->request->data['User']['password']==$this->request->data['User']['password_confirmacion']){
				$registrado = $this->User->find('first',
				array(
			    	'conditions' => 
			            array(
			                'User.username' => $this->request->data['Persona']['email']
			            	)
			    	)
				);
				if(count($registrado)<1){
					$this->request->data['User']['nivel_id']=2;
					$this->request->data['User']['password']=Security::hash($this->request->data['User']['password'], null, true);
					$this->request->data['User']['username']=$this->request->data['Persona']['email'];
					$this->Persona->create();
					$this->User->create();
					$this->PersonasProgramasSemestre->create();
					if ($this->Persona->User->saveall($this->request->data)) {
						$this->request->data['PersonasProgramasSemestre']['persona_id']=$this->Persona->getInsertID();
						$this->PersonasProgramasSemestre->save($this->request->data);
						$this->Session->setFlash(__('The persona has been saved'));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The persona could not be saved. Please, try again.'));
					}
				}else{
					$this->set('validar_correo',$validar_correo=1);				
				}	
			}else{
				$this->set('validar_contraseña',$validar_contraseña=1);
				$registrado = $this->User->find('first',
				array(
			    	'conditions' => 
			            array(
			                'User.username' => $this->request->data['Persona']['email']
			            	)
			    	)
				);
				if(count($registrado)>1)
				{
					$this->set('validar_correo',$validar_correo=1);	
				}
			}		
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Persona->create();
			$this->User->create();
			$this->PersonasProgramasSemestre->create();
			echo "</br>";echo "</br>";
			print_r($this->request->data);
			echo "</br>";echo "</br>";
			if ($this->Persona->User->saveall($this->request->data)) {
				$this->PersonasProgramasSemestre->save($this->request->data);
				$this->redirect(array('action' => 'index'));
				$this->Session->setFlash(__('Usuario modificado'));
			} else {
				$this->Session->setFlash(__('The persona could not be saved. Please, try again.'));
			}
		} else {

			$options = array('conditions' => array('PersonasProgramasSemestre.persona_id' => $id));
			$this->request->data= $this->PersonasProgramasSemestre->find('first', $options);
			$this->User->recursive = -1;
			$options = array('conditions' => array('User.persona_id' => $id));
			$data= $this->User->find('first', $options);
			foreach ($data as $key => $value) {
				$this->request->data[$key]=$value;
			}
		}
		$semestres = $this->Persona->Semestre->find('list');
		$this->set(compact('semestres'));
		$tiposidentificaciones = $this->Persona->Tiposidentificacion->find('list');
		$this->set(compact('tiposidentificaciones'));
		$programas = $this->Persona->Programa->find('list');
		$this->set(compact('programas'));
		$niveles = $this->User->Nivel->find('list');
		$this->set(compact('niveles'));
		//print_r($this->request->data);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit2($id = null) {
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
//se sumiteado algo
			if($this->request->data['User']['password']==$this->request->data['User']['password_confirmacion']){
				echo $registrado = $this->User->find('first',
					array(
				   		'conditions' => 
				    		array(
					            'AND'=>
					            	array(
					           		 	'User.id !='=>$this->request->data['User']['id'],
					           		 	'User.username' =>	$this->request->data['Persona']['email']

				        			)
							)
					)
				);
				if(count($registrado)<1){
					$this->request->data['User']['persona_id']=$id;
					$this->request->data['User']['password']=Security::hash($this->request->data['User']['password'], null, true);
					$this->request->data['User']['username']=$this->request->data['Persona']['email'];
					$this->Persona->create();
					$this->User->create();
					if ($this->Persona->User->saveall($this->request->data)) {
						$this->Session->setFlash(__('The persona has been saved'));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The persona could not be saved. Please, try again.'));
					}


				}else{
					$this->set('validar_correo',$validar_correo=1);				
				}	
			}else{
				$this->set('validar_contraseña',$validar_contraseña=1);
				echo $registrado = $this->User->find('first',
					array(
				   		'conditions' => 
				    		array(
					            'AND'=>
					            	array(
					           		 	'User.id !='=>$this->request->data['User']['id'],
					           		 	'User.username' =>	$this->request->data['Persona']['email']

				        			)
							)
					)
				);
				if(count($registrado)>1)
				{
					$this->set('validar_correo',$validar_correo=1);	
				}
			}	

		} else {

			$options = array('conditions' => array('User.persona_id' => $id));
			$this->request->data = $this->User->find('first', $options);
			$this->request->data['User']['password_confirmacion']=$this->request->data['User']['password'];
			$options = array('conditions' => array('PersonasProgramasSemestre.persona_id' => $id));
			$this->request->data = $this->PersonasProgramasSemestre->find('first', $options);

		}
		$semestres = $this->Persona->Semestre->find('list');
		$this->set(compact('semestres'));
		$tiposidentificaciones = $this->Persona->Tiposidentificacion->find('list');
		$this->set(compact('tiposidentificaciones'));
		$programas = $this->Persona->Programa->find('list');
		$this->set(compact('programas'));
		$niveles = $this->User->Nivel->find('list');
		$this->set(compact('niveles'));
		print_r($this->request->data);
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
		$this->Persona->id = $id;
		if (!$this->Persona->exists()) {
			throw new NotFoundException(__('Invalid persona'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Persona->delete()) {
			$this->Session->setFlash(__('Persona deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Persona was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
