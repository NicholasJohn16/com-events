<?php

class ComEventsControllerEvent extends ComActorsControllerDefault
{
	protected function _actionBrowse(AnCommandContext $context) {
		$query = $context->query;
		$today = AnDomainAttributeDate::getInstance()->serialize();

		if($this->filter == 'past') {
			$query->order('start_date', 'desc');
			$query->where('event.end_date', '<', $today);
		} else {
			$query->order('start_date', 'asc');
			$query->where('event.end_date', '>', $today);
		}

		parent::_actionBrowse($context);
	}

	protected function _actionAdd(AnCommandContext $context) {
		$data = $context->data;

		if(!$context->data->endDate) {
			$startDate = new DateTime($context->data->startDate);
			$context->data->endDate = $startDate->add(new DateInterval('PT1H'))->format(DATE_ATOM);
		}

		return parent::_actionAdd($context);
	}
}