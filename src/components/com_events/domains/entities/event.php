<?php 

class ComEventsDomainEntityEvent extends ComActorsDomainEntityActor
{
	protected function _initialize(KConfig $config)
	{
		$config->append(array(
			'behaviors' => to_hash(array('com://site/events.domain.behavior.expirable'))
		));

		parent::_initialize($config);
	}
}