<?php
namespace Kolombo\Console\Command;

use Kolombo\Dictionary\Dictionary;
use Kolombo\Report\Report;
use Kolombo\Report\Writer\Text as TextWriter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Check extends Command
{
    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Console\Command.Command::configure()
     */
    protected function configure()
    {
        $this->setName('check')
             ->setDescription('Checks directories and files')
             ->setDefinition(
                 array(
                     new InputArgument(
                     	'path',
                         InputArgument::REQUIRED,
                         'Path to check'
                     ),
                 )
             )->setHelp(
                 sprintf(
					'%sChecks directories and files%s',
                 PHP_EOL,
                 PHP_EOL
                 )
             );
    }

    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Console\Command.Command::execute()
     */
    protected function execute(InputInterface $input,
        OutputInterface $output)
    {
        // Check path
        $path = $input->getArgument('path');
        if (!is_readable($path)) {
            throw new \InvalidArgumentException(
                "Path is unreadable ($path)"
            );
        }
        $path = realpath($path);

        $report = new Report();

        $directoryIterator = new \RecursiveDirectoryIterator($path);
        $directoryIterator->setInfoClass('Kolombo\Iterator\Item');

        $level = Dictionary::BASIC;
        $dictionariesPath = __DIR__ . '/../../../../data/';
        $plugins = array(
            new \Kolombo\Plugin\Archives($dictionariesPath, $report, $level),
            new \Kolombo\Plugin\TemporaryData($dictionariesPath, $report, $level),
            new \Kolombo\Plugin\Text($dictionariesPath, $report, $level),
            new \Kolombo\Plugin\Vcs($dictionariesPath, $report, $level),
        );

        $iterator = new \RecursiveIteratorIterator($directoryIterator, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $item) {
            foreach ($plugins as $plugin) {
                $plugin->process($item);
            }
        }

        $writer = new TextWriter();
        echo $writer->write($report);
    }
}
