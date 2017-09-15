<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * ユーザのモデルクラス
 *
 * @package     app.Model
 */
class User extends AppModel {
    // アソシエーション
    public $belongsTo = array('Group');

    // ビヘイビアの指定、AROの場合typeは'requester'
    public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

    /**
     * モデルsave時にarosテーブルにid設定
     */
    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }

    /**
     * グループごとのみのパーミッションに単純化
     */
    public function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }

    /**
     * 入力値のバリデーション設定
     */
	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required'
            )
        ),
        'group_id' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A group_id is required'
            )
        ),
    );

    /**
     * save()の前に行う処理
     */
    public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password(
          $this->data['User']['spassword']
        );
        return true;
    }

}
?>