<?php

namespace Hexalgo\CronStyleSchedulerBundle\Services;

use Cocur\BackgroundProcess\BackgroundProcess;
use Cron\CronExpression;
use Doctrine\Common\Annotations\AnnotationReader;
use Hexalgo\CronStyleSchedulerBundle\Annotation\CronCommand;
use ReflectionClass;

class CronCommandScheduler
{
    private $annotationReader;

    private $projectDir;

    public function __construct(AnnotationReader $annotationReader, $projectDir){
        $this->annotationReader = $annotationReader;
        $this->projectDir = $projectDir;
    }

    /**
     * @throws \ReflectionException
     */
    public function testAndRun($command, $name)
    {
        $className = get_class($command);
        $reflexionClass = new ReflectionClass($className);
        $cronAnnotation = $this->annotationReader->getClassAnnotation($reflexionClass, CronCommand::class);

        if(empty($cronAnnotation)){
            return false;
        }

        $expression = !empty($cronAnnotation->getValue()) ? $cronAnnotation->getValue() : $cronAnnotation->getExpression();

        $cron = new CronExpression($expression);
        if($cron->isDue()){
            $console = $this->projectDir.'/bin/console';

            $cmd = 'php '.$console.' '.$name;

            $process = new BackgroundProcess($cmd);
            $process->run();

            return true;
        }

        return false;
    }
}