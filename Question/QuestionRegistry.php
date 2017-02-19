<?php

namespace Remg\ConsoleBundle\Question;

use Remg\ConsoleBundle\Question\QuestionTypeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class QuestionRegistry
{
    private $container;
    private $serviceIds;

    public function __construct(ContainerInterface $container, array $serviceIds)
    {
        $this->container = $container;
        $this->serviceIds = $serviceIds;
    }

    public function getType($name)
    {
        $type = null;

        // check in service tagged 'question.type'
        foreach ($this->serviceIds as $class => $serviceId) {
            // if the name is the service class name
            // or the name is the service id
            if ($class === $name || $serviceId === $name) {
                // retrieve the type by id
                $type = $this->container->get($serviceId);
                break;
            }
        }

        // Support fully qualified class names
        if (null === $type && class_exists($name)) {
            $type = new $name();
        }

        // check the type if found
        if (null !== $type) {
            if (!$type instanceof QuestionTypeInterface) {
                throw new \InvalidArgumentException(sprintf(
                    'Question type "%s" must implement %s.',
                    get_class($type),
                    QuestionTypeInterface::class
                ));
            }

            return $type;
        }

        // the question type can not be retrieved
        throw new \InvalidArgumentException(sprintf('Could not load question type "%s".', $name));
    }

    public function hasType($name)
    {
        try {
            $this->getType($name);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
