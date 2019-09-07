<?php defined('KOOWA') or die ?>

<script src="com_events/js/flatpickr.min.js" />
<script src="com_events/js/dates.js" />
<link rel="stylesheet" href="media/com_events/css/flatpickr.min.css" />

<?= @helper('ui.header') ?>

<?php $entity = empty($entity) ? @controller($this->getView()->getName())->getRepository()->getEntity()->reset() : $entity; ?>

<div class="row">
	<div class="span8">
		<form action="<?= @route($entity->getURL()) ?>" method="post" enctype="multipart/form-data">
			<div class="control-group">
				<label class="label-group"  for="actor-name">
					<?= @text('COM-ACTORS-NAME') ?>
				</label>
				<div class="controls">
					<input required class="input-block-level" size="30" maxlength="100" name="name" value="<?=$entity->name?>" type="text" />
				</div>
			</div>
			
			<div class="control-group">
				<label class="label-group"  for="actor-body">
					<?= @text('COM-ACTORS-BODY') ?>
				</label>
				<div class="controls">
					<textarea required maxlength="1000" class="input-block-level" name="body" rows="5"><?= $entity->body?></textarea>
				</div>
			</div>

			<div class="control-group">
				<label for="event-start-date" class="label-group">
					<?= @text('COM-EVENTS-EVENT-START-DATE') ?>
				</label>
				<div class="controls">
					<input type="text" class="input-block-level" id="startDate" value="">
					<input type="hidden" name="startDate" value="<?= $entity->startDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z">
				</div>
			</div>

			<div class="control-group">
				<label for="event-end-date" class="label-group">
					<?= @text('COM-EVENTS-EVENT-END-DATE') ?>
				</label>
				<div class="control">
					<input type="text" class="input-block-level" id="endDate" value="">
					<input type="hidden" name="endDate" value="">
				</div>
			</div>
			
			<?php if ($entity->isEnableable() && $entity->authorize('administration')) : ?>
			<div class="control-group">
				<label class="label-group"  for="actor-enabled">
					<?= @text('COM-ACTORS-ENABLED') ?>
				</label>
				<div class="controls">
					<?= @html('select', 'enabled', array('options' => array(@text('LIB-AN-NO'), @text('LIB-AN-YES')), 'selected' => $entity->enabled))->class('input-small') ?>
				</div>
			</div>
			<?php endif;?>
			
			<?php if ($entity->isPrivatable()) : ?>
			<div class="control-group">
				<label class="label-group"  for="actor-privacy">
					<?= @text('COM-ACTORS-PRIVACY') ?>
				</label>
				<div class="controls">
					<?= @helper('ui.privacy', array('auto_submit' => false, 'entity' => $entity))?>
				</div>
			</div>
			<?php endif;?>
			
			<div class="form-actions">
				<a href="javascript:history.go(-1)" class="btn"><?= @text('LIB-AN-ACTION-CANCEL') ?></a>
				<button type="submit" class="btn btn-primary"><?= @text('LIB-AN-ACTION-SAVE') ?></button>
			</div>
		</form>
	</div>
</div>