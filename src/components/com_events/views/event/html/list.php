<?php defined('KOOWA') or die ?>

<?php $commands = @commands('list') ?>
<?php $highlight = ($item->isEnableable() && !$item->enabled) ? 'bg-primary' : '' ?>
<div class="card an-entity">
	<?= @avatar($item, 'large', false, ['class' => 'card-img-top']) ?>
	<div class="card-body">
		
		<h5 class="card-title mb-1"><?= @name($item) ?></h5>

		<h5 class="card-subtitle mb-3"><small><time datetime="<?= $item->startDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z" data-format="MMMM Do, h:mm a"><?= @helper('date', $item); ?></time></small></h5>

		<div class="mb-2">
			<?php foreach ($item->eventHashtags as $hashtag): ?>
				<?php $name = $hashtag->hashtag->name; ?>
				<a href="<?= @route(['view' => 'events', 'hashtag[]' => $name]) ?>" class="badge badge-info text-white"><?= $name ?></a>
			<?php endforeach ?>
		</div>

		<div class="row">
			<div class="col-auto">
				<?php if (count($commands)) : ?>
				<div class="entity-actions">
					<?php if ($action = $commands->extract('follow')) : ?>
						<?= @helper('ui.command', $action->class('btn btn-primary')) ?> 
					<?php elseif ($action = $commands->extract('unfollow')) : ?>
						<?= @helper('ui.command', $action->class('btn btn-secondary'))?> 
					<?php endif;?>
					
					<?php foreach ($commands as $action) : ?>
						<?= @helper('ui.command', $action->class('btn btn-secondary')) ?>
					<?php endforeach;?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<div class="entity-meta">
					<?= $item->followerCount ?>
					<span class="stat-name"><?= @text('COM-ACTORS-SOCIALGRAPH-FOLLOWERS') ?></span>
				</div>
			</div>
		</div>


	</div>

</div>