<?php

class ComEventsViewEventsRss extends LibBaseViewTemplate
{
	protected function _initialize(KConfig $config)
	{

		$config->append(array(
			'mimetype' => 'application/rss+xml'
		));

		parent::_initialize($config);
	}

	public function display()
	{
		$settings = $this->getService('com:settings.setting');
		$name = $this->getName();
		$content = $this->getService('plg:contentfilter.chain')::getInstance();

		$doc = new DOMDocument("1.0", 'UTF-8');
		$doc->preserveWhiteSpace = false;
		$doc->formatOutput = true;

		$rss = $doc->createElement('rss');
		$rss->setAttribute('version', '2.0');
		$rss->setAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
		$doc->appendChild($rss);

		$channel = $doc->createElement('channel');
		$rss->appendChild($channel);
		
		$atomLink = $doc->createElement('atom:link');

		$atomLink->setAttribute('href', route(['format' => 'rss']));
		$atomLink->setAttribute('rel', 'self');
		$atomLink->setAttribute('type', 'application/rss+xml');
		$channel->appendChild($atomLink);

		$title = $doc->createElement('title', $settings->sitename . ' Events');
		$channel->appendChild($title);

		$link = $doc->createElement('link', route(['view' => 'events']));
		$channel->appendChild($link);

		if($description = get_config_value('events', 'rss_description', '')) {
			$desc = $doc->createElement('description', $description);
			$channel->appendChild($description);
		}

		if($events = $this->getState()->getList()) {
			foreach ($events as $event) {
				$item = $doc->createElement('item');

				$title = $doc->createElement('title', $event->title);
				$item->appendChild($title);

				$link = $doc->createElement('link', route($event->getURL()));
				$item->appendChild($link);

				$guid = $doc->createElement('guid', route(['option' => 'events', 'view' => 'event', 'id' => $event->id ]));
				$item->appendChild($guid);

				$description = '';

				if($event->portraitSet()) {
					$img = '<img src="' . $event->getPortraitURL('large') . '" />';
					$description .= $img;
				}

				if ($event->description) {
					$description .= nl2br($content->filter($event->description));
				}

				if($description) {
					$desc = $doc->createElement('description');
					$cdata = $doc->createCDATASection($description);
					$desc->appendChild($cdata);
					$item->appendChild($desc);
				}

				$channel->appendChild($item);

			}
		}

		$this->output = $doc->saveXML();

		return $this->output;
	}

}