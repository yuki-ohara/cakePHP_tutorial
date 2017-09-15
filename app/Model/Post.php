<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * 記事のモデルクラス
 *
 * @package     app.Model
 */
class Post extends AppModel {
    // アソシエーション
    public $belongsTo = array(
        'user' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
        )
    );

    /**
     * 入力値のバリデーション設定
     */
	public $validate = array(
        'title' => array(
            'rule' => 'notBlank',
            'message' => 'A title is required'
        ),
        'body' => array(
            'rule' => 'notBlank',
            'message' => 'A body is required'
        )
    );
}
?>