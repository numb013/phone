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
 class Shop extends AppModel {
   public $actsAs = array(
       'Search.Searchable'
   );

   public $hasMany = array(
       'Image' => array(
           'className' => 'Image',
           'conditions'=>array(
             'delete_flag'=>0,
             'partner_name'=> 'Shop',
               ),
           'order' => '',
           'foreignKey' => 'partner_id',
           'dependent' => '',
           'exclusive' => '',
           'finderQuery' => '',
           'limit' => '',
         ),
     );

     public $filterArgs = array(
       'profession_name' => array(
         'type' => 'like'
       ),
       'genre' => array(
         'type' => 'value'
       ),
       'core_status' => array(
         'type' => 'value'
       ),
       'check_sex' => array(
         'type' => 'query',
         'method' => 'CheckSex',
       ),
       'ItemGenre' => array(
         'type' => 'query',
         'method' => 'CheckPers',
       ),
       'genre' => array(
         'type' => 'query',
         'method' => 'Genre',
       ),
     );

     public function CheckSex($data = array()) {
   		$conditions = array();
   		// 案件カテゴリー
   		if (!empty($data['check_sex'])) {
   			$r = array();
   			foreach ($data['check_sex'] as $val) {
   				if (!empty($val)) {
   					$r[] = 'FIND_IN_SET(\'' . $val . '\', Profession.check_sex)';
   				}
   			}
   			$r[] = 'check_sex IS NULL ';
   			$conditions[]['OR'] = $r;
   		}
   		return $conditions;
   	}

     public function CheckPers($data = array()) {
   		$conditions = array();
   		// 案件カテゴリー
   		if (!empty($data['item_genre'])) {
   			$r = array();
   			foreach ($data['item_genre'] as $val) {
   				if (!empty($val)) {
   					$r[] = 'FIND_IN_SET(\'' . $val . '\', Profession.ItemGenre)';
   				}
   			}
   			$r[] = 'ItemGenre IS NULL ';
   			$conditions[]['OR'] = $r;
   		}
   		return $conditions;
   	}

     public function Genre($data = array()) {
   		$conditions = array();
   		// 案件カテゴリー
   		if (!empty($data['genre'])) {
   			$r = array();
   			foreach ($data['genre'] as $val) {
   				if (!empty($val)) {
   					$r[] = 'FIND_IN_SET(\'' . $val . '\', Profession.genre)';
   				}
   			}
   			$r[] = 'genre IS NULL ';
   			$conditions[]['OR'] = $r;
   		}
   		return $conditions;
   	}


}
