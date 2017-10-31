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
class PagesController extends AppController {
	public $uses = array('Home', 'Blog', 'Rss');
        public $components = array('Search.Prg', 'Session', 'Master');
/**
 * This controller does not use a model
 *
 * @var array
 */

	public function beforeFilter() {
		$this->set('title_for_layout', '簡単で当たる！職業診断 -コアでマイナーで珍しい職業-');
	 parent::beforeFilter();
	 $this->Auth->allow('add', 'index', 'home', 'search', 'check_box', 'display');
	}

	/**
	 * Displays a view
	 *
	 * @return void
	 * @throws NotFoundException When the view file could not be found
	 *	or MissingViewException in debug mode.
	 */
		public function display() {
			$this->set('title_for_layout', '簡単で当たる！職業診断 -コアでマイナーで珍しい職業-');
			$this->layout = "default";
                        $status = array(
                        'conditions' =>
                          array(
                            'Home.delete_flag' => 0
                          )
                        );
                        // 以下がデータベース関係
                        $datas = $this->Home->find('first', $status);
                        $this->_getParameter();
                        $this->set('data',$datas);
                        $this->render('home');
		}
/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function admin_display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

        public function _getParameter() {
                $prefectures = $this->Master->getPrefecture();
                $side_content = $this->Master->getSideContent();
                $side_under_content = $this->Master->getSideRss();
                shuffle($side_content);
                $this->set(compact("prefectures", "side_content", 'side_under_content'));
        }

    }
