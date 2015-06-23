<?php
namespace NZTim\Mailchimp;

use Illuminate\Support\ServiceProvider;
use NZTim\Mailchimp\Mailchimp;

class MailchimpServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->app->bind(Mailchimp::class, function() {
            $apikey = env('MC_KEY');
            $dc = env('MC_DC');
            return new Mailchimp($apikey, $dc);
        });
    }

    public function register()
    {
        $this->app->bind('mailchimp', function() {
            return $this->app->make(Mailchimp::class);
        });
    }
}
