<div id="container">
	<div id="forum-header">
		<nav class="main-navigation">
			<ul>
				<a href="/">Home</a>
				<a href="/forum">Forum</a>
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
					<td><a href="<?php echo sprintf('/forum/%s', $this->slugify($forum->name)); ?>"><?php echo $forum->name; ?></a></td>
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
</div>