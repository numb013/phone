<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class GenresController extends AppController {
	public $components = array('Search.Prg', 'Session', 'Master');
	public $paginate = array();

	public function admin_index() {
		$this->layout = "default";

		$this->Prg->commonProcess();
		//$this->paginate['conditions'] = $this->Genre->parseCriteria($this->passedArgs);
		$this->paginate = array(
			'conditions' => array(
				 'Genre.delete_flag' => '0'
			 ),
			'order' => array(
				'created' => 'DESC',
			),
			'limit' => '40'
		);
		$datas = $this->paginate();
                $this->set('datas',$datas);
        }

        public function admin_add() {
          $this->layout = "default";
          if ($this->request->is(array('post', 'put'))) {
            if ($this->Genre->save($this->request->data)) {
              return $this->redirect(
                array('controller' => 'Genres', 'action' => 'admin_index')
              );
            } else {
              return false;
            }
          }
        }

    public function admin_edit($id = null) {
	$this->layout = "default";
        if ($this->request->is(array('post', 'put'))) {
        $status = array(
            'Genre.name' => '"'.$this->request->data['Genre']['name'].'"',
        );
        $conditions = array(
            'Genre.id' => $this->request->data['Genre']['id'],
        );
        $this->Genre->updateAll($status, $conditions);

        return $this->redirect(
          array('controller' => 'Genres', 'action' => 'admin_index')
        );
    } else {
      $this->request->data = $this->Genre->find('first',array(
          'conditions' => array(
            'Genre.id' => $id
          ),
      ));
    }
  }


    public function admin_delete($id = null) {
          $this->layout = "default";
        if ($this->Genre->delete($id)) {
          return $this->redirect(
            array('controller' => 'Genres', 'action' => 'admin_index')
          );
        } else {
          return false;
        }
    }


    public function admin_detail($id = null) {
            if (isset($id)) {
                    $status = array(
                    'conditions' =>
                            array(
                                    'Genre.id' => $id,
                                    'Genre.delete_flag' => 0
                            )
                    );
                    // 以下がデータベース関係
                    $datas = $this->Genre->find('first', $status);
        $this->set('data',$datas);
            }
    }


}
