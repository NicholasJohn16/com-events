<? defined('KOOWA') or die('Restricted access');?>

<style>
	.entity-portrait-medium img {
		border-radius: 3px 3px 0 0 !important;
		width: 100%;
	}
	h3.entity-name {
		margin-bottom: 0;
	}
	h4.entity-name {
		margin-top: 0;
	}
	h4 small {
		color: inherit;
	}
</style>


<div class="row">
	<div class="span9">
		<?= @helper('ui.header') ?>

		<?
			$url['layout'] = 'list';
			$tags = array('hashtag', 'location', 'mention');
			foreach ($tags as $tag) {
				if (isset(${$tag})) {
					$url[$tag] = ${$tag};
				}
			}
		?>

		<?= @helper('ui.filterbox', @route($url)) ?>
		<?= @infinitescroll($items, array(
			'id' => 'an-actors',
			'url' => $url,
			'hiddenlink' => true,
			'columns' => 3
		)) ?>
	</div>
	<div class="span3">
		<div class="well well-small subscribe-links">
			<h4><?= @text('COM-EVENTS-EVENTS-SUBSCRIBE') ?></h4>

			<?php unset($url['layout']); ?>

			<button type="button" data-target="#rss" data-toggle="collapse" class="btn">RSS</button>
			<button type="button" data-target="#ical" data-toggle="collapse" class="btn">iCal</button>
			<button type="button" data-target="#json" data-toggle="collapse" class="btn">JSON</button>

			<style>
				.subscribe-links input {
					margin-bottom: 0;
				}
				.subscribe-links input {
					margin-top: 1rem;
				}
			</style>

			<div id="rss" class="collapse">
				<input class="input-block-level" type="text" readonly value="<?= @route(array_merge($url, ['format' => 'rss'])) ?>">
			</div>

			<div id="ical" class="collapse">
				<input class="input-block-level" type="text" readonly value="<?= @route(array_merge($url, ['format' => 'ical'])) ?>">
			</div>

			<div id="json" class="collapse">
				<input class="input-block-level" type="text" readonly value="<?= @route(array_merge($url, ['format' => 'json'])) ?>">
			</div>
		</div>
	
		<?php
			$hashtags = array();
			foreach ($items as $item) {
				foreach($item->eventHashtags as $hashtag) {
					$hashtags[$hashtag->id] = $hashtag->hashtag;
				}
			}
		?>

		<div class="an-gadget">
			<h3 class="gadget-title"><?= @text('COM-EVENTS-EVENTS-TRENDING-HASHTAGS') ?></h3>
			<div class="gadget-content">
				<ul class="nav nav-pills nav-stacked">
					<?php foreach ($hashtags as $hashtag): ?>
						<li>
							<a href="<?= @route(array_merge($url, ['hashtag[]' => $hashtag->name])) ?>">#<?= $hashtag->name ?></a>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>


	</div>
</div>

