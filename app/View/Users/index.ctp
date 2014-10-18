<div class="main" ng-controller="SelectShopCtrl">
	<div class="shop_search">
		<div class="container">
			<input class="shop_search_input" type="text" ng-model="SearchText" id="ArticleSearch" placeholder="店名や駅名を入力">
			<button class="shop_search_submit">お店を探す</button>
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
		<ul class="shop">
			<li ng-repeat="shop in Shops">
				<img class="shop_img" src="{{shop.photo.pc.l}}">
				<p class="shop_budget"><i class="icon-info"></i>{{shop.budget.average}}</p>
				<p class="shop_title">{{shop.name}}</p>
				<p class="shop_catch">{{shop.catch}}</p>
				<a class="shop_link" href="{{shop.urls.pc}}" target="_blank">お店の詳細を確認する</a>
			</li>
		</ul>
	</div>
</div>