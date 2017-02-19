<?php

namespace Remg\ConsoleBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds all services with the tags "question.type" as
 * arguments of the "question_registry" service.
 */
class QuestionTypePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('remg_console.question_registry')) {
            return;
        }

        // retrieve the service definition of the question registry
        $definition = $container->getDefinition('remg_console.question_registry');

        // builds an array with fully qualified type class names as keys 
        // and service IDs as values
        $questionTypes = [];

        foreach ($container->findTaggedServiceIds('question.type') as $serviceId => $tag) {
            $serviceDefinition = $container->getDefinition($serviceId);
            if (!$serviceDefinition->isPublic()) {
                throw new \InvalidArgumentException(sprintf(
                    'The service "%s" must be public as question types are lazy-loaded.',
                    $serviceId
                ));
            }

            // support type access by fully qualified class name
            $questionTypes[$serviceDefinition->getClass()] = $serviceId;
        }

        // second argument index is 1
        $definition->replaceArgument(1, $questionTypes);
    }
}
