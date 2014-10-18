<?php
class Post extends AppModel {
	public $name = 'Post';
	public $recursive = -1;

	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
        ),
    );
    
    public $hasMany = array(
        'Recipe' => array(
            'className' => 'Recipe',
            'foreignKey' => 'post_id',
        ),
    );

	public $validate = array(
	);
	
	/**
	* ランダム取得(3つ)
	*/
	public function getRandomPosts() {
		$params = array(
			'order' => 'rand()',
			'limit' => 3,
			'recursive' => 1,
		);
		return $this->find('all', $params);
	}
	
	/**
	* 新着順取得
	*/
	public function getAllPosts() {
		$params = array(
			'order' => 'Post.id desc',
			'limit' => 20,
			'recursive' => 1,
		);
		return $this->find('all', $params);
	}
	
	/**
	* 指定記事取得
	*/
	public function getPost($id) {
		$params = array(
			'conditions' => array(
				'Post.id' => $id,
			),
			'recursive' => 1,
		);
		return $this->find('first', $params);
	}
	
	/**
	* ランキング取得(5つ)
	*/
	public function getPopularPosts() {
		$params = array(
			'order' => 'Post.pv_count desc',
			'limit' => 5,
			'recursive' => -1,
		);
		return $this->find('all', $params);
	}
	
	/**
	* 記事投稿
	*/
	public function createPost($id, $request) {
		$this->create();
		$this->data = array(
			'user_id' => $id,
			'title' => $request['title'],
			'comment' => $request['comment'],
			'created' => date("Y-m-d G:i:s"),
		);
		return $this->save($this->data);
	}
	
	/**
	* サムネイル画像更新
	*/
	public function updateThumb($id, $img_url) {
		$this->updateAll(
			array(
				'Post.thumb_img_url' => "'".$img_url."'",
			),
			array(
				'Post.id' => $id,
			)
		);
		return;
	}
	
	/**
	* PVカウントインクリメント
	*/
	public function incrementPv($id) {
		$this->id = $id;
		$increment = array(  
    		'Post' => array(  
        		'id' => $id,  
        		'pv_count' => $this->field('pv_count') + 1,  
        	) 
		);
		return $this->save($increment, false, array('pv_count'));
	}

}