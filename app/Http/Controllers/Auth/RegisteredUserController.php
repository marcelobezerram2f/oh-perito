<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function update(Request $request)
    {

        try {
            $user = auth()->user();
            $data = $request->all();

            $user->name = $data['name'];
            $user->email = $data['email'];

            if (!is_null($data['delete_avatar'])) {
                $user->avatar = null;
            }
            if (!is_null($data['new_password'])) {
                if ($data['new_password'] != $data['re_password']) {
                    return response()->json(['message' => 'As senhas digitadas não coincidem.'], 400);
                } else {
                    $user->password = Hash::make($data['new_password']);
                }
            }
            if (!empty($data['avatar'])) {
                $request->validate([
                    'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                if ($request->hasFile('avatar')) {
                    // Garante que a pasta exista
                    $path = public_path('media/avatars/');
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    // Nome único para o arquivo
                    $fileName = time() . '_' . uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();
                    // Move o arquivo para public/media/avatars
                    $request->file('avatar')->move($path, $fileName);
                    // Caso queira salvar no banco (ex: no usuário logado)
                    $user->avatar = 'media/avatars/'.$fileName;
                }
            }
            $user->save();
            return response()->json(['message'=>'Dados atualizados com sucesso'], 200);
        } catch(Exception $e){
            return response()->json(['message'=>'Falha fatal ao atualizar dados.', 'erro'=>$e->getMessage()], 400);
            }

    }
}
