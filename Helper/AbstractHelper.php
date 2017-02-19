<?php

namespace Remg\ConsoleBundle\Helper;

use Remg\ConsoleBundle\Style\StyleInterface;
use Remg\ConsoleBundle\Style\StyleAwareInterface;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Helper\HelperSet;

abstract class AbstractHelper extends Helper implements StyleAwareInterface
{
    /**
     * @param StyleInterface $style
     */
    protected $style;

    /**
     * {@inheritdoc}
     */
    public function setStyle(StyleInterface $style)
    {
        $this->style = $style;
    }

    /**
     * Gets a helper value.
     *
     * @param string $name The helper name
     *
     * @return HelperInterface The helper instance
     *
     * @throws InvalidArgumentException If the helper is not defined.
     */
    public function getHelper($name)
    {
        return $this->getHelperSet()->get($name);
    }

    /**
     * Creates Question instance and asks it to the user.
     *
     * @param string $type    The name of the question type
     *                        (fully qualified class name or service id).
     * @param mixed  $context The context of the question.
     *
     * @return mixed
     */
    public function ask($type, $context = null)
    {
        return $this->style->interact($type, $context);
    }

    /**
     * Retrieves the StyleInterface of the helper to display/ask for
     * informations to the user.
     *
     * @return StyleInterface The StyleInterface of this helper.
     */
    public function display()
    {
        return $this->style;
    }
}