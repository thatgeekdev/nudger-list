<?php

namespace App\Http\Controllers\ApiConsumer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TaskApiController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.nudger_api.base_uri');
    }

    private function withToken()
    {
        return Http::withToken(Session::get('api_token'));
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::post("{$this->baseUrl}/api/login", $request->only('email', 'password'));
        if ($response->successful()) {
            Session::put('api_token', $response['token']);
            return redirect()->route('tasks.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        $this->withToken()->post("{$this->baseUrl}/api/logout");
        Session::forget('api_token');

        return redirect()->route('login.form');
    }

    public function index()
    {
        $response = $this->withToken()->get("{$this->baseUrl}/api/tasks");
        if ($response->successful()) {
            return view('tasks.index', ['tasks' => $response->json()]);
        }

        abort(403, 'Unauthorized');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $response = $this->withToken()->post("{$this->baseUrl}/api/tasks", $request->only('title', 'description'));

        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $response = $this->withToken()->get("{$this->baseUrl}/api/tasks/{$id}");

        if ($response->successful()) {
            return view('tasks.show', ['task' => $response->json()]);
        }

        abort(404);
    }

    public function edit($id)
    {
        $task = $this->withToken()->get("{$this->baseUrl}/api/tasks/{$id}")->json();
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $this->withToken()->put("{$this->baseUrl}/api/tasks/{$id}", $request->only('title', 'description', 'status'));

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $this->withToken()->delete("{$this->baseUrl}/api/tasks/{$id}");

        return redirect()->route('tasks.index');
    }

    public function filterByStatus(string $status)
    {
        $response = $this->withToken()->get("{$this->baseUrl}/api/tasks/status/{$status}");

        if ($response->successful()) {
            return view('tasks.index', ['tasks' => $response->json()]);
        }

        abort(404);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $response = $this->withToken()->get("{$this->baseUrl}/api/search/tasks/{$query}");

        if ($response->successful()) {
            return view('tasks.index', ['tasks' => $response->json()['data']]);
        }

        abort(404);
    }

    public function trashed()
    {
        $response = $this->withToken()->get("{$this->baseUrl}/api/trashed/tasks");

        if ($response->successful()) {
            return view('tasks.trashed', ['tasks' => $response->json()]);
        }

        abort(403);
    }

    public function restore($id)
    {
        $this->withToken()->patch("{$this->baseUrl}/api/tasks/{$id}/restore");

        return redirect()->route('tasks.trashed');
    }

    public function forceDelete($id)
    {
        $this->withToken()->delete("{$this->baseUrl}/api/tasks/{$id}/force");

        return redirect()->route('tasks.trashed');
    }
}
