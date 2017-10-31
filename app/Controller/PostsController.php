<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class PostsController extends AppController {

  public function isAuthorized($user) {
      // 登録済ユーザーは投稿できる
      if ($this->action === 'add') {
          return true;
      }

      // 投稿のオーナーは編集や削除ができる
      if (in_array($this->action, array('edit', 'delete'))) {
          $postId = (int) $this->request->params['pass'][0];
          if ($this->Post->isOwnedBy($postId, $user['id'])) {
              return true;
          }
      }

      return parent::isAuthorized($user);
  }
  
  public function add() {
      if ($this->request->is('post')) {
          //Added this line
          $this->request->data['Post']['user_id'] = $this->Auth->user('id');
          if ($this->Post->save($this->request->data)) {
              $this->Flash->success(__('Your post has been saved.'));
              return $this->redirect(array('action' => 'index'));
          }
      }
  }



}
