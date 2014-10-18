<?php

class UsersController extends AppController {
    public $name = 'Users';
    public $components = array(
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
        parent::beforeFilter();
        
        $this->Auth->allow('login');
		$this->Auth->allow('fb_login');
		$this->Auth->allow('signup');
		$this->Auth->allow('fb_signup');
        
		$auth_id = $this->Auth->user('id');
		if($auth_id) {
			$auth = $this->User->getUser($auth_id);
			$this->set('auth',$auth);
		}
		
		App::import('Vendor', 'facebook/src/facebook');
        $this->facebook = new Facebook( array(
	        'appId' => '782740005121656',
	        'secret' => '98039e33232084062ad5d62fbefde9d5',
	        'cookie' => true,
	        'locale' => 'ja_JP'
        ));
    }

    /* トップページ */
    public function index() {
        $this->set('title_for_layout', 'ダッシュボード');
    }
    
    /* FB登録 */
    public function signup() {
        $this->set('title_for_layout', '新規登録');
        
		$fb = $this->facebook->getUser();
        if(empty($fb)){
       	    $login_url = $this->facebook->getLoginUrl(array('scope' => 'email'));
        	$this->redirect($login_url);
        	
			$me = $this->facebook->api('/me');
			$this->set('f1',$me['name']);
        }
        
		$me = $this->facebook->api('/me',
	    	array(
	    		'locale' => 'ja_JP',
	    	)
	    );
		$this->set('me',$me);
		
		$this->User->set($Data);
		$this->User->validates();
		$this->User->create();
		$this->data = array(
			'facebook_user_id' => $me['id'],
			'facebook_user_name' => $me['name'],
			'facebook_user_mail' => $me['email'],
			'created' => date("Y-m-d G:i:s"),
			'modified' => date('Y-m-d H:i:s'),
		);
		$this->User->save($this->data);
		
		$this->redirect($this->referer());
    }

    /* ログアウト */
    public function logout() {
        $this->set('title_for_layout', 'ログアウト');

        $this->Auth->logout();
        $this->redirect('/');
    }

}