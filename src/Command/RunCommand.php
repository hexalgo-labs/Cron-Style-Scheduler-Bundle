<?php

namespace Hexalgo\CronStyleSchedulerBundle\Command;

use Hexalgo\CronStyleSchedulerBundle\Services\CronCommandScheduler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command
{
    protected static $defaultName = 'cron:run';

    private $commandScheduler;

    public function __construct(CronCommandScheduler $commandScheduler)
    {
        parent::__construct();

        $this->commandScheduler = $commandScheduler;
    }

    protected function configure()
    {
        $this->setDescription('Start all the commands which is due at the time of the execution of the command. The commands will be started in background. Your will not get the output in this command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $commands = $this->getApplication()->all();

        $count = 0;
        foreach ($commands as $name => $command){
            if($this->commandScheduler->testAndRun($command, $name)){
                $count++;
                $output->writeln(sprintf('Command <info>%s</info> started', $name));
            }
        }

        $output->writeln(sprintf('<info>%d</info> commands started', $count));

        return 1;
    }
}