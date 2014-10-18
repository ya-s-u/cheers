<?php

class UsersController extends AppController {
    public $name = 'Users';

    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * ダッシュボード
     */
    public function index() {
        $this->set('title_for_layout', 'ダッシュボード');

    }

    /**
     * ログアウト
     */
    public function logout() {
        $this->set('title_for_layout', 'ログアウト');

        $this->Auth->logout();
        $this->redirect('/');
    }

}