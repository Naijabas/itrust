<?php

namespace App\Providers;

use Hizbul\SmsVerification\SmsVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class SMSVerificationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->registerResources();
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register resources.
     *
     * @return void
     */
    public function registerResources()
    {
        if ($this->isLumen() === false) {
            $this->publishes([
                __DIR__ . '/../config/sms-verification.php' => config_path('sms-verification.php'),
            ], 'config');
        }
    }
    /**
     * Check if package is running under Lumen app
     *
     * @return bool
     */
    protected function isLumen(): bool
    {
        return Str::contains($this->app->version(), 'Lumen') === true;
    }
    /**
     * Register endpoints in routing
     * @param $router
     */
    public static function registerRoutes($router)
    {
        $router->post('/sms-verification', function (Request $request) {
            return response()->json(SmsVerification::sendCode($request->input('phone_number')));
        });
        $router->get('/sms-verification/{code}/{number}', function ($code, $phoneNumber) {
            return response()->json(SmsVerification::checkCode($code, $phoneNumber));
        });
    }
}
