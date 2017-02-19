<?php

namespace Remg\ConsoleBundle\Style;

use Remg\ConsoleBundle\Question\QuestionRegistry;
use Symfony\Component\Console\Style\StyleInterface as BaseInterface;

interface StyleInterface extends BaseInterface
{
    /**
     * @param QuestionRegistry $questionRegistry 
     */
    public function setQuestionRegistry(QuestionRegistry $questionRegistry);

    /**
     * Creates Question instance and asks it to the user.
     *
     * @param string $type The name of the question type (fully qualified class name or service id)
     * @param mixed  $data The context of the question
     *
     * @return mixed
     */
    public function interact($type, $data = null);
}