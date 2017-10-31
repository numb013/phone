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
class UsersController extends AppController {
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

	public $components = Array('Cookie');

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
 public function beforeFilter() {
     parent::beforeFilter();
     // ユーザー自身による登録とログアウトを許可する
     $this->Auth->allow('add', 'logout');
 }

 public function admin_login() {
     if ($this->request->is('post')) {
         if ($this->Auth->login()) {
            $this->Cookie->write('Auth.User', $this->request->data['User'], false, '+4 weeks');
            $this->redirect($this->Auth->redirect());
            exit();
         } else {
             $this->Flash->error(__('パスワードちゃいまっせ～'));
         }
     }
 }

 public function admin_logout() {
		$this->Cookie->delete('Auth.User');
		$this->redirect($this->Auth->logout());
		$this->autoRender = false;
 }

public function admin_add() {
    if ($this->request->is('post')) {
        $this->User->create();
        if ($this->User->save($this->request->data)) {
            $this->Flash->success(__('The user has been saved'));
            return $this->redirect(
              array('controller' => 'Dashboards', 'action' => 'admin_index')
            );
        }
        $this->Flash->error(
            __('The user could not be saved. Please, try again.')
        );
    }
} 
 
}
