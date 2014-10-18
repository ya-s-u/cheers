<div class="belt">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="/">nanapicトップ</a></li>
			<li><a href="/curators">キュレーター一覧</a></li>
		</ul>
	</div>
</div>
<div class="main">
	<div class="container">
		<h2>キュレーター一覧</h2>
		<p class="h2_sub">キュレーターを紹介します。</p>
		<ul class="curators">
		<?php foreach($Users as $user) :?>
			<li>
				<?= $this->Html->image($user['User']['twitter_profile_img_url'],array('class'=>'curators_image'))?>
				<h3 class="curators_name"><?=h($user['User']['twitter_user_name'])?></h3>
				<p class="curators_twitter"><a href="https://twitter.com/<?=h($user['User']['twitter_screen_name'])?>" target="_blank"><i class="icon-twitter"></i><?=h($user['User']['twitter_screen_name'])?></a></p>
				<p class="curators_description"><?=h($user['User']['twitter_description'])?></p>
			</li>
		<?php endforeach?>
		</ul>
	</div>
</div>