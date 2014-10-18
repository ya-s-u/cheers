<?php
App::uses('AuthComponent', 'Controller/Component');

class Following extends AppModel {
	public $name = 'Following';

	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'to_id',
        ),
    );

	/**
	* from_idを指定して、友達のuser_idを取得
	*/
	public function getFriends($id) {
		$params = array(
			'conditions' => array(
				'Following.from_id' => $id,
			),
		);
		$Friends = $this->find('all',$params);

		return $Friends;
	}

	/**
	* 友達関係を保存
	*/
	public function saveFriend($from_id,$to_id) {
		$this->create();
		$this->data = array(
			'from_id' => $from_id,
			'to_id' => $to_id,
			'created' => date("Y-m-d G:i:s"),
		);
		if($this->save($this->data)) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	* from_idを指定して、to_idを取得
	*/
	public function getFromId($id) {
		$params = array(
			'conditions' => array(
				'Following.from_id' => $id,
			),
			'fields' => Array(
				'Following.to_id',
			),
		);
		$FriendsId = $this->find('all',$params);

		$dump = array();
		foreach($FriendsId as $friend) {
			array_push($dump,$friend['Following']['to_id']);
		}

		return $dump;
	}

	/**
	* to_idを指定して、from_idを取得
	*/
	public function getToId($id) {
		$params = array(
			'conditions' => array(
				'Following.to_id' => $id,
			),
			'fields' => Array(
				'Following.from_id',
			),
		);
		$FriendsId = $this->find('all',$params);

		$dump = array();
		foreach($FriendsId as $friend) {
			array_push($dump,$friend['Following']['from_id']);
		}

		return $dump;
	}

	/**
	* 退会
	*/
	public function deleteUser($id) {
		$conditions = array(
			'OR' => array(
				'from_id' => $id,
				'to_id' => $id,
			)
		);
		$this->deleteAll($conditions,false);
		
		return;
	}

}

?>
