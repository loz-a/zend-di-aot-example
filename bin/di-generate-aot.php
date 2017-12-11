<?php

namespace AppAoT;

use Psr\Container\ContainerInterface;
use Zend\Code\Scanner\DirectoryScanner;
use Zend\Di\CodeGenerator\InjectorGenerator;
use Zend\Di\Config;

require __DIR__ . '/../vendor/autoload.php';

// Define the source directories to scan for classes to generate
// AoT factories for
$directories = [
    __DIR__ . '/../src/App/src',
];

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';
$scanner = new DirectoryScanner($directories);
$generator = $container->get(InjectorGenerator::class);

$generator->generate($scanner->getClassNames());
