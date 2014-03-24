<?php
App::uses('AppController', 'Controller');
/**
 * Cuestionarios Controller
 *
 * @property Cuestionario $Cuestionario
 */
class CuestionariosController extends AppController {
var $components = array("RequestHandler");
var $uses = array('Cuestionario','Persona','Competencia','Dominio','Pregunta');

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
			foreach ($competencias as $competencia) 
			{	
				$posicionc=0;
				foreach ($dominios as $dominio) 
				{
					$posicionp=0;
					if($dominio['Dominio']['competencia_id']==$competencia['Competencia']['id'])
					{
						$competencias[$posicion]['Competencia']['Dominios'][$posicionc]=$dominio['Dominio'];
						
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
