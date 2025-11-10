<?php 

class ComEventsControllerToolbarDefault extends ComActorsControllerToolbarDefault
{

	public function onAfterControllerBrowse(AnEvent $event)
    {
        parent::onAfterControllerBrowse($event);

        $this->addCommand('pastEvents');
    }

    protected function _commandPastEvents($command)
    {
        $name = $this->getController()->getIdentifier()->name;
        $label = translate('COM-EVENTS-EVENTS-PAST-EVENTS');
        $url = 'option=com_events&view=events&filter=past';

        $command->append(array('label' => $label))->href($url);
    }

}