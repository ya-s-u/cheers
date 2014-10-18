<?php

class UsersController extends AppController {
    public $name = 'Users';
    
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /* トップページ */
    public function index() {
        $this->set('title_for_layout', 'ダッシュボード');
        $auth_id = $this->Auth->user('twitter_screen_name');
		
		if($auth_id) {
			$auth = $this->User->getUser($auth_id);
			$this->set('auth',$auth);
		}
		
        if(isset($auth)) {
	        $params = array(
				'conditions' => array(
					'Want.user_id' => $auth['User']['user_id'],
				),
			);
			$List = $this->Want->find('all',$params);
			$this->set('List',$List);
		}

    }
    
    /* ログアウト */
    public function logout() {
        $this->set('title_for_layout', 'ログアウト');

        $this->Auth->logout();
        $this->redirect('/');
    }

}