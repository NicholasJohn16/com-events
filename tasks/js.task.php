<?php

if (!$console->isInitialized()) {
    return;
}

$console->add(new GenerateSampleCommand);

use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Input\InputDefinition;
use \Symfony\Component\Console\Output\OutputInterface;

class GenerateSampleCommand extends Command
{

	// public function __construct() {

	// 	parent::__construct();
	// }

	protected function configure()
	{
		$this
			->setName('js:build')
			->setDescription('Generate js file for Events');
			// ->setDefinition(array(
			// 	new InputArgument('component.entity', InputArgument::REQUIRED, 'Repo and entity to generate'),
			// 	new InputArgument('relationships', InputArgument::IS_ARRAY, 'Relationships for entities'), // followers:id 
			// 	new InputOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Number of entities to generate', 10)
			// ));
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$path = COMPOSER_ROOT . '/packages/events/src/media/com_events/js/';
		$files = ['moment.min.js', 'moment-timezone-with-data-10-year-range.min.js', 'time-element.js'];
		$concat = "";

		foreach($files as $file) {
			$contents = file_get_contents($path . $file);

			$concat .= $contents . "\n";
		}

		file_put_contents($path . 'events.js', $concat);
		
	}

}