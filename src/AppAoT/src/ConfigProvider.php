<?php

namespace AppAoT;

use Zend\Di\InjectorInterface;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    private function getGeneratedFactories()
    {
        if (file_exists(__DIR__ . '/../gen/factories.php')) {
            return include __DIR__ . '/../gen/factories.php';
        }

        return [];
    }

    public function getDependencies()
    {
        return [
            'auto' => [
                'aot' => [
                    'namespace' => __NAMESPACE__ . '\\Generated',
                    'directory' => __DIR__ . '/../gen',
                ],
            ],

            'factories' => $this->getGeneratedFactories(),
            'delegators' => [
                InjectorInterface::class => [
                    InjectorDecoratorFactory::class,
                ],
            ],
        ];
    }
}
