<?php
class Contact extends AppModel {
    public $useTable = false;
    public $_schema = array(
        'name' => array('type' => 'string', 'length' => 255),
        'email' => array('type' => 'string', 'length' => 255),
        'subject' => array('type' => 'string', 'length' => 255),
        'body' => array('type' => 'text'),
    );

    public $validate = array(
        'company_name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => '未入力です。',
                'required' => true,
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => '255文字以内で入力してくだい。',
                'required' => true,
            ),
        ),
        'contact_name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => '未入力です。',
                'required' => true,
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => '255文字以内で入力してくだい。',
                'required' => true,
            ),
        ),
        'phone_number' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => '未入力です。',
                'required' => true,
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 15),
                'message' => '正式な電話番号で入力してください',
                'required' => true,
            ),
        ),
        'prefecture' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => '選択してください。',
                'required' => true,
            ),
        ),
        'mail_address' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => '未入力です。',
                'required' => true,
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'メールアドレス以外が入力されています。',
                'required' => true,
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => '255文字以内で入力してくだい。',
                'required' => true,
            ),
        ),
    );
}
