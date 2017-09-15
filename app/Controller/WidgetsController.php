<?php
App::uses('AppController', 'Controller');

/**
 * Widgetのコントローラークラス
 *
 * @package     app.Controller
 */
class WidgetsController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');

    /**
     * 他Actionが実行される前に処理される
     *
     * AppControllerのbeforeFilterメソッド実行
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }

    /**
     * 一覧表示
     */
    public function index() {
        $this->Widget->recursive = 0;
        $this->set('widgets', $this->paginate());
    }

    /**
     * View表示
     */
    public function view($id = null) {
        $this->Widget->id = $id;
        if (!$this->Widget->exists()) {
            throw new NotFoundException(__('Invalid widget'));
        }
        $this->set('widget', $this->Widget->findById($id));
    }

    /**
     * 追加処理
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Widget->create();
            if ($this->Widget->save($this->request->data)) {
                $this->Flash->success(__('The Widget has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The Widget could not be saved. Please, try again.')
            );
        }
    }

    /**
     * 編集処理
     */
    public function edit($id = null) {
        $this->Widget->id = $id;
        if (!$this->Widget->exists()) {
            throw new NotFoundException(__('Invalid widget'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Widget->save($this->request->data)) {
                $this->Flash->success(__('The Widget has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The Widget could not be saved. Please, try again.')
            );
        }
    }

    /**
     * 削除処理
     */
    public function delete($id = null) {

        $this->request->allowMethod('post');

        $this->Widget->id = $id; // 先にmodelにidを渡しそこからexistsで判定？
        if (!$this->Widget->exists()) {
            throw new NotFoundException(__('Invalid widget'));
        }
        if ($this->Widget->delete()) {
            $this->Flash->success(__('Widget deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Widget was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}
?>