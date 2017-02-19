<?php

namespace Remg\ConsoleBundle\Command;

use Remg\ConsoleBundle\Style\Style;
use Remg\ConsoleBundle\Style\StyleAwareInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Base class for console commands.
 *
 * @author Rémi Gardien <remi@gardien.biz>
 */
abstract class AbstractCommand extends ContainerAwareCommand
{
    /**
     * @var \Symfony\Component\Console\Style\StyleInterface
     */
    protected $style;

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        // configure command style style.
        $this->style = new Style($input, $output);
        $this->style->setQuestionRegistry($this->get('remg_console.question_registry'));

        /* @var HelperSet */
        $helperSet = $this->getHelperSet();
        // add custom helpers
        $this->addHelpers($helperSet);

        // assign command io style to helpers implementing StyleAwareInterface
        foreach ($helperSet as $name => $helper) {
            if ($helper instanceof StyleAwareInterface) {
                $helper->setStyle($this->style);
            }
        }
    }

    /**
     * Override this function to add custom helpers to the helper set.
     *
     * @param HelperSet $helperSet
     */
    protected function addHelpers(HelperSet $helperSet)
    {
    }

    /**
     * Creates Question instance and asks it to the user.
     *
     * @param string $type    The name of the question type (fully qualified class name or service id)
     * @param mixed  $context The context of the question
     *
     * @return mixed
     */
    protected function ask($type, $context = null)
    {
        return $this->style->interact($type, $context = null);
    }

    /**
     * Gets a container service by its id.
     *
     * @param string $id The service id
     *
     * @return object The service
     */
    protected function get($id)
    {
        return $this->getContainer()->get($id);
    }
}