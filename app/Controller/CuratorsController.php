<?php
class CuratorsController extends AppController {
	public $name = 'Curators';

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index'));
	}

	/**
	* キュレーター一覧
	*/
	public function index() {
		$this->set('title_for_layout','キュレーター一覧');

		$Users = $this->User->getAllUser();
		$this->set('Users',$Users);
	}
	 
}