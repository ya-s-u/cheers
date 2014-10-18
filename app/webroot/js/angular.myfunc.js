/*
 * ショップセレクト
 */
var SelectShopCtrl = function ($scope, $http) {
	if (navigator.geolocation) {
		// 現在の位置情報取得を実施
		navigator.geolocation.getCurrentPosition(
			// 位置情報取得成功時
			function (pos) { 
				var lat = pos.coords.latitude;
				var lng = pos.coords.longitude;
				
				getShopByPosition(lat, lng, 1);
			},
			// 位置情報取得失敗時
			function (pos) {
				console.log('error!');
			}
		);
	} else {
		window.alert("本ブラウザではGeolocationが使えません");
	}
	
	//getShopByPosition(35.2330675, 136.8394406, 1);
	
	
	//検索クエリとページ数を指定してnanapiAPIを叩き、viewを更新
	function getShopByPosition(lat, lng, page) {
		var uri ='http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?'
			+ '&key=729427de25c6b01c'
			+ '&lat=' + lat //緯度
			+ '&lng=' + lng //経度
			+ '&range=5' //範囲(3000m)
			+ '&order=4' //ソート(おすすめ順)
			+ '&start=' + page
			+ '&count=12'
			+ '&format=jsonp'
      + '&callback=JSON_CALLBACK';
    $http.jsonp(uri).success(function(data) {
      $scope.Shops = data.results.shop;
      
      
    });
	}
	
	$scope.add = function (user, id, name, url) {
        var parameter = {
 	 		'user_id': user,
 	 		'shop_id': id,
 	 		'name': name,
 	 		'url': url,
 	 	};

		$http({
			method : 'GET',
		    url : 'http://cheers.trial.jp/wants/add',
			params: parameter,
		}).success(function(data, status, headers, config) {
		}).error(function(data, status, headers, config) {
		});
    }
}


