<?php
namespace Kolombo\Dictionary;

use Kolombo\Dictionary\Definition\Directory as DirectoryDefinition;
use Kolombo\Dictionary\Definition\File as FileDefinition;
use Symfony\Component\Yaml\Parser;

class Dictionary
{
    const BASIC    = 'basic';
    const EXTENDED = 'extended';

    private $definitions = array(
    	'directories' => array(
            'plain' => array(),
            'regex' => array(),
        ),
        'files' => array(
            'plain' => array(),
            'regex' => array(),
        ),
    );

    private function load($path, $level = self::BASIC)
    {
        $yaml    = file_get_contents($path, false);
        $parser  = new Parser();
        $rawData = $parser->parse($yaml);

        $data = $rawData['basic'];
        if (self::EXTENDED === $level) {
            $data = array_merge($data, $rawData['extended']);
        }
        foreach ($data as $row) {
            $isRegex = array_key_exists('regex', $row) ? $row['regex'] : false;
            $type    = $isRegex ? 'regex' : 'plain';

            if ('directory' === $row['type']) {
                $key        = 'directories';
                $subKey     = $row['name'];
                $name       = $isRegex ? "/{$row['name']}/" : $row['name'];
                $definition = new DirectoryDefinition(
                    $row['name'],
                    $isRegex,
                    $row['description']
                );
            } else {
                $key        = 'files';
                $subKey     = $row['extension'];
                $mimeTypes  = array_key_exists('mime-type', $row) ? (array) $row['mime-type'] : array();
                $extension  = $isRegex ? "/{$row['extension']}/" : $row['extension'];
                $definition = new FileDefinition(
                    $extension,
                    $isRegex,
                    $row['description'],
                    $mimeTypes
                );
            }

            $this->definitions[$key][$type][$subKey] = $definition;
        }
    }

    public function __construct($path, $level = self::BASIC)
    {
        $this->load($path, $level);
    }

    public function getDefinitionByDirectoryName($name)
    {
        if (!array_key_exists($name, $this->definitions['directories']['plain'])) {
            return false;
        }

        foreach ($this->definitions['directories']['regex'] as $definition) {
            if (preg_match($definition->getName(), $name)) {
                return $definition;
            }
        }

        return $this->definitions['directories']['plain'][$name];
    }

    public function getDefinitionByExtension($extension)
    {
        if (array_key_exists($extension, $this->definitions['files']['plain'])) {
            return $this->definitions['files']['plain'][$extension];
        }

        foreach ($this->definitions['files']['regex'] as $definition) {
            if (preg_match($definition->getExtension(), $extension)) {
                return $definition;
            }
        }

        return false;
    }
}