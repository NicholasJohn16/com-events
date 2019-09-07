<?php defined('KOOWA') or die ?>

<?php $commands = @commands('list') ?>
<?php $highlight = ($item->isEnableable() && !$item->enabled) ? 'an-highlight' : '' ?>
<div class="an-entity dropdown-actions <?= $highlight ?>">

	<div class="entity-portrait-medium">
		<a href="<?= @route($item->getURL()) ?>">
			<?= @avatar($item, 'large') ?>
		</a>
	</div>

	<h3 class="entity-name">
		<?= @name($item) ?>
	</h3>

	<h4 class="entity-name">
		<small><time datetime="<?= $item->startDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z" data-format="MMMM Do, h:mm a"><?= @helper('date', $item); ?></time></small>
	</h4>

	<div class="entity-description">
		<?= @helper('text.truncate', @content($item->body, array('exclude' => array('syntax', 'video'))), array('length' => 200, 'consider_html' => true)); ?>
	</div>

	<div class="entity-meta">
		<?php foreach ($item->eventHashtags as $hashtag): ?>
			<?php $name = $hashtag->hashtag->name; ?>
			<a href="<?= @route(['view' => 'events', 'hashtag[]' => $name]) ?>" class="badge" style="background-color:<?= @helper('stringToColor', $name) ?>"><?= $name ?></a>
		<?php endforeach ?>
	</div>

	<div class="entity-meta">
		<?= $item->followerCount ?>
		<span class="stat-name"><?= @text('COM-ACTORS-SOCIALGRAPH-FOLLOWERS') ?></span>
	</div>

	<?php if (count($commands)) : ?>
	<div class="entity-actions">
		<?php if ($action = $commands->extract('follow')) : ?>
			<?= @helper('ui.command', $action->class('btn btn-primary')) ?> 
		<?php elseif ($action = $commands->extract('unfollow')) : ?>
			<?= @helper('ui.command', $action->class('btn'))?> 
		<?php endif;?>
		
		<?php foreach ($commands as $action) : ?>
			<?= @helper('ui.command', $action->class('btn')) ?>
		<?php endforeach;?>
	</div>
	<?php endif; ?>
</div>