<?php
App::uses('AppController', 'Controller');
/**
 * Cuestionarios Controller
 *
 * @property Cuestionario $Cuestionario
 */
class CuestionariosController extends AppController {
var $components = array("RequestHandler");
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cuestionario->recursive = 0;
		$this->set('cuestionarios', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cuestionario->exists($id)) {
			throw new NotFoundException(__('Invalid cuestionario'));
		}
		$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => $id));
		$this->set('cuestionario', $this->Cuestionario->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cuestionario->create();
			if ($this->Cuestionario->save($this->request->data)) {
				$this->Session->setFlash(__('The cuestionario has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cuestionario could not be saved. Please, try again.'));
			}
		}
		$personas = $this->Cuestionario->Persona->find('list');
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
		if (!$this->Cuestionario->exists($id)) {
			throw new NotFoundException(__('Invalid cuestionario'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cuestionario->save($this->request->data)) {
				$this->Session->setFlash(__('The cuestionario has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cuestionario could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cuestionario.' . $this->Cuestionario->primaryKey => $id));
			$this->request->data = $this->Cuestionario->find('first', $options);
		}
		$personas = $this->Cuestionario->Persona->find('list');
		$this->set(compact('personas'));
	}
/* edicion de cualquier campo general del cuestionario */

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
