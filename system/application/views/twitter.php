<h1>Inferno/Twitter API Example</h1>

<h2>Twitter Public Timeline</h2>
<?php foreach ($public_timeline as $tweet):?>
	<p><?=$tweet->text?><br /><strong><?=$tweet->user->screen_name?> (<?=$tweet->created_at?>)</strong><p>
<?php endforeach; ?>