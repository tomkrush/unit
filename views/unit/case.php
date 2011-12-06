<div class="case" ref="<?=$case['name']?>">
	<div class="header">
		<h3><?=$case['name']?></h3>
		<a href="#" class="refresh" data-url="<?=site_url('unit/api/refresh?case='.$case['name'])?>">Refresh</a>
	</div>
	<?php foreach($case['assertions'] as $assertion): ?>
		<div class="assertion <?=$assertion['pass']?>">
			<div class="status <?=$assertion['pass']?>"><?=$assertion['pass']?></div>
			<div class="message"><?=$assertion['message']?></div>
			<?php if ( $assertion['console'] ): ?>
				<a href="#" class="console">Console</a>
			<?php endif; ?>
			<div class="time"><?=$assertion['execution_time']?></div>
		</div>
		<div class="buffer">
			<pre><?=$assertion['console']?></pre>
		</div>
	<?php endforeach; ?>
</div>