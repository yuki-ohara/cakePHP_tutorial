<?php
App::uses('AppController', 'Controller');

/**
 * ユーザグループのコントローラークラス
 *
 * @package     app.Controller
 */
class GroupsController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
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
     * ユーザグループ一覧表示
     */
    public function index() {
        $this->Group->recursive = 0;
        $this->set('groups', $this->paginate());
    }

    /**
     * ユーザグループのView表示
     */
    public function view($id = null) {
        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        $this->set('group', $this->Group->findById($id));
    }

    /**
     * ユーザグループの追加処理
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Flash->success(__('The group has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The group could not be saved. Please, try again.')
            );
        }
    }

    /**
     * ユーザグループの編集処理
     */
    public function edit($id = null) {
        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Group>save($this->request->data)) {
                $this->Flash->success(__('The group has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The group could not be saved. Please, try again.')
            );
        }
    }

    /**
     * ユーザグループの削除処理
     */
    public function delete($id = null) {

        $this->request->allowMethod('post');

        $this->Group->id = $id; // 先にmodelにidを渡しそこからexistsで判定？
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        if ($this->Group->delete()) {
            $this->Flash->success(__('Group deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Group was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}
?>