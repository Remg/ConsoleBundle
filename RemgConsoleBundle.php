<?php

namespace Remg\ConsoleBundle;

use Remg\ConsoleBundle\DependencyInjection\Compiler\QuestionTypePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RemgConsoleBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new QuestionTypePass());
    }
}
