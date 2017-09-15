<?php

App::uses('AppModel', 'Model');

class Widget extends AppModel {

    /**
     * 入力値のバリデーション設定
     */
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A name is required'
            )
        )
    );
}
?>