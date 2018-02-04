<?php
namespace Iwanli\Wxxcx;

use Illuminate\Support\ServiceProvider;

class WxxcxServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (function_exists('config_path')) {
            $publishPath = config_path('wxxcx.php');
        } else {
            $publishPath = base_path('config/wxxcx.php');
        }

        $this->mergeConfigFrom($publishPath, 'wxxcx');

        $this->publishes([
            __DIR__ . '/../config/wxxcx.php' => $publishPath,
        ], 'wxxcx');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('wxxcx', function ()
        {
            return new Wxxcx();
        });

        $this->app->alias('wxxcx', Wxxcx::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['wxxcx', Wxxcx::class];
    }
}
