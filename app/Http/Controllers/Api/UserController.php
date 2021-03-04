<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

use App\Models\user;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();

        return response()->json([
            "success" => true,
            "message" => "Usuarios listados",
            "data" => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'DNI' => ['required', 'numeric', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails())
        {
            return response()->json([
                "success" => false,
                "message" => $validator->messages(),
                "data" => null
            ]);

        } else {
            //Instancia del nuevo usuario
            $user = new User;

            //Asigmaos sus respectivos datos
            $user->DNI = $request['DNI'];
            $user->username = $request['DNI'];
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);

            //Comprobamos que hayan roles para asignar
            if(isset($request['role'])){
                //La variable roles tendra un array de objetos de los roles seleccionados
                $roles = $request['role'];

                // Recorremos el array de roles y almacenamos su valor id
                // en el array $rol_array
                $rol_array = []; // Esta variable tendra los datos de los roles que se le vayan a asigna
                foreach ($roles as $key => $rol) {
                    foreach ($rol as $key => $value) {
                        $rol_id = [];
                        if ($key == 'id') {
                            $rol_id = Role::find($value); //Buscanmos el rol
                            array_push($rol_array, $rol_id); // Guardamos el rol en la variable array_roles
                        }
                    }
                }
                // Le asignamos los roles del array array_roles al suario
                $user->syncRoles($rol_array);
            }
            $user->save();

            return response()->json([
                "success" => true,
                "message" => "Usuario creado satisfactoriamente",
                "data" => $user
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return response()->json([
            "Success" => true,
            "message" => "Usuarios listado",
            "data" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (User::where('id', $id)->exists()) {

            $user = User::find($id);

            $validator = Validator::make($request->all(), [
                'DNI' => ['required', 'numeric',
                    Rule::unique('users')->ignore($user->id)],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'password' => isset($request['password']) ? [] : ['required', 'string', 'min:6'],
            ]);

            if ($validator->fails())
            {
                return response()->json([
                    "success" => false,
                    "message" => $validator->messages(),
                    "data" => null
                ]);
            }
            else
            {
                $user->DNI = $request['DNI'];
                $user->username = $request['DNI'];
                $user->first_name = $request['first_name'];
                $user->last_name = $request['last_name'];
                $user->email = $request['email'];

                //Comprobamos que exista la contraseña
                if(isset($request['password'])){
                    $user->password = Hash::make($request['password']);
                }

                    //Comprobamos que hayan roles para asignar
                if(isset($request['role'])){
                    //La variable roles tendra un array de objetos de los roles seleccionados
                    $roles = $request['role'];

                    // Recorremos el array de roles y almacenamos su valor id
                    // en el array $rol_array
                    $rol_array = []; // Esta variable tendra los datos de los roles que se le vayan a asigna
                    foreach ($roles as $key => $rol) {
                        foreach ($rol as $key => $value) {
                            $rol_id = [];
                            if ($key == 'id') {
                                $rol_id = Role::find($value); //Buscanmos el rol
                                array_push($rol_array, $rol_id); // Guardamos el rol en la variable array_roles
                            }
                        }
                    }
                    // Le asignamos los roles del array array_roles al suario
                    $user->syncRoles($rol_array);
                }
                $user->save();
                return response()->json([
                    "success" => true,
                    "message" => "Usuario actualizaddo satisfactoriamente",
                    "data" => $user
                ]);
            }

        } else {
            return response()->json([
                "success" => false,
                "message" => "No se encontro el usuario",
                "data" => null
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();
            return response()->json([
                "success" => true,
                "message" => "Usuario eliminado satisfactoriamente",
                "data" => $user
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "No se encontro el usuario",
                "data" => null
            ]);

        }
    }
}
