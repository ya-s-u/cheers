<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $uses = array('User','Post','Recipe');
	public $layout = 'Common';
	public $helpers = array('Html','Form','Session');
	public $components = array(
		'Session',
		'Auth' => array(
	        'authenticate' => array(
	            'Form' => array(
	                'userModel' => 'User',
	                'passwordHasher' => array(
                        'className' => 'None'
                    ),
	                'fields' => array('username' => 'twitter_oauth_token' , 'password'=>'twitter_oauth_token_secret'),
	            ),
	        ),
	        'loginError' => 'パスワードもしくはログインIDをご確認下さい。',
	        'authError' => 'ご利用されるにはログインが必要です。',
	        'loginAction' => array('controller' => 'posts', 'action' => 'index'),
	        'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
	        'logoutRedirect' => array('controller' => 'posts', 'action' => 'index'),
	    ),
	);

	public function beforeFilter() {
		$auth_id = $this->Auth->user('id');
		if($auth_id) {
			$auth = $this->User->getUser($auth_id);
			$this->set('auth',$auth);
		}

	}
}
