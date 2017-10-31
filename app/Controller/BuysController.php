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
class BuysController extends AppController {
/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */

    public $uses = array('Item', 'Image', 'Genre', 'ItemGenre', 'User', 'Cart', 'Buy');
    public $components = array('Search.Prg', 'Session', 'Master');
    public $presetVars = true;
    public $paginate = array();

    /**
     * star method
     * お気に入りを追加/削除する
     *
     * @throws NotFoundException
     * @return void
     */
    public function menber_buy() {
        $items = $this->Session->read('Item');
        $this->_getParameter();
    } 

    public function no_menber_buy() {
        $items = $this->Session->read('Item');
        $this->_getParameter();
        echo pr($items);
        if ($this->request->is('post')) {

        }
    } 

    

    public function buy_confirm() {

        if ($this->request->is('post')) {
            if (isset($this->request->data['back'])) {
                $this->_getParameter();
                return $this->redirect(
                  array('controller' => 'carts', 'action' => 'index/form_menu')
                );
             } elseif (isset($this->request->data['confirm'])) {

                $this->_getItem();
                
                $select = $this->request->data;
                if ($select['Buys']['shipoption'] == 1) {
                    $select['Buys']['shipoption_date'] = $select['Buys']['month'].$select['Buys']['date'];
                }
                $this->set(compact("select"));
            }
        }
    }

    public function no_member_buy_confirm() {
        if ($this->request->is('post')) {
            if (isset($this->request->data['back'])) {
                $this->_getParameter();
                return $this->redirect(
                  array('controller' => 'carts', 'action' => 'index/form_menu')
                );
            } elseif (isset($this->request->data['confirm'])) {

                $this->_getItem();
                
                $data['User'] = $this->request->data['User'];
                $select['Buys'] = $this->request->data['Buys'];
                if ($select['Buys']['shipoption'] == 1) {
                    $select['Buys']['shipoption_date'] = $select['Buys']['month'].$select['Buys']['date'];
                }
                $this->set(compact("data", "select"));
            }
        }
    }


    public function buy_complete() {

        if ($this->request->is('post')) {
            if (isset($this->request->data['back'])) {
                if (!empty($this->Auth->user())) {
                    return $this->redirect(
                      array('controller' => 'buys', 'action' => 'menber_buy')
                    );
                } else {
                    return $this->redirect(
                      array('controller' => 'buys', 'action' => 'no_menber_buy')
                    );
                }
            } elseif (isset($this->request->data['regist'])) {
                $total = $this->_getItem();
                $items = $this->Session->read('Item');
                $data = $this->request->data;
                if (!empty($member)) {
                    $data['Buys']['user_id'] = $this->Auth->user('id');
                } else {
                    $data['Buys']['user_id'] = '99999';
                }
                $data['Buys']['buy_item_ids'] = implode(",", $items['id']);
                $data['Buys']['buy_item_counts'] = implode(",", $items['count']);
                $data['Buys']['price'] = $total['price'];
                $data['Buys']['count'] = $total['count'];
                if($data['Buys']['shipoption'] == 0) {
                    $data['Buys']['shipoption_date'] = date("Y-m-d H:i:s", strtotime("+3 day"));
                }

                $this->Buy->set($data);
                // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
                if ($this->Buy->validates()) {
                    $this->Buy->save($data['Buys']);
                    
                    //$this->_send_complete($items, $total);
                    
                    $this->Session->delete('Item');
                    return $this->redirect(
                      array('controller' => 'buys', 'action' => 'buy_complete')
                    );
                } else {
                    exit();
                  $this->set('data',$data);
                  $this->render('/users/user_edit');
                }
            }
        }
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

 public function _send_complete($Item, $total) {

       mb_language('japanese');
       mb_internal_encoding('utf-8');

      $honbun='';
    	$honbun.=$this->Auth->user('full_name')."様\n\nこの度は弊社サイトよりお問い合わせいただき誠に有難う御座います。\n";
    	$honbun.="担当者より折り返しご連絡させていただきますので 今しばらくお待ちくださいませ。\n";
    	$honbun.="その他ご不明な点、ご相談等ございましたら お気軽にお問い合わせください。\n";
    	$honbun.="また、当サイトと関連していない問い合わせについては \n";
    	$honbun.="ご対応致しかねますので予めご了承のほどお願い申し上げます\n";
    	$honbun.="\n";

    	$honbun.="□□□□□□□□□□□□□□□□□\n";
    	$honbun.="\n";
    	$honbun.="『FUD-24』簡単で当たる！職業診断係";
    	$honbun.="\n";
    	$honbun.="メール oneblow0701@gmail.com\n";
    	$honbun.="\n";
    	$honbun.="□□□□□□□□□□□□□□□□□\n";


    	$title= 'お問い合わせありがとうございました。';
    	$header = 'From:FUD-24 簡単で当たる！職業診断';
      $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
      $header = mb_encode_mimeheader($header);

   if (mb_send_mail($this->Auth->user('mail_address'), $title, $honbun, $header)) {
       mb_language('japanese');
       mb_internal_encoding('utf-8');

       $title= 'お客様からお問い合わがありました。';
       $header = 'From:'.$this->Auth->user('mail_address');

      $honbun='';
    	$honbun.=$this->Auth->user('full_name')."様\n\nこの度は弊社サイトよりお問い合わせいただき誠に有難う御座います。\n";
    	$honbun.="担当者より折り返しご連絡させていただきますので 今しばらくお待ちくださいませ。\n";
    	$honbun.="その他ご不明な点、ご相談等ございましたら お気軽にお問い合わせください。\n";
    	$honbun.="また、当サイトと関連していない問い合わせについては \n";
    	$honbun.="ご対応致しかねますので予めご了承のほどお願い申し上げます\n";
    	$honbun.="\n";

    	$honbun.="□□□□□□□□□□□□□□□□□\n";
    	$honbun.="\n";
    	$honbun.="『FUD-24』簡単で当たる！職業診断係";
    	$honbun.="\n";
    	$honbun.="メール oneblow0701@gmail.com\n";
    	$honbun.="\n";
    	$honbun.="□□□□□□□□□□□□□□□□□\n";

       $message = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
       mb_send_mail('oneblow0701@gmail.com' ,$title, $honbun, $header);
       return true;
   } else {
       return false;
   }
 }
    
    public function _getParameter() {
            $prefectures = $this->Master->getPrefecture();
            $this->set(compact("prefectures"));
            return;
    }
 
 
}
