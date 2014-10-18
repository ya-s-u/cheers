<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
	public $name = 'User';
	public $primaryKey = 'user_id';

	public $validate = array(

	);

	/**
	* アクセストークンを取得
	*/
	public function checkTwitterUserId($twitter_user_id) {
		$params = array(
			'conditions' => array(
				'User.twitter_user_id' => $twitter_user_id,
			),
		);
		$User = $this->find('first',$params);

		if($User) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	* ユーザー情報を取得
	*/
	public function getUser($screen_name) {
		$params = array(
			'conditions' => array(
				'User.twitter_screen_name' => $screen_name,
			),
		);
		$user = $this->find('first',$params);

		return $user;
	}
	
	/**
	* 全てのユーザー情報を取得
	*/
	public function getAllUser($id) {
		$params = array(
			'conditions' => array(
				'NOT' => array(
					'User.user_id' => $id,
				)
			),
			'order' => 'User.modified desc'
		);
		$user = $this->find('all',$params);

		return $user;
	}

	/**
	* 新規ユーザー登録
	*/
	public function newUser($Data) {
		$this->set($Data);
		$this->validates();
		$this->create();
		$this->data = array(
			'twitter_user_id' => $Data['user_id'],
			'twitter_screen_name' => $Data['screen_name'],
			'twitter_oauth_token' => $Data['oauth_token'],
			'twitter_oauth_token_secret' => $Data['oauth_token_secret'],
			'created' => date("Y-m-d G:i:s"),
			'modified' => date('Y-m-d H:i:s'),
		);

		if($this->save($this->data)) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	* アクセストークンを取得
	*/
	public function getAccessToken($id) {
		$params = array(
			'conditions' => array(
				'User.user_id' => $id,
			),
			'fields' => Array(
				'User.twitter_oauth_token',
				'User.twitter_oauth_token_secret',
			),
		);
		$Data = $this->find('first',$params);
		$access_token = $Data['User'];

		return $access_token;
	}

	/**
	* ユーザー名、使用言語、プロフィール画像URLを更新
	*/
	public function updateProfile($id,$Data) {
		$this->updateAll(
			array(
				'User.twitter_username' => "'".$Data['name']."'",
				'User.twitter_image_url' => "'".$Data['profile_image_url_https']."'",
			),
			array(
				'User.user_id' => $id,
			)
		);

		return;
	}

	/**
	* twitter_user_idで指定したユーザーのuser_idを取得
	*/
	public function getFriendsId($id_arr) {
		$params = array(
			'conditions' => array(
				'User.twitter_user_id' => $id_arr,
			),
			'fields' => Array(
				'User.user_id',
			),
		);
		$Friends = $this->find('all',$params);

		$dump = array();
		foreach($Friends as $friend) {
			array_push($dump,$friend['User']['user_id']);
		}

		return $dump;
	}
	
	/**
	* 退会
	*/
	public function deleteUser($id) {
		if($this->delete($id)) return;
	}

}
?>
