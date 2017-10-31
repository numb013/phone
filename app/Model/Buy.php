<?php
class Buy extends AppModel {

     public $validate = array(
         'user_id' => array(
             'required' => array(
                 'rule' => 'notBlank',
                 'message' => 'A username is required'
             )
         ),
     );
}
