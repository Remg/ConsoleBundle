<?php

namespace Remg\ConsoleBundle\Question;

use Remg\ConsoleBundle\Question\QuestionTypeInterface;
use Symfony\Component\Console\Question\Question;

abstract class AbstractType implements QuestionTypeInterface
{
    /**
     * Represents the default answer of the question.
     *
     * NOTE: Used for lazy-loading.
     *
     * @var mixed
     */
    protected $default;

    /**
     * {@inheritdoc}
     */
    abstract function getText($data);

    /**
     * {@inheritdoc}
     */
    public function getDefault($data)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getNormalizer($data)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidator($data)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxAttempts($data)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuestion($data)
    {
        // Get quesiton text.
        $text = $this->getText($data);

        // Get question default answer.
        $default = $this->getDefault($data);

        // Get question normalizer.
        $normalizer = $this->getNormalizer($data);

        // Get question validator.
        $validator = $this->getValidator($data);

        $maxAttempts = $this->getMaxAttempts($data);

        // Get a new Question instance with given text and default answer.
        $question = new Question($text, $default);

        // Assign the normalizer if it is callable.
        if (is_callable($normalizer)) {
            $question->setNormalizer($normalizer);
        }

        // Assign the validator if it is callable.
        if (is_callable($validator)) {
            $question->setValidator($validator);
        }

        $question->setMaxAttempts($maxAttempts);

        // Return the built question.
        return $question;
    }

    /**
     * {@inheritdoc}
     */
    public function handleAnswer($answer, $data)
    {
    }
}