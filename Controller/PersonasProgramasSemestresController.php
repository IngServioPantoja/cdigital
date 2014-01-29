<?php
App::uses('AppController', 'Controller');
/**
 * PersonasProgramasSemestres Controller
 *
 * @property PersonasProgramasSemestre $PersonasProgramasSemestre
 */
class PersonasProgramasSemestresController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PersonasProgramasSemestre->recursive = 0;
		$this->set('personasProgramasSemestres', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PersonasProgramasSemestre->exists($id)) {
			throw new NotFoundException(__('Invalid personas programas semestre'));
		}
		$options = array('conditions' => array('PersonasProgramasSemestre.' . $this->PersonasProgramasSemestre->primaryKey => $id));
		$this->set('personasProgramasSemestre', $this->PersonasProgramasSemestre->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			print_r($this->request->data);
			$this->PersonasProgramasSemestre->create();
			if ($this->PersonasProgramasSemestre->save($this->request->data)) {
				$this->Session->setFlash(__('The personas programas semestre has been saved'));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The personas programas semestre could not be saved. Please, try again.'));
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
		if (!$this->PersonasProgramasSemestre->exists($id)) {
			throw new NotFoundException(__('Invalid personas programas semestre'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PersonasProgramasSemestre->save($this->request->data)) {
				$this->Session->setFlash(__('The personas programas semestre has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The personas programas semestre could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PersonasProgramasSemestre.' . $this->PersonasProgramasSemestre->primaryKey => $id));
			$this->request->data = $this->PersonasProgramasSemestre->find('first', $options);
		}
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
		$this->PersonasProgramasSemestre->id = $id;
		if (!$this->PersonasProgramasSemestre->exists()) {
			throw new NotFoundException(__('Invalid personas programas semestre'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PersonasProgramasSemestre->delete()) {
			$this->Session->setFlash(__('Personas programas semestre deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Personas programas semestre was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
