<?php
class Recipe extends AppModel {
	public $name = 'Recipe';

	public $validate = array(
	);
	
	/**
	* 記事投稿
	*/
	public function createRecipe($post_id, $i, $data) {
		$this->create();
		$this->data = array(
			'post_id' => $post_id,
			'order' => $i,
			'nanapi_article_id' => $data['recipe_id'],
			'title' => $data['title'],
			'description' => $data['description'],
			'thumb_img_url' => $data['image'],
		);
		return $this->save($this->data);
	}

}