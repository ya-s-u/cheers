<!DOCTYPE html>
<html ng-app>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<meta http-equiv="expires" content="0">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="Content-Script-Type" content="text/javascript">
	<meta name="copyright" content="Copyright nanapic">
	
	<meta name="description" content="">
	<meta name="keywords" content="">
	
	<link rel="shortcut icon" href="<?=$this->Html->webroot.'img/fav.ico'?>">
	<link rel="apple-touch-icon-precomposed" href="<?=$this->Html->webroot.'img/fav.ico'?>" />
	
	<title>Cheers!</title>
		
	<?=$this->Html->css('common')?>
</head>
<body>
	<div id="header">
		<div class="container">
			<h1><a href="//cheers.trial.jp"><?=$this->Html->image('logo.png')?></a></h1>
			<?php if(isset($auth)) :?>
			<ul class="user_menu">
				<li><?=$this->Html->image($auth['User']['twitter_image_url'])?></li>
				<li><a href="/users/logout">ログアウト</a></li>
			</ul>
			<?php else :?>
			<ul class="user_menu">
				<li><a href="/twitters/redirect1"><i class="icon-twitter"></i>ログイン/ユーザー登録</a></li>
			</ul>
			<?php endif?>
		</div>
	</div>
	<div class="belt">
		<div class="container">
			<p class="belt_catch">気になるお店をきっかけに、</br>久しぶりの友人と食事をしませんか</p>
		</div>
	</div>
	<?=$this->fetch('content')?>
	<div id="footer">
		<div class="container">
			<p class="footer_text">Work for the Cookpad Hackathon 2014</p>
			<p class="footer_cr">© 2014/10/19 Cheers! created by <a href="https://twitter.com/ya_s_u" target="_blank">@ya_s_u</a></p>
		</div>
	</div>
<?=$this->html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js')?>
<?=$this->html->script('//ajax.googleapis.com/ajax/libs/angularjs/1.2.22/angular.min.js')?>
<?=$this->html->script('angular.myfunc')?>
</body>
</html>