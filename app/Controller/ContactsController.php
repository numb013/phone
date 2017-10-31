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
class ContactsController extends AppController {
    public $uses = array('Contact', 'Blog', 'Image', 'Rss', 'Home');
    public $components = array('Search.Prg', 'Session', 'Master');
    /**   
     * Displays a view
     *
     * @return void
     * @throws NotFoundException When the view file could not be found
     *	or MissingViewException in debug mode.
     */
     public function index() {
        $this->set('title_for_layout', 'お問い合わせ');
        $this->_getParameter();
        if ($this->request->is('post')) {
            $this->Contact->set($this->request->data['Contact']);
            if (!$this->Contact->validates()) {
                $error = $this->Contact->validationErrors;
                $this->set('error', $error);
            } else {
                $this->render('/Contacts/confirm');
                return;
            }
        }
      }

        public function regist() {
            $this->layout = "default";
            $this->_getParameter();
            if ($this->request->is(array('post', 'put'))) {
                //戻るボタン
                if (isset($this->request->data['back'])) {
                            $this->render('/Contacts/index');
                } elseif (isset($this->request->data['regist'])) {
                    if ($this->sendContact($this->request->data['Contact'])) {
                        $this->render('contact_complete');
                    } else {
                    exit();
                        $this->render('confirm');
                    }
                }
            }
        }


        public function sendContact($content) {
            mb_language('japanese');
            mb_internal_encoding('utf-8');

            $honbun='';
              $honbun.=$content['company_name']."様\n\nこの度は弊社サイトよりお問い合わせいただき誠に有難う御座います。\n";
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

            if (mb_send_mail($content['mail_address'], $title, $honbun, $header)) {
               mb_language('japanese');
               mb_internal_encoding('utf-8');

               $title= 'お客様からお問い合わがありました。';
               $header = 'From:'.$content['mail_address'];
               $message = html_entity_decode($content['text'], ENT_QUOTES, 'UTF-8');
               mb_send_mail('oneblow0701@gmail.com' ,$title, $content['text'], $header);
               return true;
            } else {
               return false;
            }
        }

        public function _getParameter() {
                $prefectures = $this->Master->getPrefecture();
                $side_content = $this->Master->getSideContent();
                $side_under_content = $this->Master->getSideRss();
                shuffle($side_content);
                $this->set(compact("prefectures", "side_content", 'side_under_content'));
                return;
        }

}
