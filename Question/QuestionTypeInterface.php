<?php

namespace Remg\ConsoleBundle\Question;

interface QuestionTypeInterface
{
    /**
     * Returns the question text.
     *
     * @param mixed $data The context of the question.
     *
     * @return string
     */
    public function getText($data);

    /**
     * Returns the default answer of the question.
     *
     * @param mixed $data The context of the question.
     *
     * @return mixed
     */
    public function getDefault($data);

    /**
     * Returns the normalizer of the question.
     *
     * The normalizer can ba a callable (a string), a closure or a class 
     * implementing __invoke.
     *
     * @param mixed $data The context of the question.
     *
     * @return mixed
     */
    public function getNormalizer($data);

    /**
     * Returns the validator of the question.
     *
     * The validator can ba a callable (a string), a closure or a class 
     * implementing __invoke.
     *
     * @param mixed $data The context of the question.
     *
     * @return mixed|null
     */
    public function getValidator($data);

    /**
     * Gets the maximum number of attempts.
     * 
     * Null means an unlimited number of attempts.
     *
     * @param mixed $data The context of the question.
     *
     * @return integer|null
     */
    public function getMaxAttempts($data);

    /**
     * Builds and returns the Question instance of this type.
     *
     * @param mixed $data The context of the question.
     *
     * @return Question
     */
    public function buildQuestion($data);

    /**
     * Handles the answer in its context after normalisation and validation.
     *
     * @param mixed $answer The answer provided by the user (after validation).
     * @param mixed $data   The context of the question.
     *
     * @return void
     */
    public function handleAnswer($answer, $data);
}