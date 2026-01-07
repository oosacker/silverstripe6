<?php

namespace App\Tasks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\PolyExecution\PolyOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

class MyExampleTask extends BuildTask
{
  protected static string $commandName = 'my-example-task';

  protected string $title = 'My Example Task';

  protected static string $description = 'Does something useful with your data';

  protected function execute(InputInterface $input, PolyOutput $output): int
  {
    // Check for options
    if ($input->getOption('dry-run')) {
      $output->writeln('Running in dry-run mode...');
    }

    // Do your task work here
    $output->writeln('Processing records...');

    // Use different output styles
    $output->writeln('<info>This is informational</info>');
    $output->writeln('<warning>This is a warning</warning>');
    $output->writeln('<error>This is an error</error>');

    // Return success or failure
    return Command::SUCCESS;
    // Or: return Command::FAILURE;
  }

  public function getOptions(): array
  {
    return [
      new InputOption(
        'dry-run',
        'd',
        InputOption::VALUE_NONE,
        'Run without making changes'
      ),
      new InputOption(
        'limit',
        'l',
        InputOption::VALUE_REQUIRED,
        'Limit number of records to process',
        100 // default value
      ),
    ];
  }
}
