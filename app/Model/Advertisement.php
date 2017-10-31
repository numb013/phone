<?php
App::uses('AppModel', 'Model');

class Advertisement extends AppModel {

  public $actsAs = array(
      'Search.Searchable'
  );

  public $hasMany = array(
      'Image' => array(
          'className' => 'Image',
          'conditions'=>array(
            'delete_flag'=>0,
            'partner_name'=> 'Advertisement',
              ),
          'order' => '',
          'foreignKey' => 'partner_id',
          'dependent' => '',
          'exclusive' => '',
          'finderQuery' => '',
          'limit' => '',
        ),
    );

//  public $validate = array(
//      'profession_name' => array(
//          'between' => array(
//              'allowEmpty' => true,
//              'rule' => array('between', 1, 50),
//              'message' => 'タイトルは50文字以内'
//          )
//      ),
//      '	job_content' => array(
//        'between' => array(
//            'rule' => array('between', 1, 1000),
//            'message' => '本文は1000文字以内'
//        )
//      ),
//      'job_step1' => array(
//        'between' => array(
//            'rule' => array('between', 1, 1000),
//            'message' => '本文は1000文字以内'
//        )
//      ),
//      'job_step2' => array(
//        'between' => array(
//            'rule' => array('between', 1, 1000),
//            'message' => '本文は1000文字以内'
//        )
//      ),
//      'job_step3' => array(
//        'between' => array(
//            'rule' => array('between', 1, 1000),
//            'message' => '本文は1000文字以内'
//        )
//      ),
//      'job_url' => array(
//        'between' => array(
//            'rule' => array('between', 1, 1000),
//            'message' => '本文は1000文字以内'
//        )
//      ),
//      'core_status' => array(
//        'between' => array(
//            'allowEmpty' => true,
//            'rule' => array('between', 1, 1000),
//            'message' => '本文は1000文字以内'
//        )
//      ),
//  );

}
