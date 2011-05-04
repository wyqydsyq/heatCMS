<h1>Example Inferno/Simplepie RSS Parsing</h1>

<h2><?=$rss_title?></h2>
<ul>
<?php foreach($rss_items as $item): ?>
<li>
	<h3><a href="<?=$item->get_link()?>"><?=$item->get_title()?></a></h3>
	<h4><?=$item->get_date()?></h4>
	<p><?=$item->get_content()?></p>
</li>
<?php endforeach; ?>