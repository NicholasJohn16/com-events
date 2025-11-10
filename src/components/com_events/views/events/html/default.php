<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js" />

<script>
	$(document).ready(function() {
		new ClipboardJS('.btn-copy');
	});
</script>

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
	.entity-meta {
		line-height: 2.25rem;
	}
	.an-page-header {
		display: none;
	}

	.jumbotron {
	background-position: center center;
	background-size: cover;
	}
	.jumbotron h4, .jumbotron h5 {
		text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
		font-weight: bold;
	}
</style>

<div class="row">
	<div class="col-lg-9">
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

		<?php if (count($items)): ?>
			<div class="row">
				<div class="col">
					<?php $first = $items->top(); ?>
					<?php $coverURL = $first->getCoverURL('large') ?>
					<?php $coverURL = str_replace('\\', '/', $coverURL) ?>
					<div class="jumbotron border shadow" style="background-image:url(<?= $coverURL ?>)" >
						<h4 class="mb-0"><a href="<?= @route($first->getURL()) ?>"><?= $first->title ?></a></h4>
						<h5 class="mb-3"><small><time datetime="<?= $first->startDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z" data-format="MMMM Do, h:mm a"><?= @helper('date', $first); ?></time></small></h5>
						<p>
							<?php foreach ($first->eventHashtags as $tag): ?>
								<?php $name = $tag->hashtag->name; ?>
								<a href="<?= @route(['view' => 'events', 'hashtag[]' => $name]) ?>" class="badge badge-info text-white"><?= $name ?></a>
							<?php endforeach ?>
						</p>
					</div>
				</div>
			</div>
		<?php endif ?>

		<?= @helper('ui.filterbox', @route($url)) ?>

		<?= @infinitescroll($items, array(
			'id' => 'an-actors',
			'url' => $url,
			'hiddenlink' => true,
			'columns' => 3
		)) ?>
	</div>
	<div class="col">
		<div class="card my-3 shadow-none">
			<div class="card-body">
				<h5 class="card-title"><?= @text('COM-EVENTS-EVENTS-SUBSCRIBE') ?></h5>

				<?php unset($url['layout']); ?>
				<button type="button" class="btn btn-info btn-copy" data-clipboard-text="<?= @route(array_merge($url, ['format' => 'rss'])) ?>">RSS</button>
				<button type="button" class="btn btn-info btn-copy" data-clipboard-text="<?= @route(array_merge($url, ['format' => 'ical'])) ?>">iCal</button>
				<button type="button" class="btn btn-info btn-copy" data-clipboard-text="<?= @route(array_merge($url, ['format' => 'json'])) ?>">JSON</button>

				<p class="text-muted mb-0 mt-1"><small>Click or tap to copy links.</small></p>
			</div>
		</div>

		<?php
			$hashtags = array();
			foreach ($items as $item) {
				foreach($item->eventHashtags as $tag) {
					if(in_array($tag->hashtag->name, $hashtag)) continue;
					$hashtags[$tag->hashtag->id] = $tag->hashtag;
				}
			}
		?>

		<div class="card my-3 shadow-none">
			<div class="card-body">
				<h5 class="card-title"><?= @text('COM-EVENTS-EVENTS-TRENDING-HASHTAGS') ?></h5>

				<ul class="nav flex-column nav-pills">
					<?php foreach ($hashtags as $tag): ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= @route(array_merge($url, ['hashtag[]' => $tag->name])) ?>">#<?= $tag->name ?></a>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>


	</div>
</div>

