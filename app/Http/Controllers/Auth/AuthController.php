<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Allowed email address endings for auth.
     *
     * @var array
     */
    protected $allowedEmailEndings = [
        '@digital.justice.gov.uk',
    ];

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')
            ->scopes(['email'])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        if ($request->input('error') == 'access_denied') {
            return redirect()->route('login')
                ->withErrors([
                    'socialite' => "Please choose 'Allow' at the prompt to login",
                ]);
        }

        $socialUser = Socialite::driver('google')->user();
        $email = $socialUser->getEmail();

        if (!$this->validateEmailAddress($email)) {
            return redirect()->route('login')
                ->withErrors([
                    'socialite' => $this->invalidEmailMessage(),
                ]);
        }

        // Check if user already exists in the database
        $user = User::where('email', $email)
            ->first();

        // If not, create them
        if (is_null($user)) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
            ]);
        }

        // Authenticate and redirect
        Auth::login($user);
        return redirect($this->redirectPath());
    }

    /**
     * Validate that the user is logging in with a valid email address.
     *
     * @param string $email
     * @return bool
     */
    public function validateEmailAddress($email) {
        return ends_with($email, $this->allowedEmailEndings);
    }

    /**
     * Error message shown when logging in with an invalid email address.
     *
     * @return string
     */
    public function invalidEmailMessage() {
        return 'To use this service, your email address must end with ' .
            implode(', ', $this->allowedEmailEndings);
    }
}
