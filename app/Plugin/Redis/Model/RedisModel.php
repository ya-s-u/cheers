<?php
App::uses('Model', 'Model');

class RedisModel extends Model {
  public $useTable = false;
  public $useDbConfig = 'redis';

  public function set($one, $two = null) {
    return $this->getDataSource()->query('set', func_get_args(), $this);
  }
  public function delete($id = null, $cascade = true) {
    return $this->getDataSource()->query('delete', func_get_args(), $this);
  }
}
