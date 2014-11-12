<?php for($i = 0; $i < sizeof($this->data); $i++): ?>
	<div class="system-error">
		<ul>
			<li class="error-class">Anthem::<span><?php echo $this->data[$i]["class"]; ?></span></li>
			<li class="error-message"><?php echo $this->data[$i]["error"]; ?></li>
		</ul>
	</div>
<?php endfor; ?>