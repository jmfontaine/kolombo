<?php
namespace Kolombo\Console;

use Kolombo\Console\Command\Check as CheckCommand;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Kolombo application.
 */
class Application extends BaseApplication
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
    	parent::__construct('Kolombo by Jean-Marc Fontaine', '0.1-dev');
    }

    /**
     * Runs the current application.
     *
     * @param InputInterface  $input  An Input instance
     * @param OutputInterface $output An Output instance
     *
     * @return integer 0 if everything went fine, or an error code
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->registerCommands();

        return parent::doRun($input, $output);
    }

    protected function registerCommands()
    {
        $this->addCommands(
    	    array(
    	        new CheckCommand()
	        )
		);
    }
}