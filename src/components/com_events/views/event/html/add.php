<?php defined('KOOWA') or die ?>

<script src="com_events/js/flatpickr.min.js" />
<script src="com_events/js/dates.js" />
<link rel="stylesheet" href="media/com_events/css/flatpickr.min.css" />

<?= @helper('ui.header') ?>

<?php $entity = empty($entity) ? @controller($this->getView()->getName())->getRepository()->getEntity()->reset() : $entity; ?>

<div class="row">
	<div class="col-8">
		<form action="<?= @route($entity->getURL()) ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="actor-name">
					<?= @text('COM-ACTORS-NAME') ?>
				</label>
				<input required class="form-control" size="30" maxlength="100" name="name" value="<?=$entity->name?>" type="text" />
			</div>
			
			<div class="form-group">
				<label for="actor-body">
					<?= @text('COM-ACTORS-BODY') ?>
				</label>
				<textarea required maxlength="1000" class="form-control" name="body" rows="5"><?= $entity->body?></textarea>
			</div>

			<div class="form-group">
				<label for="event-start-date">
					<?= @text('COM-EVENTS-EVENT-START-DATE') ?>
				</label>
				<input type="text" class="form-control text-white" id="startDate" value="">
				<input type="hidden" name="startDate" value="<?= $entity->startDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z">
			</div>

			<div class="form-group">
				<label for="event-end-date" class="label-group">
					<?= @text('COM-EVENTS-EVENT-END-DATE') ?>
				</label>
				<input type="text" class="form-control text-white" id="endDate" value="">
				<input type="hidden" name="endDate" value="">
			</div>
			
			<?php if ($entity->isEnableable() && $entity->authorize('administration')) : ?>
			<div class="form-group">
				<label for="actor-enabled">
					<?= @text('COM-ACTORS-ENABLED') ?>
				</label>
				<?= @html('select', 'enabled', array('options' => array(@text('LIB-AN-NO'), @text('LIB-AN-YES')), 'selected' => $entity->enabled))->class('custom-select') ?>
			</div>
			<?php endif;?>
			
			<?php if ($entity->isPrivatable()) : ?>
			<div class="form-group">
				<label for="actor-privacy">
					<?= @text('COM-ACTORS-PRIVACY') ?>
				</label>
				<?= @helper('ui.privacy', array('auto_submit' => false, 'entity' => $entity))?>
			</div>
			<?php endif;?>
			
			<div class="form-actions">
				<a href="javascript:history.go(-1)" class="btn btn-secondary"><?= @text('LIB-AN-ACTION-CANCEL') ?></a>
				<button type="submit" class="btn btn-primary"><?= @text('LIB-AN-ACTION-SAVE') ?></button>
			</div>
		</form>
	</div>
</div>