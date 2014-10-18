<?php
App::uses('AbstractPasswordHasher', 'Controller/Component/Auth');

class NonePasswordHasher extends AbstractPasswordHasher {

    protected $_config = array('hashType' => null);
    public function hash($password) {
        return $password;
    }
    public function check($password, $hashedPassword) {
        return $hashedPassword === $password;
    }
}