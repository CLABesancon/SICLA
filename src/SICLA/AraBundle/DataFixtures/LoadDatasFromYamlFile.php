<?php
namespace SICLA\AraBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;
 
use Symfony\Component\Yaml\Parser;
 
abstract class LoadDatasFromYamlFile extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * Loads datas from a fixture file from doctrine 1
     * 
     * @param string $file file name
     * @return array
     */
    final protected function loadFromFile($file) {
        $yaml = new Parser;
        return $yaml->parse(file_get_contents(__DIR__ . '/YML/' . $file . '.yml'));
    }
}

