<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Jenssegers\Agent\Agent; // Import Agent for Laravel Mobile-Detect integration

use function Ramsey\Uuid\v1;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        /* Fortify::registerView(function (){
            return view(view: 'auth.register');
        }); */

        Fortify::registerView(function () {
            if ($this->isMobileDevice()) {
                return view('mobile.auth.register');
            } else {
                return view('auth.register');
            }
        });

        /* Fortify::loginView(function (){
            return view(view: 'auth.login');
        }); */

        Fortify::loginView(function () {
            if ($this->isMobileDevice()) {
                return view('mobile.auth.login');
            } else {
                return view('auth.login');
            }
        });

        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-pass', ['request' => $request]);
        });

        Fortify::requestPasswordResetLinkView(function () {
            if ($this->isMobileDevice()) {
                return view('mobile.auth.forget');
            } else {
                return view('auth.forget-pass');
            }
        });

        Fortify::verifyEmailView(function (){
            return view('auth.verify-notif');
        });


        /* Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)
                ->orWhere('name', $request->email)
                ->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        }); */

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

    }

    protected function isMobileDevice()
    {
        $agent = new Agent();

        return $agent->isMobile();
    }
}
