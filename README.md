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

## Hexalgo
We are a french agency specialized in Symfony applications for business. 

## TO DO
* Add command log