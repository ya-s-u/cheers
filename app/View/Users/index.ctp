<div class="main" ng-controller="SelectShopCtrl">
	<div class="shop_search">
		<div class="container">
			<!--
			<input class="shop_search_input" type="text" ng-model="SearchText" id="ArticleSearch" placeholder="店名や駅名を入力">
			<button class="shop_search_submit">お店を探す</button>
			-->
			<p class="shop_search_text">行ってみたいお店をチェックするだけ！毎日22時(今は20分おき)に<a href="//twitter.com/cheers_bot" target="_blank">@cheers_bot</a>が行きたい人同士をマッチングします！</p>
		</div>
	</div>
	<!--
	<ul class="shop_nav">
		<li class="shop_nav_prev"><i class="icon-arrow-left"></i></li>
		<li class="shop_nav_next"><i class="icon-arrow-right"></i></li>
	</ul>
	-->
	<div class="container">
		<p class="shop_text">近所でおすすめのお店</p>
		<p class="loading" ng-show="!Shops">現在地からおすすめのお店を読み込み中.....</p>
		<ul class="shop">
			<li ng-repeat="shop in Shops">
				<img class="shop_img" src="{{shop.photo.pc.l}}" ng-click="add(<?php if(isset($auth))echo $auth['User']['user_id']?>,shop.id,shop.name,shop.urls.pc)">
				<p class="shop_budget"><i class="icon-info"></i>{{shop.budget.average}}</p>
				<p class="shop_title">{{shop.name}}</p>
				<p class="shop_catch">{{shop.catch}}</p>
				<a class="shop_link" href="{{shop.urls.pc}}" target="_blank">お店の詳細を確認する</a>
			</li>
		</ul>
	</div>
	<a href="//cheers.trial.jp"><?=$this->Html->image('logo.png',array('class'=>'logo'))?></a>
</div>

<script type="text/javascript">
	var List = [];
	<?php
	foreach($List as $list) {
		echo 'List.push("'.$list['Want']['shop_id'].'");';
	}
	?>
</script>