<?php

class WantsController extends AppController {
    public $name = 'Wants';
    
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /* トップページ */
    public function add() {
		$this->Want->set($this->request->query);
		$this->Want->validates();
		$this->Want->create();
		$this->Want->data = array(
			'user_id' => $this->request->query['user_id'],
			'shop_id' => $this->request->query['shop_id'],
			'name' => $this->request->query['name'],
			'url' => $this->request->query['url'],
			'created' => date("Y-m-d G:i:s"),
		);

		if($this->Want->save($this->Want->data)) {
			return 1;
		} else {
			return 0;
		}
    }

}