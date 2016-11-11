<?php
namespace App\Providers;
use App\Observers\AddressObserver;
use App\Address;
use Illuminate\Support\ServiceProvider;
class AddressServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Address::observe($this->app->make(AddressObserver::class));
    }

    public function register()
    {
        $this->app->singleton(AddressObserver::class, function()
        {
            return new AddressObserver();
        });
    }
}
?>