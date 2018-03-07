<?php

namespace EloWrapper\Providers;

use EloWrapper\Commands\ModelCommand;
use Illuminate\Support\ServiceProvider;
use EloWrapper\Generators\ModelGenerator;

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
        $this->commands('command.elo_wrapper.model');
    }

    /**
     * Register the 'wrapper:model' command.
     *
     * @return void
     */
    protected function registerInstallCommand()
    {
        $this->app->singleton('command.elo_wrapper.model', function($app) {
            $modeler  = new ModelGenerator($app['files']);

            return new RecordCommand($modeler);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.elo_wrapper.model'];
    }
}
