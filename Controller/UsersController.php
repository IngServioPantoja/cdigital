<?php
App::uses('AppController', 'Controller');
/**
 * users Controller
 *
 * @property user $user
 */
class UsersController extends AppController {
    var $helpers = array("Html", "Form");
    var $components = array("Auth");
    var $uses = array('User','Persona','PersonasCuestionario');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$personas = $this->User->Persona->find('list');
		$this->set(compact('personas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$personas = $this->User->Persona->find('list');
		$this->set(compact('personas'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	function login(){
        if($this->Session->check("Menu")==true){
        	$this->Session->destroy();
        	$this->redirect("/users/login/");
        }
        if(isset($this->data)&&!empty($this->data)){
        	$r = $this->User->find("first", array(
                "conditions" => array(
                    "username" => $this->data["User"]["username"]
                )
            ));
            if(count($r)==3){
				$r = $this->User->find("first", array(
                	"conditions" => array(
                  	  "username" => $this->data["User"]["username"],
                 	   "password" => Security::hash($this->data["User"]["password"], null, true)
               		)
           	 	));
				if(count($r)==3){
					if($this->Auth->login($this->data)){
						$opciones=array(
										'joins' => array(
									        array(
									            'table' => 'personas',
									            'alias' => 'Persona',
									            'type' => 'INNER',
									            'conditions' => 
									            array(
									                'Persona.id = PersonasCuestionario.persona_id'
									            	)
									        	)
							    		),
									    'recursive' => -1,
									    'limit'=>1
									);
								$PersonasCuestionario=$this->PersonasCuestionario->find('first', $opciones);
								
						
						if (isset($PersonasCuestionario['PersonasCuestionario'])) {
							$r['Cuestionario']=$PersonasCuestionario['PersonasCuestionario'];
						}else
						{
							$r['Cuestionario']['id']=0;
						}
						$this->Session->write("Usuario",$r);
						print_r($r);
						$this->redirect("/menus/mnuMain/");
            		 }
				}
				else{
						$this->Session->setFlash(__('Contraseña incorrecta'));
				}
            }
            else{
            	$this->Session->setFlash(__('Nombre de usuario no existe en la base de datos'));
	        }
        }
    }
    
    function logout(){
        $this->redirect($this->Auth->logout());
    }
}
