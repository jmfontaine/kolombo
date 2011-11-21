<?php
namespace Kolombo\Report\Writer;

use Kolombo\Report\Report;

class Text
{
    public function write(Report $report, $destination = 'php://output')
    {
        $data = '';

        foreach ($report as $reportItem) {
            $data .= sprintf(
                "%s - %s\n",
                $reportItem->getItem()->getPathname(),
                $reportItem->getDefinition()->getDescription()
            );
        }

        file_put_contents($destination, $data);
    }
}