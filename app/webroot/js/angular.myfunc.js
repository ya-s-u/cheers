/*
 * キュレーション記事投稿ページ
 */
var CreateCtrl = function ($scope, $http) {

	//TODO: デバッグ用の初期表示指定
	//getRecipe('恋愛',1);

    //nanpiAPIから指定キーワードで検索
    $('#ArticleSearch').keypress(function (e) {
        if (e.which == 13) {
            if ($scope.SearchText) {
                getRecipe($scope.SearchText, 1);
            }
        }
    });
    
    //ページ移動
    $scope.changePage = function (query,id) {
    	getRecipe(query,id);
    }

    //検索クエリとページ数を指定してnanapiAPIを叩き、viewを更新
    function getRecipe(query, page) {
        var parameter = {
            'key': '4cb94f0895324',
            'format': 'json',
            'query': query,
            'is_image': 1,
            'page': page,
        };

        $http({
            method: 'GET',
            url: 'http://api.nanapi.jp/v1/recipeSearchDetails/',
            params: parameter,
        }).success(function (data, status, headers, config) {
            $scope.Status = data['response']['status'];
            $scope.Recipes = data['response']['recipes'];
        }).error(function (data, status, headers, config) {
            console.log('error!');
        });
    }

    //記事を追加
	$scope.SelectedRecipes = {};
    $scope.CountSelectedRecipes = 0;
    $scope.addRecipe = function (id, title, img_url) {
        if ($scope.CountSelectedRecipes < 10) {
            if(!(id in $scope.SelectedRecipes)) {
	            $scope.SelectedRecipes[id] = {
	                'id': id,
	                'title': title,
	                'img_url': img_url,
	            };
	            $scope.CountSelectedRecipes++;
	            $('.sort_article_list').sortable("refresh");
	            if(!$scope.thumb) {
	            	$scope.thumb = id;
	            }
			}
        }
    }

    //記事を削除
    $scope.removeRecipe = function (id) {
        delete $scope.SelectedRecipes[id];
        $scope.CountSelectedRecipes--;
        $('.sort_article_list').sortable("refresh");
    }

    //記事並び替えプラグイン
    $('.sort_article_list').sortable();
    
    //サムネイル選択
    $scope.selectThumb = function (id) {
    	$scope.thumb = id;
    }
    
    //送信
    $scope.submit = function () {
        var recipe_id = 0;
    	for(var i=0; i<10; i++) {
    		recipe_id = $('.sort_article_list li').eq(i).val();
			$(':hidden[name="data[Post][recipe'+i+']"]').val(recipe_id);
        }
        
        $(':hidden[name="data[Post][thumb]"]').val($scope.thumb);
        
        $('#PostCreateForm').submit();
    }

}

