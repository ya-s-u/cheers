<div class="belt">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="/">nanapicトップ</a></li>
			<li><a href="/view/<?= h($post['Post']['id']) ?>"><?= h($title_for_layout) ?></a></li>
		</ul>
	</div>
</div>
<div class="view_head">
	<div class="container">
		<img class="view_head_thumb" src="<?= h($post['Post']['thumb_img_url']) ?>?mode=trim&width=100&height=100">
		<h2 class="view_head_title"><a href="/view/<?= h($post['Post']['id']) ?>"><?= h($post['Post']['title']) ?></a></h2>
		<p class="view_head_comment"><?= h($post['Post']['comment']) ?></p>
		<p class="view_head_created"><i class="icon-clock"></i><?= date('Y年m月d日 G:i', strtotime($post['Post']['created'])) ?></p>
		<p class="view_head_pv"><?= h($post['Post']['pv_count'])*27 ?><span>view</span></p>
	</div>
</div>
<div class="main">
	<div class="container">
		<div class="view_left">
			<ul class="view_recipe">
				<?php foreach($post['Recipe'] as $i => $recipe) :?>
				<li>
					<a href="//nanapi.jp/<?= h($recipe['nanapi_article_id']) ?>" target="_blank">
						<h3 class="view_recipe_title"><?= $i+1 ?>. <?= h($recipe['title']) ?></h3>
						<img class="view_recipe_image" src="<?= h($recipe['thumb_img_url']) ?>">
						<p class="view_recipe_description"><?= h($recipe['description']) ?></p>
					</a>
				</li>
				<?php endforeach?>
			</ul>
		</div>
		<div class="view_right">
			<div class="view_auther">
				<img class="view_auther_thumb" src="<?= h($post['User']['twitter_profile_img_url']) ?>">
				<h4 class="view_auther_name"><?= h($post['User']['twitter_user_name']) ?></h4>
				<p class="view_auther_twitter"><a href="https://twitter.com/<?= h($post['User']['twitter_screen_name']) ?>" target="_blank"><i class="icon-twitter"></i><?= h($post['User']['twitter_screen_name']) ?></a></p>
				<p class="view_auther_description"><?= h($post['User']['twitter_description']) ?></p>
			</div>
			<div class="ranking">
				<h2 class="ranking_title">人気のまとめ</h2>
				<ul class="ranking_list">
					<?php $i=1;foreach($PopularPosts as $post) :?>
					<li>
						<a href="/view/<?= h($post['Post']['id']) ?>">
							<span class="ranking_list_rank"><?= $i++ ?></span>
							<img class="ranking_list_thumb" src="<?= h($post['Post']['thumb_img_url']) ?>?mode=trim&width=275&height=100">
							<h3 class="ranking_list_title"><?= h($post['Post']['title']) ?></h3>
						</a>
					</li>
					<?php endforeach?>
				</ul>
			</div>
			<div class="user">
				<h2 class="user_title">キュレーター一覧</h2>
				<ul class="user_list">
					<?php foreach($Users as $user) :?>
					<li>
						<?= $this->Html->image($user['User']['twitter_profile_img_url'],array('class'=>'user_image'))?>
					</li>
					<?php endforeach?>
				</ul>
			</div>
		</div>
	</div>
</div>
