# Cron Style Scheduler Bundle

This bundle allow you to manage your automated command execution directly on your Symfony command with an annotation.

## Install the bundle

To install this bundle you need to do two things:
* Add the dependency in your project with composer
* Add an entry in crontab to launch the main command every minute

### Install the dependency
You can install the bundle via composer this command

``
composer require hexalgo-labs/cron-style-scheduler-bundle
``

### Add an entry in crontab
Add the following line in crontab

`* * * * * php /path/to/your/project/bin/console cron:run >> /dev/null 2>&1`

This command will be executed every minute, and will check if there is command which is due and launch it

### How to use it

On your Symfony command, add the annotation CronCommand with the cron expression on the class.

For example:

```php
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hexalgo\CronStyleSchedulerBundle\Annotation\CronCommand;

/**
 * @CronCommand("30 * * * *")
 */
class MyTestCommand extends Command
{
  public static $defaultName = 'app:test-command';

  protected function execute(InputInterface $input, OutputInterface $output) : int
  {
      return 1;
  }
}
```
This command will be executed every 30 minutes.

To help you to create the cron expression you can use <https://crontab.guru>.

## Note for Windows user
When using this bundle with Windows, the command will not be executed in background when you start the command cron:run.
The command will wait until all the launched commands are executed completely before finishing.  

## Hexalgo
We are a french agency specialized in Symfony applications for business. 

## TO DO
* Add command log
* Send email / notification after command completion (fail or success)
* Write tests