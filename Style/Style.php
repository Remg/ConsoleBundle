<?php

namespace Remg\ConsoleBundle\Style;

use Remg\ConsoleBundle\Question\QuestionRegistry;
use Remg\ConsoleBundle\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Style extends SymfonyStyle implements StyleInterface
{
    /**
     * @var QuestionRegistry
     */
    private $questionRegistry;

    /**
     * {@inheritdoc}
     */
    public function setQuestionRegistry(QuestionRegistry $questionRegistry)
    {
        $this->questionRegistry = $questionRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function interact($type, $data = null)
    {
        // find question type
        $type = $this->questionRegistry->getType($type, $data);

        // build question from type
        $question = $type->buildQuestion($data);

        // interact with the user
        $answer = $this->askQuestion($question);

        // handle the answer on the given data
        $type->handleAnswer($answer, $data);

        return $answer;
    }
}