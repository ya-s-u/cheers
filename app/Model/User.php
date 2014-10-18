<?php
class User extends AppModel {
	public $name = 'User';

	public $validate = array(
	);
	
	/**
	* 登録済みが判定
	*/
	public function getUserByTwitterId($twitter_user_id) {
		$params = array(
            'conditions' => array(
                'User.twitter_user_id' => $twitter_user_id,
            ),
        );
        return $this->find('first', $params);
	}
	
	/**
	* 新規ユーザー登録
	*/
	public function createUser($Data) {
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
		return $this->save($this->data);
	}
	
	/**
	* アクセストークンを取得
	*/
	public function getAccessToken($id) {
		$params = array(
			'conditions' => array(
				'User.id' => $id,
			),
			'fields' => Array(
				'User.twitter_oauth_token',
				'User.twitter_oauth_token_secret',
			),
		);
		$Data = $this->find('first', $params);
		$access_token = $Data['User'];

		return $access_token;
	}
	
	/**
	* ユーザー名、使用言語、プロフィール画像URLを更新
	*/
	public function updateProfile($id, $Data) {
		$this->updateAll(
			array(
				'User.twitter_user_name' => "'".$Data['name']."'",
				'User.twitter_description' => "'".$Data['description']."'",
				'User.twitter_profile_img_url' => "'".$Data['profile_image_url_https']."'",
			),
			array(
				'User.id' => $id,
			)
		);
		return;
	}
	
	/**
	* ユーザー情報を取得
	*/
	public function getUser($id) {
		$params = array(
			'conditions' => array(
				'User.id' => $id,
			),
		);
		return $this->find('first', $params);
	}
	
	/**
	* ユーザー一覧を取得
	*/
	public function getAllUser() {
		$params = array(
			'order' => 'User.created desc',
		);
		return $this->find('all', $params);
	}

}