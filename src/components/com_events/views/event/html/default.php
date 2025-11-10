<? defined('KOOWA') or die('Restricted access') ?>

<? $socialgraphGadget = $gadgets->extract('socialgraph') ?>

<? if ($item->coverSet()): ?>
	<div
		class="profile-cover"
		data-trigger="Cover"
		data-src-large="<?= $item->getCoverURL('large'); ?>"
		data-src-medium="<?= $item->getCoverURL('medium'); ?>">
	</div>
<? endif; ?>

<div class="row <?= ($item->coverSet()) ? ' has-cover' : '' ?>" id="node-container">
	<div class="col-md-3 col-lg-2 avatar-column">
		<div id="actor-avatar">
			<?= @avatar($item, 'medium', false) ?>
		</div>

        <? if (count($gadgets) > 1) : ?>
            <ul class="nav nav-pills flex-column streams">
                <li class="nav-item">
                    <a class="nav-link disabled" tabindex="-1"><?=  @text('LIB-AN-STREAMS') ?></a>
                </li>
                <? foreach ($gadgets as $index => $gadget) : ?>
                <li data-stream="<?= $index ?>" class="nav-item ">
                    <a class="nav-link <?= ($index == 'stories') ? 'active' : ''; ?>" href="#<?= $index ?>" data-toggle="tab"><?= $gadget->title ?></a>
                </li>
                <? endforeach;?>
            </ul>
        <? endif; ?>
	</div>

	<div class="col-md-6" id="container-main">
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
			<div class="tab-pane fade <?= ($index == 'stories') ? 'active show' : ''; ?>" id="<?= $index ?>">
				<?= @helper('ui.gadget', $gadget) ?>
			</div>
			<? endforeach;?>
		</div>
	</div>

	<div class="col-md-3 col-lg-4 d-none d-md-block">
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
