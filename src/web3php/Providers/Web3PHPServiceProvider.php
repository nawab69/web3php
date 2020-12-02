<?php
namespace Nawab69\Web3PHP\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class Web3PHPServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/../../config/web3.php' => config_path('web3.php'),
        ]);

        App::bind('ethereum', function() {
            return new \Nawab69\Web3PHP\Ethereum;
        });

        config([
            'config/web3.php',
        ]);
    }
}
