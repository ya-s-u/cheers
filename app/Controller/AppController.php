<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $uses = array('User');
	public $layout = 'Common';
	public $helpers = array('Html','Form','Session');
	public $components = array(
		'Session',
	);

	public function beforeFilter() {
	}
}
