<?php

namespace Remg\ConsoleBundle\Question;

use Remg\ConsoleBundle\Question\AbstractType;
use Symfony\Component\Console\Question\ConfirmationQuestion;

abstract class AbstractConfirmationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildQuestion($data)
    {
        $text = $this->getText($data);
        $default = $this->getDefault($data);

        $question = new ConfirmationQuestion($text, $default);

        return $question;
    }
}