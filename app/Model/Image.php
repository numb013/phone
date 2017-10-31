<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

 App::uses('AppModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
 class Image extends AppModel {
   public $validate = array(
     'photo' => array(
       // ルール：uploadError => errorを検証 (2.2 以降)
       'upload-file' => array(
         'rule' => array('uploadError'),
         'allowEmpty' => true,
         'message' => array('Error uploading file')
       ),
       // ルール：extension => pathinfoを使用して拡張子を検証
       'extension' => array(
         'rule' => array('extension', array(
           'jpg', 'jpeg', 'png', 'gif')  // 拡張子を配列で定義
         ),
         'message' => array('file extension error')
       ),
       // ルール：mimeType =>
       // finfo_file(もしくは、mime_content_type)でファイルのmimeを検証 (2.2 以降)
       // 2.5 以降 - MIMEタイプを正規表現(文字列)で設定可能に
       'mimetype' => array(
         'rule' => array('mimeType', array(
           'image/jpeg', 'image/png', 'image/gif')  // MIMEタイプを配列で定義
         ),
         'message' => array('MIME type error')
       ),
       // ルール：fileSize => filesizeでファイルサイズを検証(2GBまで)  (2.3 以降)
       'size' => array(
         'maxFileSize' => array(
           'rule' => array('fileSize', '<=', '1MB'),  // 10M以下
           'message' => array('file size error')
         ),
       ),
     ),
   );
 }
