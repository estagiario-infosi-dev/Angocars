<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users= User::orderBy('id', 'DESC')->get();
        $users = User::all();
        return view('_admin.users.list.index', compact('users'));
    }

    public function create()
    {
        return view('_admin.users.create.index');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => [
            'required',
            'confirmed',
            'min:8',
            'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
        ],
        'role'     => 'required|in:admin,financial,employee',
    ], [
        'password.regex' => 'A senha deve ter no mínimo 8 caracteres, incluindo: 1 letra maiúscula, 1 número e 1 carácter especial (!@#$%^&* etc.).'
    ]);

    $validated['password'] = Hash::make($validated['password']);

    User::create($validated);

    return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
}

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('_admin.users.details.index', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('_admin.users.edit.index', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $rules = [
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role'  => 'required|in:admin,financial,employee',
        'password' => [
            'nullable',
            'confirmed',
            'min:8',
            'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
        ],
    ];

    $messages = [
        'password.regex' => 'A nova senha deve ter no mínimo 8 caracteres, incluindo: 1 letra maiúscula, 1 número e 1 carácter especial (!@#$%^&* etc.).'
    ];

    $validated = $request->validate($rules, $messages);

    if (!empty($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // (Opcional: prevenir excluir admin principal)
        if ($user->role === 'admin' && $user->id === 2) {
            return redirect()->route('users.index')->with('error', 'Não é possível remover o administrador principal!');
            
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário removido com sucesso!');
        return redirect()->back()->with('error', 'Erro ao remover o usuário. Tente novamente.');
    }
}
