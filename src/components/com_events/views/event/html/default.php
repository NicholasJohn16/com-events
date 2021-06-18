<? defined('KOOWA') or die('Restricted access') ?>

<? if (defined('ANDEBUG') && ANDEBUG) : ?>
<script src="com_actors/js/cover.js" />
<? else: ?>
<script src="com_actors/js/min/cover.min.js" />
<? endif; ?>

<? $socialgraphGadget = $gadgets->extract('socialgraph') ?>

<? if ($item->coverSet()): ?>
<div
	class="profile-cover parallax-window"
	data-parallax="scroll"
	data-image-src="<?= $item->getCoverURL('large'); ?>"
	data-src-large="<?= $item->getCoverURL('large'); ?>"
	data-src-medium="<?= $item->getCoverURL('medium'); ?>">
</div>
<? endif; ?>

<div class="row-fluid<?= ($item->coverSet()) ? ' has-cover' : '' ?>" id="actor-profile">
	<div class="span2">
		<div id="actor-avatar">
		<?= @avatar($item, 'medium', false) ?>
		</div>

		<? if (count($gadgets) > 1) : ?>
		<ul class="nav nav-pills nav-stacked streams">
			<li class="nav-header">
			<?= @text('LIB-AN-STREAMS') ?>
			</li>
			<? foreach ($gadgets as $index => $gadget) : ?>
			<li data-stream="<?= $index ?>" class="<?= ($index == 'stories') ? 'active' : ''; ?>">
				<a href="#<?= $index ?>" data-toggle="tab"><?= $gadget->title ?></a>
			</li>
			<? endforeach;?>
		</ul>
		<? endif; ?>
	</div>

	<div class="span6" id="container-main">
		<? if ($item->isEnableable() && !$item->enabled): ?>
		<?= @message(@text('COM-ACTORS-PROFILE-DISABLED-PROMPT'), array('type' => 'warning')) ?>
		<? endif; ?>

		<?= @helper('ui.toolbar', array()) ?>

		<h2 id="actor-name">
		<?= @name($item, false) ?>
		<? if (is_person($item)): ?>
		<small>@<?= $item->username ?></small>
		<? endif; ?>
		</h2>

		<? if (!empty($item->body)): ?>
		<div id="actor-description">
		<?= @helper('text.truncate', @content($item->body, array('exclude' => array('syntax', 'video'))), array('length' => 250, 'read_more' => true, 'consider_html' => true)); ?>
		</div>
		<? endif; ?>

		<? if (!$viewer->blocking($item)): ?>
		<?= @helper('com:composer.template.helper.ui.composers', $composers) ?>
		<? endif; ?>

		<div class="tab-content">
			<? foreach ($gadgets as $index => $gadget) : ?>
			<div class="tab-pane fade <?= ($index == 'stories') ? 'active in' : ''; ?>" id="<?= $index ?>">
				<?= @helper('ui.gadget', $gadget) ?>
			</div>
			<? endforeach;?>
		</div>
	</div>

	<div class="span4 visible-desktop">
		<?= @helper('ui.gadget', $socialgraphGadget); ?>

		<h4 class="block-title">
			<?= @text('COM-EVENTS-EVENT-DETAILS') ?>
		</h4>

		<div class="block-content">
			<dl>
				<dt><?= @text('COM-EVENTS-EVENT-START-DATE') ?></dt>
				<dl><time datetime="<?= $item->startDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z" data-format="MMMM Do, h:mm a"><?= $item->startDate->getDate() ?></time></dl>
				<dt><?= @text('COM-EVENTS-EVENT-END-DATE') ?></dt>
				<dl><time datetime="<?= $item->endDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z" data-format="MMMM Do, h:mm a"><?= $item->endDate->getDate() ?></time></dl>
			</dl>
		</div>
		
	</div>
</div>
