<?php

namespace EloWrapper\Console;

use Illuminate\Console\Command;
use EloWrapper\Generators\WrapperGenerator;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCommand extends Command
{
    /**
    * The console command name.
    *
    * @var string
    */
    protected $name = 'wrapper:generate';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Scaffolds a new wrapper.';

    /**
    * Wrapper generator instance.
    *
    * @var EloWrapper\Generators\WrapperGenerator
    */
    protected $generator;

    /**
    * Create a new command instance
    *
    * @return void
    */
    public function __construct(WrapperGenerator $generator)
    {
        parent::__construct();

        $this->generator  = $generator;
    }

    /**
    * Execute the console command.
    *
    * @return void
    */
    public function fire()
    {
        $name = $this->input->getArgument('name');

        $this->writeWrapper($name);

    }

    /**
    * Get the command arguments.
    *
    * @return array
    */
    protected function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'Name to use for the scaffolding of the wrapper.'
            ]
        ];
    }

    /**
    * Write the wrapper file to disk.
    *
    * @param  string  $name
    * @return string
    */
    protected function writeWrapper($name)
    {
        $output = pathinfo($this->generator->create($name, $this->getWrappersPath()), PATHINFO_FILENAME);

        $this->line("      <fg=green;options=bold>create</fg=green;options=bold>  $output");
    }

    /**
    * Get the path to the wrappers directory.
    *
    * @return string
    */
    protected function getWrappersPath()
    {
        return $this->laravel['path.base'].'/app/Wrappers';
    }
}
