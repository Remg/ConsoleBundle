<?php

namespace Remg\ConsoleBundle\Question;

use Remg\ConsoleBundle\Question\QuestionTypeInterface;

interface ChoiceQuestionTypeInterface extends QuestionTypeInterface
{
    /**
     * Returns the question text.
     *
     * @return array
     */
    public function getChoices($data);
}