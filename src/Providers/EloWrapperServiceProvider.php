<?php

namespace EloWrapper\Providers;

use EloWrapper\Console\ModelCommand;
use Illuminate\Support\ServiceProvider;
use EloWrapper\Console\GenerateCommand;
use EloWrapper\Generators\ModelGenerator;
use EloWrapper\Generators\WrapperGenerator;


class EloWrapperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('wrapper.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }

    /**
     * Register the commands.
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->registerModelCommand();
        $this->registerGenerateCommand();
        $this->commands('command.elo_wrapper.model','command.elo_wrapper.generate');
    }

    /**
     * Register the 'wrapper:model' command.
     *
     * @return void
     */
    protected function registerModelCommand()
    {
        $this->app->singleton('command.elo_wrapper.model', function($app) {
            $modeler  = new ModelGenerator($app['files']);

            return new ModelCommand($modeler);
        });
    }

    /**
     * Register the 'wrapper:generate' command.
     *
     * @return void
     */
    protected function registerGenerateCommand()
    {
        $this->app->singleton('command.elo_wrapper.generate', function($app) {
            $generator = new WrapperGenerator($app['files']);

            return new GenerateCommand($generator);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.elo_wrapper.model','command.elo_wrapper.generate'];
    }
}
