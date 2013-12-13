<div id="forum-header">
	<nav class="main-navigation">
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/forum">Forum</a></li>
			<li><a href="/pages">Pages</a></li>
			<li><span>Current Page: <?php echo Request::get("page", "home"); ?></span></li>
		</ul>
	</nav>
</div>

<div id="forum-memberbar">
	<p>test</p>
</div>

<div id="forum-wrapper">
	<table class="forum-table" width="100%">
		<?php foreach($this->data as $forum): ?>
			<tr>
				<td><?php echo $this->html->a(sprintf('/forum/%s', $this->slugify($forum->name)), $forum->name); ?></td>
			</tr>
			<tr>
				<td><?php echo $forum->description; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<div id="forum-footer">
	<p>test</p>
</div>