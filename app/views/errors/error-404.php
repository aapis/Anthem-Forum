<?php for($i = 0; $i < sizeof($this->data); $i++): ?>
	<div class="system-error">
		<ul>
			<li class="error-class"><?php echo $this->data[$i]["class"]; ?></li>
			<li class="error-message"><?php echo $this->data[$i]["error"]; ?></li>
		</ul>
	</div>
<?php endfor; ?>