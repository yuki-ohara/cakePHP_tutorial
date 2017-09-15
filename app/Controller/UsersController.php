<?php
App::uses('AppController', 'Controller');

/**
 * ユーザのコントローラークラス
 *
 * @package     app.Controller
 */
class UsersController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Flash');

    /**
     * 他Actionが実行される前に処理される
     *
     * AppControllerのbeforeFilterメソッド実行
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    /**
     * ログイン処理
     */
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Your username or password was incorrect.'));
        }
    }

    /**
     * ログアウト処理
     */
    public function logout() {
        $this->Session->setFlash('Good-Bye');
        $this->redirect($this->Auth->logout());
    }

    /**
     * ユーザ一覧表示
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    /**
     * ユーザのView表示
     */
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    /**
     * ユーザの追加処理
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    /**
     * ユーザの編集処理
     */
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else { // これは何をやってるのか
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    /**
     * ユーザの削除処理
     */
    public function delete($id = null) {

        $this->request->allowMethod('post');

        $this->User->id = $id; // 先にmodelにidを渡しそこからexistsで判定？
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
        $this->Acl->Aco->create(array('parent_id' => null, 'alias' => 'controllers/users/delete'));
        $this->Acl->Aco->save();
    }

}
?>