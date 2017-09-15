<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * ユーザグループのモデルクラス
 *
 * @package     app.Model
 */
class Group extends AppModel {
    // ビヘイビアの指定、AROの場合typeは'requester'
	public $actsAs = array('Acl' => array('type' => 'requester'));

    /**
     * モデルsave時にarosテーブルにid設定
     */
    public function parentNode() {
        return null;
    }
    
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