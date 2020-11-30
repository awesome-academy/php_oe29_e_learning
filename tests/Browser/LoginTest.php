<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_login_view()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertTitle(config('app.name'))
                ->assertSeeLink(trans('label.register_now'))
                ->assertSeeLink(trans('label.forget_password'))
                ->assertSeeIn('.body-auth', trans('label.auth'))
                ->assertSeeIn('.body-auth', trans('label.f8_auth_title'))
                ->assertSeeIn('.body-auth', trans('label.f8_auth_facebook'))
                ->assertSeeIn('.body-auth', trans('label.f8_auth_google'))
                ->assertSeeIn('.body-auth', trans('label.f8_auth_tips'))
                ->assertSeeIn('.body-auth', trans('label.or'))
                ->assertSeeIn('.body-auth', trans('label.email'))
                ->assertSeeIn('.body-auth', trans('label.password'))
                ->assertSeeIn('.body-auth', trans('label.login'))
                ->assertSeeIn('.body-auth', trans('label.new_account'));
        });
    }

    public function test_click_register_link()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->clickLink(trans('label.register_now'))
                ->assertPathIs('/register');
        });
    }

    public function test_click_forgot_password_link()
    {
        $this->browse(function ($browser){
            $browser->visit('/login')
                ->press('.auth-link')
                ->assertPathIs('/password/reset');
        });
    }

    public function test_user_login_fail()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'emailnotexist@gmail.com')
                    ->type('password', 'hiphopneverdie')
                    ->press('.auth-btn-submit')
                    ->assertPathIs('/login');
        });
    }

    public function test_user_login_as_admin()
    {
        $user = factory(User::class)->create([
            'role_id' => config('role.admin_id'),
            'status' => config('status.user.active_number'),
        ]);
        $this->browse(function ($browser) use($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', '12345678')
                    ->press('.auth-btn-submit')
                    ->assertPathIs('/admin');
        });
        $user->forceDelete();
    }

    public function test_user_login_as_mentor()
    {
        $user = factory(User::class)->create([
            'role_id' => config('role.mentor_id'),
            'status' => config('status.user.active_number'),
        ]);
        $this->browse(function ($browser) use($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', '12345678')
                    ->press('.auth-btn-submit')
                    ->assertPathIs('/mentor');
        });
        $user->forceDelete();
    }

    public function test_user_login_as_student()
    {
        $user = factory(User::class)->create([
            'role_id' => config('role.student_id'),
            'status' => config('status.user.active_number'),
        ]);
        $this->browse(function ($browser) use($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', '12345678')
                    ->press('.auth-btn-submit')
                    ->assertPathIs('/home');
        });
        $user->forceDelete();
    }
}
