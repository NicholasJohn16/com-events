<?php

class ComEventsDomainSerializerEvent extends ComBaseDomainSerializerDefault
{
	public function toIcalArray($entity) {
		$settings = $this->getService('com:settings.setting');
		$data = array();

		$data[] = 'SUMMARY:'.$entity->title;
		$data[] = 'UID:'.$entity->id.'@'.$settings->live_site;

		$data[] = 'DTSTAMP:'.$entity->creationTime->getDate(DATE_FORMAT_ISO_BASIC).'Z';
		$data[] = 'DTSTART:'.$entity->startDate->getDate(DATE_FORMAT_ISO_BASIC).'Z';

		if($entity->endDate) {
			$data[] = 'DTEND:'.$entity->endDate->getDate(DATE_FORMAT_ISO_BASIC).'Z';
		}

		return $data;
	}

	public function toXmlObject($entity) {
		
	}

}