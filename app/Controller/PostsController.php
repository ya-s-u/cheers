<?php

class PostsController extends AppController {
    public $name = 'Posts';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index','view'));
    }

    /**
     * 新着記事一覧
     */
    public function index() {
        $this->set('title_for_layout', '新着記事一覧');
		
		$RandomPosts = $this->Post->getRandomPosts();
        $this->set('RandomPosts', $RandomPosts);
		
		$NewPosts = $this->Post->getAllPosts();
        $this->set('NewPosts', $NewPosts);
        
		$PopularPosts = $this->Post->getPopularPosts();
        $this->set('PopularPosts', $PopularPosts);
        
		$Users = $this->User->getAllUser();
		$this->set('Users',$Users);
    }

	/**
     * 記事ビュー
     */
    public function view($id) {
		$post = $this->Post->getPost($id);
        $this->set('post', $post);
        
        $this->set('title_for_layout', $post['Post']['title']);
        
		$PopularPosts = $this->Post->getPopularPosts();
        $this->set('PopularPosts', $PopularPosts);
        
        $this->Post->incrementPv($id);
        
		$Users = $this->User->getAllUser();
		$this->set('Users',$Users);
    }

    /**
     * 記事投稿
     */
    public function create() {
        $this->set('title_for_layout', '新規投稿');
        
        if ($this->request->isPost()) {
        
        	//記事情報をdbに保存
        	$this->Post->createPost($this->Auth->user('id'), $this->request->data['Post']);
        	
        	//記事ID取得
        	$post_id = (int) $this->Post->getLastInsertID();

	        //レシピデータを取得しdbに保存
			for ($i=0; $i<10; $i++) {
	        	$recipe_id = $this->request->data['Post']['recipe'.$i];
	        	
	        	//レシピ数10未満だったら終了
	        	if(!$recipe_id) break;
	        
	        	//nanapiAPIにアクセス
	        	$data = file_get_contents('http://api.nanapi.jp/v1/recipeLookupDetails/?recipe_id='.$recipe_id.'&key=4cb94f0895324&format=json');
				$data = json_decode($data, true);
				
				//post_linkに保存
				$this->Recipe->createRecipe($post_id, $i, $data['response']['recipe']);
				
				//サムネイルに使う画像だったらpostに保存
				if($recipe_id == $this->request->data['Post']['thumb']) {
					$this->Post->updateThumb($post_id, $data['response']['recipe']['image']);
				}
	        }
			
			//リダイレクト
			$this->redirect('/');
		}
    }

}