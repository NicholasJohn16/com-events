<?php

class ComEventsViewEventsIcal extends LibBaseViewAbstract {

	protected function _initialize(KConfig $config)
	{
		$config->append(array(
			'mimetype' => 'text/calendar'
		));
	
		parent::_initialize($config);
	}

	public function display() {
		$settings = $this->getService('com:settings.setting');
		$name = $this->getName();
		$data = array();
		
		$data[] = 'BEGIN:VCALENDAR';
		$data[] = 'VERSION:2.0';
		$data[] = 'PRODID:-//'.$settings->sitename.'//NONSGML Events v1.0//EN';
		$data[] = 'NAME:'.$settings->sitename . ' Calendar';

		if (AnInflector::isPlural($name)) {
			$data = array_merge($data, $this->_getList());
		} else {
			$data = array_merge($data, $this->_getItem());
		}

		$data[] = 'END:VCALENDAR';

		$this->output = implode("\r\n", $data);

		return $this->output;
	}

	protected function _getList()
	{
		$data = array();

		if ($items = $this->_state->getList()) {
			
			foreach ($items as $item) {
				$data[] = 'BEGIN:VEVENT';

				$serializer = $this->getService('com:events.domain.serializer.event');

				$data = array_merge($data, $serializer->toIcalArray($item));

				$data[] = 'END:VEVENT';
			}

		}

		return $data;
	}

	protected function _getItem()
	{
		$data = array();

		if ($item = $this->_state->getItem()) {
			$data[] = 'BEGIN:VEVENT';

			$serializer = $this->getService('com:events.domain.serializer.event');
			$data = array_merge($data, $serializer->toIcalArray($item));

			$data[] = 'END:VEVENT';
		}

		return $data;
	}
}