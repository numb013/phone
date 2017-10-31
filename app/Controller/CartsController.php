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
App::uses('CakeEmail', 'Network/Email');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CartsController extends AppController {
/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */

    public $uses = array('Item', 'Image', 'Genre', 'ItemGenre', 'WriteDown');
    public $components = array('Search.Prg', 'Session', 'Master');
    public $presetVars = true;
    public $paginate = array();    
    
    
    public function index($para = null, $id = null) {
        $this->_getParameter();
        $this->set('title_for_layout', 'カート');
        if ($this->request->is('post')) {
            if (!empty($this->request->data['Item']['token'])) {
                if ($this->Session->read('token') != $this->request->data['Item']['token']) {
                    $this->Session->write('token', $this->request->data['Item']['token']);
                    if (!empty($this->Session->read('Item'))) {
                        $Item = $this->Session->read('Item');
                        $match_flag = 0;
                        foreach ($Item['id'] as $key => $value) {
                            if ($this->request->data['Item']['id'] == $value) {
                                $match_flag = 1;
                                $match_key = $key;
                            }
                        }
                        if ($match_flag == 0) {
                           $Item['id'][] = $this->request->data['Item']['id'];
                           $Item['count'][] = $this->request->data['Item']['count'];
                           $this->Session->write('Item.id', $Item['id']);
                           $this->Session->write('Item.count', $Item['count']);
                        } else {
                            $this->Session->write('Item.count.'.$match_key, $Item['count'][$match_key] + $this->request->data['Item']['count']);
                        }
                    } else {
                        $this->Session->write('Item.id.0', $this->request->data['Item']['id']);
                        $this->Session->write('Item.count.0', $this->request->data['Item']['count']);
                    }
                }
            }            
        } elseif ($para == 'delete') {
        $items = $this->Session->read('Item');
        if (!empty($items)) {
            foreach ($items['id'] as $key => $value) {
                if ($id == $value) {
                    unset($items['id'][$key]);
                    unset($items['count'][$key]);
                }
            }
            
        }
        if (!empty($items['id'])) {
            $items['id'] = array_merge($items['id']);
            $items['count'] = array_merge($items['count']);
            $this->Session->write('Item.id', $items['id']);
            $this->Session->write('Item.count', $items['count']);
        } else {
            $this->Session->delete('Item');
            $this->render('/carts/index');
        }
    } elseif ($para == 'form_menu') {
            $this->_getItem();
    } else {
        $this->Session->delete('Item');
        $this->render('/carts/index');
    }
    $this->_getItem();
 }

    /**
     * star method
     * お気に入りを追加/削除する
     *
     * @throws NotFoundException
     * @return void
     */
    public function buy() {

$total = $this->_getItem();
echo pr($total);
        if ($this->request->is('post')) {

        }
        exit();
    } 


    public function _getItem() {
        $items = $this->Session->read('Item');
        if (!empty($items)) {
            $datas = $this->Item->find('all',
                    array(
                'conditions' => array(
                    'Item.id' => $items['id'],
                    'delete_flag' => '0'
                     ),
                 )
             );
             foreach ($items['id'] as $key => $id) {
                 foreach ($datas as $num => $value) {
                     if ($id == $value['Item']['id']) {
                         $data[$key] = $value;
                     }
                 }
             }
             $datas = $data;
             $total['price'] = 0;
             $total['count'] = 0;
             foreach ($datas as $key => $value) {
                 $datas[$key]['Item']['count'] = $items['count'][$key];
                 $datas[$key]['Item']['total_price'] = $items['count'][$key] * $value['Item']['price'];
                 $total['price'] = $total['price'] + $datas[$key]['Item']['total_price'];
                 $total['count'] = $total['count'] + $datas[$key]['Item']['count'];
             }
              $this->set(compact("datas", "total"));
              return $total;
        }

    }

    /**
     * star method
     * お気に入りを追加/削除する
     *
     * @throws NotFoundException
     * @return void
     */
    public function buy_count() {
            if (!$this->request->is('ajax')) {
                    throw new NotFoundException('お探しのページは見つかりませんでした。');
            }
            $this->autoRender = false;
            $data = array();
            $data['id'] =  $this->request->data['Item']['id'];
            $data['count'] = $this->request->data['Item']['count'];
            $Item = $this->Session->read('Item');

            foreach ($Item['id'] as $key => $value) {
                if ($data['id'] == $value) {
                    $this->Session->write('Item.count.'.$key, $data['count']);
                }
            }
            $total = $this->_getItem();
            header('Content-type: application/json');//指定されたデータタイプに応じたヘッダーを出力する
            echo json_encode( $total );
    }       

    public function _getParameter() {
            $item_genres = $this->Master->getItemGenres();
            $genre = $this->Master->getGenre();
            $seasons = $this->Master->getSeason();
            $size = $this->Master->getSize();
            $discounts = $this->Master->getDiscount();
            $this->set(compact("item_genres", "genre", "seasons", "size", "discounts"));
            return;
    }    
    
    
}
