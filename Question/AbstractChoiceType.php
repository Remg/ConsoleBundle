<?php

namespace Remg\ConsoleBundle\Question;

use Remg\ConsoleBundle\Question\AbstractType;
use Remg\ConsoleBundle\Question\ChoiceQuestionTypeInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

abstract class AbstractChoiceType extends AbstractType implements ChoiceQuestionTypeInterface
{
    /**
     * Represents the possible choices of the question.
     *
     * NOTE: Used for lazy-loading.
     *
     * @var \Traversable
     */
    protected $choices;

    /**
     * {@inheritdoc}
     */
    public function buildQuestion($data)
    {
        $text = $this->getText($data);
        $choices = $this->getChoices($data);
        $default = $this->getDefault($data);
        $normalizer = $this->getNormalizer($data);
        $maxAttempts = $this->getMaxAttempts($data);

        $question = new ChoiceQuestion($text, $choices, $default);

        if ($normalizer instanceof \Closure) {
            $question->setNormalizer($normalizer);
        }

        $question->setMaxAttempts($maxAttempts);

        return $question;
    }
}