<?php

class ComEventsControllerEvent extends ComActorsControllerDefault
{
	protected function _actionBrowse(AnCommandContext $context) {
		$query = $context->query;
		$today = AnDomainAttributeDate::getInstance()->serialize();

		if($this->filter == 'past') {
			$query->order('start_date', 'desc');
			$query->where('end_date', '<', $today);
		} else {
			$query->order('start_date', 'asc');
			$query->where('end_date', '>', $today);
		}

		parent::_actionBrowse($context);
	}

	protected function _actionAdd(AnCommandContext $context) {
		$data = $context->data;

		error_log('start_date: '.$context->data->startDate);
		error_log('end_data: '.$context->data->endDate);

		if(!$context->data->endDate) {
			$startDate = new DateTime($context->data->startDate);
			$context->data->endDate = $startDate->add(new DateInterval('PT1H'))->format(DATE_ATOM);
		}

		return parent::_actionAdd($context);
	}
}