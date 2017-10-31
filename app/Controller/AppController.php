<?php
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
 // app/Controller/UsersController.php
 App::uses('AppController', 'Controller');

 class AppController extends Controller {
     public function beforeFilter() {
      parent::beforeFilter();
      $this->Auth->allow('add', 'index', 'home', 'search', 'check_box', 'search_more', 'detail', 'know_count', 'content', 'search_ajax', 'write_post', 'regist');
      $url = $_SERVER["REQUEST_URI"];
      if(strpos($url,'admin') !== false) {
        $this->theme = 'admin';
      }
     }

     public function index() {
         $this->User = new stdClass;
         $this->User->recursive = 0;
         $this->set('users', $this->paginate());
     }

     public function view($id = null) {
         $this->User->id = $id;
         if (!$this->User->exists()) {
             throw new NotFoundException(__('Invalid user'));
         }
         $this->set('user', $this->User->findById($id));
     }

     public function add() {
         if ($this->request->is('post')) {
             $this->User->create();
             if ($this->User->save($this->request->data)) {
                 $this->Flash->success(__('The user has been saved'));
                 return $this->redirect(array('action' => 'index'));
             }
             $this->Flash->error(
                 __('The user could not be saved. Please, try again.')
             );
         }
     }

     public function edit($id = null) {
         $this->User->id = $id;
         if (!$this->User->exists()) {
             throw new NotFoundException(__('Invalid user'));
         }
         if ($this->request->is('post') || $this->request->is('put')) {
             if ($this->User->save($this->request->data)) {
                 $this->Flash->success(__('The user has been saved'));
                 return $this->redirect(array('action' => 'index'));
             }
             $this->Flash->error(
                 __('The user could not be saved. Please, try again.')
             );
         } else {
             $this->request->data = $this->User->findById($id);
             unset($this->request->data['User']['password']);
         }
     }

     public function delete($id = null) {
         // Prior to 2.5 use
         // $this->request->onlyAllow('post');

         $this->request->allowMethod('post');

         $this->User->id = $id;
         if (!$this->User->exists()) {
             throw new NotFoundException(__('Invalid user'));
         }
         if ($this->User->delete()) {
             $this->Flash->success(__('User deleted'));
             return $this->redirect(array('action' => 'index'));
         }
         $this->Flash->error(__('User was not deleted'));
         return $this->redirect(array('action' => 'index'));
     }

     public $components = array(
         'Flash',
         'Auth' => array(
             'loginRedirect' => array('controller' => 'Dashboards', 'action' => 'admin_index'),
             'logoutRedirect' => array(
                 'controller' => 'Dashboards',
                 'action' => 'admin_index'
             ),
             'authenticate' => array(
                 'Form' => array(
                     'passwordHasher' => 'Blowfish'
                 )
             ),
             'authorize' => array('Controller') // この行を追加しました
         )
     );

     public function isAuthorized($user) {
         // Admin can access every action
         if (isset($user['role']) && $user['role'] === 'admin') {
             return true;
         }

         // デフォルトは拒否
         return false;
     }

 }
