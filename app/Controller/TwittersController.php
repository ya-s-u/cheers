<?php
require_once("../Vendor/twitteroauth/twitteroauth.php");
require_once("../Vendor/twitteroauth/OAuth.php");

class TwittersController extends AppController {
    public $name = 'Twitters';
    public $autoRender = false;

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('redirect1', 'callback'));
    }

    /**
     * リクエストトークンを取得
     */
    public function redirect1() {
        //セッション開始
        CakeSession::start();

        //TwitterOAuthオブジェクト生成
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

        //リクエストトークンを取得しセッションに保存
        $request_token = $connection->getRequestToken(OAUTH_CALLBACK);
        $this->Session->write('oauth_token', $request_token['oauth_token']);
        $this->Session->write('oauth_token_secret', $request_token['oauth_token_secret']);

        //エラー処理
        if ($connection->http_code) {
            $url = $connection->getAuthorizeURL($request_token['oauth_token']);
            header('Location: ' . $url);
        } else {
            $this->redirect('/');
        }
    }

    /**
     * アクセストークンを取得
     */
    public function callback() {
        //セッション開始
        CakeSession::start();

        //TwitterOAuthオブジェクト生成
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $this->Session->read('oauth_token'), $this->Session->read('oauth_token_secret'));

        //セッションからリクエストトークンを削除
        $this->Session->delete('oauth_token');
        $this->Session->delete('oauth_token_secret');

        //アクセストークンを取得
        $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

        //未登録ユーザーなら新規登録
        if (!$this->User->getUserByTwitterId($access_token['user_id'])) {
            $this->User->createUser($access_token);
        }

        //ログイン
        $this->request->data['User'] = array('twitter_oauth_token' => $access_token['oauth_token'], 'twitter_oauth_token_secret' => $access_token['oauth_token_secret']);

        if ($this->Auth->login()) {
            $id = $this->Auth->user('id');

            //プロフィールを更新
            $this->getProfile($id);

            $this->redirect('/');
        } else {
            echo '作成失敗';
        }

    }

    /**
     * [OAuth]プロフィール(ユーザー名、使用言語、プロフィール画像URL)を最新に更新
     */
    public function getProfile($id) {
        //ユーザーDBからアクセストークン取得
        $access_token = $this->User->getAccessToken($id);

        //TwitterOAuthオブジェクト生成
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['twitter_oauth_token'], $access_token['twitter_oauth_token_secret']);

        //ユーザー情報を取得し、連想配列にする
        $content = $connection->get('account/verify_credentials');
        $content = (array)$content;

        //ユーザーDBへ上書きする
        $this->User->updateProfile($id, $content);

        return true;
    }

}
