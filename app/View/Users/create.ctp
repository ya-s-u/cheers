<div class="belt">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="/">nanapicトップ</a></li>
			<li><a href="/view">管理ページ</a></li>
		</ul>
	</div>
</div>
<div class="main" ng-controller="CreateCtrl">
	<div class="container">
		<h2>新規投稿</h2>
		<p class="h2_sub">キュレーション記事を作成します。</p>
		<p class="step"><span>Step1</span>まとめる記事を選択</p>
		<div class="edit_article">
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
			<div class="sort_article">
				<p class="sort_article_title">ドラッグして並び替え</p>
				<p ng-show="CountSelectedRecipes==0" class="sort_article_none">記事を追加してください
				</p>
				<ul class="sort_article_list">
					<li ng-repeat="selectedrecipe in SelectedRecipes" value="{{selectedrecipe.id}}" draggable="true">
						<img src="{{selectedrecipe.img_url}}?quality=85&size=250">
						<p>{{selectedrecipe.title}}</p>
						<i ng-click="removeRecipe(selectedrecipe.id)">×</i>
					</li>
				</ul>
			</div>
		</div>
		<div class="edit_info">
			<p class="step"><span>Step2</span>タイトルと説明文を記入</p>
			<?=$this->Form->create('Post',array('class'=>''))?>
				<p class="label">タイトル</p>
				<?=$this->Form->text('title',array('label'=>false,'div'=>false))?>
				<p class="label">説明文</p>
				<?=$this->Form->textarea('comment',array('label'=>false,'div'=>false))?>
				<!-- hidden start -->
				<?=$this->Form->hidden('recipe0')?>
				<?=$this->Form->hidden('recipe1')?>
				<?=$this->Form->hidden('recipe2')?>
				<?=$this->Form->hidden('recipe3')?>
				<?=$this->Form->hidden('recipe4')?>
				<?=$this->Form->hidden('recipe5')?>
				<?=$this->Form->hidden('recipe6')?>
				<?=$this->Form->hidden('recipe7')?>
				<?=$this->Form->hidden('recipe8')?>
				<?=$this->Form->hidden('recipe9')?>
                <?=$this->Form->hidden('thumb')?>
				<!-- hidden end -->
			<?=$this->Form->end()?>
		</div>
		<div class="edit_thumb">
			<p class="step"><span>Step3</span>サムネイル画像を選択</p>
			<div class="edit_thumb_box">
				<p ng-show="CountSelectedRecipes==0" class="edit_thumb_none">記事を追加してください
				</p>
				<ul class="edit_thumb_list">
					<li ng-repeat="selectedrecipe in SelectedRecipes">
						<img src="{{selectedrecipe.img_url}}?quality=85&size=250" ng-click="selectThumb(selectedrecipe.id)" ng-class="(thumb==selectedrecipe.id) ? 'selected' : ''">
					</li>
				</ul>
			</div>
		</div>
		<div class="edit_foot">
			<p class="edit_foot_sub">以上の内容に誤りがないか確認した上、投稿してください。</p>
			<p ng-click="submit()" class="edit_submit">投稿する</p>
		</div>
	</div>
</div>
