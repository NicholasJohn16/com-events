<?php defined('KOOWA') or die; ?>

<h3><?= @text('COM-ACTORS-PROFILE-EDIT-PROFILE-INFORMATION') ?></h3>

<script src="com_events/js/flatpickr.min.js" />
<link rel="stylesheet" href="media/com_events/css/flatpickr.min.css" />
<script src="com_events/js/dates.js" />

<form action="<?= @route($item->getURL()) ?>" method="post" autocomplete="off">

	<fieldset>
		<legend><?= @text('COM-ACTORS-PROFILE-INFO-BASIC') ?></legend>
		
		<div class="form-group">
			<label class="control-label" for="actor-name">
				<?= @text('COM-ACTORS-NAME') ?>
			</label>
			<input type="text" class="form-control" id="actor-name" size="50" maxlength="100" name="name" value="<?=$item->name?>" required />
		</div>
			
		<div class="form-group">
			<label for="actor-body">
				<?= @text('COM-ACTORS-BODY') ?>
			</label>
			<textarea class="form-control" id="actor-body" name="body" rows="5" cols="5"><?= $item->body?></textarea>
		</div>

		<div class="form-group">
			<label for="event-start-date">
				<?= @text('COM-EVENTS-EVENT-START-DATE') ?>
			</label>
			<input type="text" class="form-control text-white" id="startDate" value="">
			<input type="hidden" name="startDate" value="<?= $item->startDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z">
		</div>

		<div class="form-group">
			<label for="event-end-date">
				<?= @text('COM-EVENTS-EVENT-END-DATE') ?>
			</label>
			<input type="text" class="form-control text-white" id="endDate" value="">
			<input type="hidden" name="endDate" value="<?= $item->endDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z">
		</div>
	</fieldset>
	
	<?php foreach ($profile as $header => $fields)  : ?>
	<fieldset>
		<legend><?= @text($header) ?></legend>
		<?php foreach ($fields as $label => $field) : ?>
		<div class="form-group">
			<label><?= @text($label) ?></label>
			<div class="controls">
				<?php if (is_object($field)) : ?>
				<?php $class = (in_array($field->name, array('textarea', 'input'))) ? 'form-control' : '' ?>
				<?= $field->class($class)->rows(5)->cols(5) ?>
				<?php else : ?>
				<?= $field ?>
				<?php endif;?>
			</div>
		</div>
		<?php endforeach;?>
	</fieldset>
	<?php endforeach;?>
	
	<div class="form-actions">
        <button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-ACTION-SAVING') ?>">
            <?= @text('LIB-AN-ACTION-SAVE'); ?>
        </button>
    </div>
</form>

