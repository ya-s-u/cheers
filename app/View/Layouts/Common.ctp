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
	
	<title><?=$title_for_layout?> | Cheers!</title>
		
	<?=$this->Html->css('common')?>
</head>
<body>
	<div id="header">
		<div class="container">
			<h1><a href="//cheers.trial.jp"><?=$this->Html->image('logo.png')?></a></h1>
			<?php if(isset($auth)) :?>
			<ul class="user_menu">
				<li><a href="/posts/create"><?=$this->Html->image($auth['User']['twitter_profile_img_url'])?>まとめをつくる</a></li>
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
			<p class="belt_catch">行きたいお店をきっかけに、</br>久しぶりの親友と食事をしよう</p>
		</div>
	</div>
	
	<!-- 
	<div class="select_article">
		<div class="select_article_head">
			<input type="text" ng-model="SearchText" id="ArticleSearch" placeholder="エンターキーを押して検索">
			<div class="page_manage">
				<i class="icon-arrow-left" ng-show="Status.has_prev" ng-click="changePage(SearchText,Status.current_page-1)"></i>
				<p class="page_num" ng-show="Recipes">{{Status.current_page}}/{{Status.page_count}}</p>
				<i class="icon-arrow-right" ng-show="Status.has_next" ng-click="changePage(SearchText,Status.current_page+1)"></i>
			</div>
			<p class="select_article_count">選択中の記事数: <span>{{CountSelectedRecipes}}</span>/10</p>
		</div>
		<div class="select_article_body">
			<p ng-show="!Recipes" class="select_article_none">キーワードを入力して、nanapiの記事を検索してください</p>
			<ul class="select_article_list">
				<li ng-repeat="recipe in Recipes" ng-click="addRecipe(recipe.recipe_id,recipe.title,recipe.image)">
					<img src="{{recipe.image}}?quality=85&size=250">
					<p>{{recipe.title}}</p>
					<a href="http://nanapi.jp/{{recipe.recipe_id}}" target="_blank">nanapiで記事を確認</a>
				</li>
			</ul>
		</div>
	</div>
	 -->
	
	<div class="main" ng-controller="SelectShopCtrl">
		<div class="search">
			<div class="container">
				<input type="text" ng-model="SearchText" id="ArticleSearch" placeholder="エンターキーを押して検索">
			</div>
		</div>
		<div class="container">
			<ul class="shop">
				<li ng-repeat="shop in Shops">
					<img class="shop_img" src="{{shop.photo.pc.l}}">
					<p class="shop_budget"><i class="icon-info"></i>{{shop.budget.average}}</p>
					<p class="shop_title">{{shop.name}}</p>
					<p class="shop_catch">{{shop.catch}}</p>
					<a class="shop_link" href="{{shop.urls.pc}}" target="_blank">お店の詳細を確認する</a>
				</li>
			</ul>
			<!-- <?=$this->fetch('content')?> -->
		</div>
	</div>
	<div id="footer">
		<div class="container">
			<p class="footer_text">Work for the Cookpad Hackathon 2014</p>
			<p class="footer_cr">© 2014/10/18 Cheers! created by <a href="https://twitter.com/ya_s_u" target="_blank">@ya_s_u</a></p>
		</div>
	</div>
<?=$this->html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js')?>
<?=$this->html->script('//ajax.googleapis.com/ajax/libs/angularjs/1.2.22/angular.min.js')?>
<?=$this->html->script('angular.myfunc')?>
</body>
</html>