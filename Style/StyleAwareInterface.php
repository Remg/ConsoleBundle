<?php

namespace Remg\ConsoleBundle\Style;

use Remg\ConsoleBundle\Style\StyleInterface;

interface StyleAwareInterface
{
    /**
     * @param StyleInterface $style
     */
    public function setStyle(StyleInterface $style);
}
