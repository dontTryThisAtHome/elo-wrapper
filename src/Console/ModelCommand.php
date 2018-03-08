<?php

namespace EloWrapper\Console;

use Illuminate\Console\Command;
use EloWrapper\Generators\ModelGenerator;
use Symfony\Component\Console\Input\InputArgument;

class ModelCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'wrapper:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffolds a new model suitable for EloWrapper.';

    /**
     * Model generator instance.
     *
     * @var EloWrapper\Generators\ModelGenerator
     */
    protected $modeler;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ModelGenerator $modeler)
    {
        parent::__construct();

        $this->modeler  = $modeler;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $name = $this->input->getArgument('name');

        $this->writeModel($name);

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
                'Name to use for the scaffolding of the model.'
            ]
        ];
    }

    /**
     * Write the model file to disk.
     *
     * @param  string  $name
     * @return string
     */
    protected function writeModel($name)
    {
        $output = pathinfo($this->modeler->create($name, $this->getModelsPath()), PATHINFO_FILENAME);

        $this->line("      <fg=green;options=bold>create</fg=green;options=bold>  $output");
    }

    /**
     * Get the path to the models directory.
     *
     * @return string
     */
    protected function getModelsPath()
    {
        return app_path();
    }
}
