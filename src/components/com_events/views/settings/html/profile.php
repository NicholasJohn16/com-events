<?php defined('KOOWA') or die; ?>

<h3><?= @text('COM-ACTORS-PROFILE-EDIT-PROFILE-INFORMATION') ?></h3>

<script src="com_events/js/flatpickr.min.js" />
<link rel="stylesheet" href="media/com_events/css/flatpickr.min.css" />
<script src="com_events/js/dates.js" />

<form action="<?= @route($item->getURL()) ?>" method="post" autocomplete="off">

	<fieldset>
		<legend><?= @text('COM-ACTORS-PROFILE-INFO-BASIC') ?></legend>
		
		<div class="control-group">
			<label class="control-label" class="control-label" for="actor-name">
				<?= @text('COM-ACTORS-NAME') ?>
			</label>
			<div class="controls">
				<input type="text" class="input-block-level" id="actor-name" size="50" maxlength="100" name="name" value="<?=$item->name?>" required />
			</div>
		</div>
			
		<div class="control-group">
			<label class="control-label" for="actor-body">
				<?= @text('COM-ACTORS-BODY') ?>
			</label>
			<div class="controls">
				<textarea class="input-block-level" id="actor-body" name="body" rows="5" cols="5"><?= $item->body?></textarea>
			</div>
		</div>

		<div class="control-group">
			<label for="event-start-date" class="label-group">
				<?= @text('COM-EVENTS-EVENT-START-DATE') ?>
			</label>
			<div class="controls">
				<input type="text" class="input-block-level" id="startDate" value="">
				<input type="hidden" name="startDate" value="<?= $item->startDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z">
			</div>
		</div>

		<div class="control-group">
			<label for="event-end-date" class="label-group">
				<?= @text('COM-EVENTS-EVENT-END-DATE') ?>
			</label>
			<div class="control">
				<input type="text" class="input-block-level" id="endDate" value="">
				<input type="hidden" name="endDate" value="<?= $item->endDate->getDate(DATE_FORMAT_ISO_EXTENDED) ?>Z">
			</div>
		</div>
	</fieldset>
	
	<?php foreach ($profile as $header => $fields)  : ?>
	<fieldset>
		<legend><?= @text($header) ?></legend>
		<?php foreach ($fields as $label => $field) : ?>
		<div class="control-group">
			<label><?= @text($label) ?></label>
			<div class="controls">
				<?php if (is_object($field)) : ?>
				<?php $class = (in_array($field->name, array('textarea', 'input'))) ? 'input-block-level' : '' ?>
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
        <button type="submit" class="btn" data-loading-text="<?= @text('LIB-AN-ACTION-SAVING') ?>">
            <?= @text('LIB-AN-ACTION-SAVE'); ?>
        </button>
    </div>
</form>

