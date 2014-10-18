<?php 
/*http://dev.kickoff-nagoya.com/circle/app/Console/Command/UpdateShell.php

/usr/bin/php5.3 /home/tabinote/kickoff-nagoya.com/public_html/dev.kickoff-nagoya.com/circle/app/Console/Command/UpdateShell.php Update fb_update -app /home/tabinote/kickoff-nagoya.com/public_html/dev.kickoff-nagoya.com/circle/app

/usr/bin/php5.3 /home/tabinote/kickoff-nagoya.com/public_html/dev.kickoff-nagoya.com/circle/app/Console/cake.php Update fb_update -app /home/tabinote/kickoff-nagoya.com/public_html/dev.kickoff-nagoya.com/circle/app
*/
class UpdateShell extends AppShell {
    public $uses = array( 'User','Following','Want' );

    function fb_update() {
    	$params = array(
			'order' => array('shop_id' => 'asc'),
		);
		$Want = $this->Want->find('all',$params);
		
		$max = count($Want);
		for($i=0; $i<$max-1; $i++) {
			if($Want[$i]['Want']['shop_id'] == $Want[$i+1]['Want']['shop_id']) {
				$p1 = $Want[$i]['Want']['user_id'];
				$p2 = $Want[$i+1]['Want']['user_id'];
				
				$params = array(
					'conditions' => array(
						'Following.from_id' => $p1,
						'Following.to_id' => $p2,
					),
				);
				$follow1 = $this->Following->find('first',$params);
				
				$params = array(
					'conditions' => array(
						'Following.from_id' => $p2,
						'Following.to_id' => $p1,
					),
				);
				$follow2 = $this->Following->find('first',$params);
				
				if($follow1 || $follow2) {
					//メール
					
					$conditions = array(
						'AND' => array(
							'Want.user_id' => $Want[$i]['Want']['user_id'],
							'Want.shop_id' => $Want[$i]['Want']['shop_id'],
						)
					);
					$this->Want->deleteAll($conditions,false);
					
					$conditions = array(
						'AND' => array(
							'Want.user_id' => $Want[$i+1]['Want']['user_id'],
							'Want.shop_id' => $Want[$i+1]['Want']['shop_id'],
						)
					);
					$this->Want->deleteAll($conditions,false);
					
					$i++;
				}
			}
		}
    
    }

}