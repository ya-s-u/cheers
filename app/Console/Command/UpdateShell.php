<?php 
/*
/usr/bin/php5.3 /home/tabinote/cheers.trial.jp/public_html/cheers/app/Console/cake.php Update fb_update -app /home/tabinote/cheers.trial.jp/public_html/cheers/app
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
				
					$params = array(
						'conditions' => array(
							'User.user_id' => $p1,
						),
					);
					$u1 = $this->User->find('first',$params);
					
					$params = array(
						'conditions' => array(
							'User.user_id' => $p2,
						),
					);
					$u2 = $this->User->find('first',$params);
					
					$a1 = $u1['User']['twitter_screen_name'];
					$a2 = $u2['User']['twitter_screen_name'];
					
					$p = $Want[$i]['Want']['name'];
					$u = $Want[$i]['Want']['url'];
				
				
				
					//つぶやく文字列を決定
			        $tubuyaki = '@'.$a1.'さんと@'.$a2.'さんで'.$p.'に行ってみてはいかがですか！ '.$u;
			        
			        
			        
			        //Twitterizerライブラリを取り込む
					require_once("../Vendor/twitteroauth/twitteroauth.php");
					require_once("../Vendor/twitteroauth/OAuth.php");
			        //https://dev.twitter.com/appsで発行したtokenを設定して下さい。
			        $consumer_key       ="mdKWws3525CNhYTr9TwJiLlio";
			        $consumer_secret    ="cgUVbC3agdSSytd3FLaHmqx2V416g7JY2OFynm9B0eiX7iAsQj";
			        $oauth_token        ="2863641847-XMlY9MrwaGgN7Jbm8bP1AVEDBF2yOvOKmVpN4sn";
			        $oauth_token_secret ="EgKbZlT1B3xT5oJJZXyjOHQOtIvwrfowuY5YLODwxL6NJ";
			        //TwitterOAuthのインスタンスを生成
			        $twitter = new TwitterOAuth(
			            $consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret
			        );
			        //メソッドを指定(ここではつぶやくメソッドを指定)
			        $method = "statuses/update";
			        //パラメータを指定(ここではつぶやく文字列を指定)
			        $parameters = array("status" => $tubuyaki);
			        //メソッドを実行(ここではつぶやきます。)
			        $response = $twitter->post($method, $parameters);
			        //戻り値取得
			        $http_info = $twitter->http_info;
			        $http_code = $http_info["http_code"];
    
        
        
        
					
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
    
    
    public function TwitterPost($tubuyaki)
    {
        //Twitterizerライブラリを取り込む
require_once("../Vendor/twitteroauth/twitteroauth.php");
require_once("../Vendor/twitteroauth/OAuth.php");
        //https://dev.twitter.com/appsで発行したtokenを設定して下さい。
        $consumer_key       ="mdKWws3525CNhYTr9TwJiLlio";
        $consumer_secret    ="cgUVbC3agdSSytd3FLaHmqx2V416g7JY2OFynm9B0eiX7iAsQj";
        $oauth_token        ="2863641847-XMlY9MrwaGgN7Jbm8bP1AVEDBF2yOvOKmVpN4sn";
        $oauth_token_secret ="EgKbZlT1B3xT5oJJZXyjOHQOtIvwrfowuY5YLODwxL6NJ";
        //TwitterOAuthのインスタンスを生成
        $twitter = new TwitterOAuth(
            $consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret
        );
        //メソッドを指定(ここではつぶやくメソッドを指定)
        $method = "statuses/update";
        //パラメータを指定(ここではつぶやく文字列を指定)
        $parameters = array("status" => $tubuyaki);
        //メソッドを実行(ここではつぶやきます。)
        $response = $twitter->post($method, $parameters);
        //戻り値取得
        $http_info = $twitter->http_info;
        $http_code = $http_info["http_code"];
        if($http_code == "200" && !empty($response))
        {
            //つぶやき成功
            return true;
        }
        else
        {
            //つぶやき失敗
            return false;
        }
    }


}