<?php

namespace Hexalgo\CronStyleSchedulerBundle\Annotation;

/**
 * Annotation class for @CronCommand()
 *
 * @Annotation
 * @Target({"CLASS"})
 *
 *
 */
class CronCommand
{
    /** @var string */
    public $value;

    /** @var string */
    public $expression;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     */
    public function setExpression(string $expression)
    {
        $this->expression = $expression;
    }
}