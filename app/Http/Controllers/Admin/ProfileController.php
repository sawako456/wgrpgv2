<?php namespace Cryptic\Wgrpg\Http\Controllers\Admin;

use Cryptic\Wgrpg\Contracts\Repositories\User\Repository as UserRepositoryContract;
use Cryptic\Wgrpg\Http\Controllers\Controller;
use Cryptic\Wgrpg\Http\Requests\Admin\Profile\UpdateRequest;
use DateTimeZone;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\View\Factory as View;
use Illuminate\Support\MessageBag;

class ProfileController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * @var \Cryptic\Wgrpg\Contracts\Repositories\User\Repository
     */
    protected $users;

    /**
     * Construct a new instance of the controller.
     *
     * @param \Illuminate\Contracts\Auth\Guard                      $auth
     * @param \Cryptic\Wgrpg\Contracts\Repositories\User\Repository $users
     *
     * @return void
     */
    public function __construct(Guard $auth, UserRepositoryContract $users)
    {
        $this->middleware('auth');
        $this->middleware('admin');

        $this->auth = $auth;
        $this->users = $users;
    }

    /**
     * Get the user profile edit view.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(View $view)
    {
        $user = $this->auth->user();
        $timeZones = DateTimeZone::listIdentifiers();

        return $view->make('admin.profile', compact('user', 'timeZones'));
    }

    /**
     * Update the user profile.
     *
     * @param \Cryptic\Wgrpg\Http\Requests\Admin\Profile\UpdateRequest $request
     * @param \Illuminate\Contracts\Hashing\Hasher                     $hash
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Hasher $hash)
    {
        $user = $this->auth->user();
        $email = $request->get('email');
        $password = $request->get('password');
        $timeZone = $request->get('time_zone');

        if (empty($email) && empty($password) && ($timeZone == $user->time_zone)) {
            return redirect()->route('admin.profile.edit')
                ->with('infos', new MessageBag(['Nothing was updated.']));
        }

        if (!empty($email)) {
            $user->email = $email;
        }

        if (!empty($password)) {
            $user->password = $hash->make($password);
        }

        $user->time_zone = $timeZone;

        if ($this->users->save($user)) {
            return redirect()->route('admin.profile.edit')
                ->with('messages', new MessageBag(['Your profile was updated!']));
        } else {
            return redirect()->route('admin.profile.edit')
                ->withErrors(['Failed to update user.']);
        }
    }
}
