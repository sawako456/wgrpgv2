<?php namespace Cryptic\Wgrpg\Http\Controllers\Admin;

use Cryptic\Wgrpg\Contracts\Services\User\Service as UserServiceContract;
use Cryptic\Wgrpg\Http\Controllers\Controller;
use Cryptic\Wgrpg\Http\Requests\Admin\User\StoreRequest;
use Cryptic\Wgrpg\Http\Requests\Admin\User\UpdateRequest as UserUpdateRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\View\Factory as View;
use Illuminate\Http\Request as Input;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\MessageBag;
use Illuminate\Translation\Translator;

class UserController extends Controller
{
    /**
     * @var \Cryptic\Wgrpg\Contracts\Services\User\Service
     */
    protected $userService;

    /**
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * @var \Illuminate\Translation\Translator
     */
    protected $lang;

    /**
     * Construct a new instance of the controller.
     *
     * @param \Cryptic\Wgrpg\Contracts\Services\User\Service $userService
     * @param \Illuminate\Contracts\View\Factory             $view
     * @param \Illuminate\Translation\Translator             $lang
     *
     * @return void
     */
    public function __construct(UserServiceContract $userService, View $view,
        Translator $lang)
    {
        $this->middleware('auth');
        $this->middleware('admin');

        $this->userService = $userService;
        $this->view = $view;
        $this->lang = $lang;
    }

    /**
     * Display a listing of the users.
     *
     * @param \Illuminate\Http\Request                $input
     * @param \Illuminate\Contracts\Config\Repository $config
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Input $input, Config $config)
    {
        $page = $input->get('page', 1);
        $limit = $config->get('pagination.admin.users', 8);
        $entities = $this->userService->getByPage($page, $limit, ['roles'], null,
            null, null, true);
        $options = ['path' => Paginator::resolveCurrentPath()];
        $users = new Paginator($entities->items, $entities->totalItems, $limit,
            null, $options);

        return $this->view->make('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = $this->userService->roles();

        return $this->view->make('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param \Cryptic\Wgrpg\Http\Requests\Admin\User\StoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['username', 'email', 'password', 'roles']);
        $roles = array_get($input, 'roles', []);

        $user = $this->userService->createUser($input, $roles);

        return redirect()->route('admin.users.show', [$user->id])
            ->with('messages', new MessageBag([
                $this->lang->get('messages.message.user.created', [
                    'name' => $user->username,
                ]),
            ]));
    }

    /**
     * Display the specified user.
     *
     * @param int                              $id
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id, Guard $auth)
    {
        if ($id == $auth->id()) {
            return redirect()->route('admin.profile.edit');
        }

        $user = $this->userService->findOrFail($id, ['roles'], true);

        return $this->view->make('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = $this->userService->findOrFail($id);
        $roles = $this->userService->roles();

        return $this->view->make('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param int                                                   $id
     * @param \Cryptic\Wgrpg\Http\Requests\Admin\User\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UserUpdateRequest $request)
    {
        $user = $this->userService->findOrFail($id);
        $input = $request->only(['username', 'email', 'roles', 'created_at',
            'updated_at', 'last_login_at', 'logins', ]);
        $roles = array_pull($input, 'roles', []);

        $user->fill($input);
        $this->userService->save($user);
        $this->userService->syncRoles($user, $roles);

        return redirect()->route('admin.users.show', [$user->id])
            ->with('messages', new MessageBag([
                $this->lang->get('messages.message.user.updated', [
                    'name' => $user->username,
                ]),
            ]));
    }

    /**
     * Restore the specified user from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $user = $this->userService->findOrFail($id, [], true); // Gotta check the trash lol

        $this->userService->restore($user);

        return redirect()->route('admin.users')
            ->with('messages', new MessageBag([
                $this->lang->get('messages.message.user.restored', [
                    'name' => $user->username,
                ]),
            ]));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = $this->userService->findOrFail($id);

        $this->userService->delete($user);

        return redirect()->route('admin.users')
            ->with('messages', new MessageBag([
                $this->lang->get('messages.message.user.deleted', [
                    'name' => $user->username,
                ]),
            ]));
    }
}
