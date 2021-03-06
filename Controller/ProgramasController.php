<?php
App::uses('AppController', 'Controller');
/**
 * Programas Controller
 *
 * @property Programa $Programa
 */
class ProgramasController extends AppController {
    var $components = array("RequestHandler");

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Programa->recursive = 0;
		$this->set('programas', $this->paginate());
	
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Programa->exists($id)) {
			throw new NotFoundException(__('Invalid programa'));
		}
		$options = array('conditions' => array('Programa.' . $this->Programa->primaryKey => $id));
		$this->set('programa', $this->Programa->find('first', $options));

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->Session->setFlash(__('entra si quiera'));

		if ($this->request->is('post')) {
			$this->Programa->create();
			if ($this->Programa->save($this->request->data)) {
				$this->Session->setFlash(__('The programa has been saved'));
				$this->set('programas', $this->paginate());
				$this->render('index','ajax');
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programa could not be saved. Please, try again.'));
				$this->render('index','ajax');
			}
		}
		$facultades = $this->Programa->Facultad->find('list');
		$this->set(compact('facultades'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Programa->exists($id)) {
			throw new NotFoundException(__('Invalid programa'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Programa->save($this->request->data)) {
				$this->Session->setFlash(__('The programa has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programa could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Programa.' . $this->Programa->primaryKey => $id));
			$this->request->data = $this->Programa->find('first', $options);
		}
		$facultades = $this->Programa->Facultad->find('list');
		$this->set(compact('facultades'));
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
		$this->Programa->id = $id;
		if (!$this->Programa->exists()) {
			throw new NotFoundException(__('Invalid programa'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Programa->delete()) {
			$this->Session->setFlash(__('Programa deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Programa was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
