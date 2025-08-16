<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anuncio;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class DatatableController extends Controller
{
    //
    public $user;
    public function anuncio()
    {


        $anuncios = Anuncio::all();

        return Datatables($anuncios)
            ->addColumn('id', function ($anuncios) {
                $id = $anuncios->id;
                return $id;
            })
            ->addColumn('fecha_de_publicacion', function ($anuncios) {
                $fecha_str = date('d/m/Y', strtotime($anuncios->fecha_de_publicacion));
                return $fecha_str;
            })
            ->addColumn('user', function ($anuncios) {
                $user = $anuncios->user;
                if (is_null($user)) {
                    return 'N/D';
                }
                $cl_str = "($user->id) - $user->name ";
                return $cl_str;
            })
            ->addColumn('clase', function ($anuncios) {
                $clase = $anuncios->clase;
                if (is_null($clase)) {
                    return 'N/D';
                }
                $cl_str = $clase->nombre;
                return $cl_str;
            })
            ->addColumn('nombre', function ($anuncios) {
                $nombre = $anuncios->nombre;
                return $nombre;
            })
            // ->addColumn('tipo', function ($anuncios) {
            //     $dato = $anuncios->tipo;
            //     return $dato;
            // })
            // ->addColumn('orientacion', function ($anuncios) {
            //     $dato = $anuncios->orientacion;
            //     return $dato;
            // })
            ->addColumn('categoria', function ($anuncios) {
                $categoria = $anuncios->categoria;
                if (is_null($categoria)) {
                    return 'N/D';
                }
                $cl_str = $categoria->nombre;
                return $cl_str;
            })
            ->addColumn('zona', function ($anuncios) {
                $zona = $anuncios->zone;
                if (is_null($zona)) {
                    return 'N/D';
                }
                $cl_str = $zona->nombre;
                return $cl_str;
            })
            ->addColumn('plan', function ($anuncios) {
                $plan = $anuncios->plane;
                if (is_null($plan)) {
                    return 'N/D';
                }
                $cl_str = $plan->nombre;
                return $cl_str;
            })
            ->addColumn('estado', function ($anuncios) {
                $cl_str = $anuncios->estado;
                return $cl_str;
            })
            // ->addColumn('destacado', function ($anuncios) {
            //     $cl_str = $anuncios->destacados;
            //     return $cl_str;
            // })
            ->addColumn('verificacion', function ($anuncios) {
                $cl_str = $anuncios->verificacion;
                return $cl_str;
            })
            ->addColumn('action', function ($anuncios) {
                $user = Auth()->user();
                $acciones = '';
                if ($user->can('admin.anuncios')) {
                    $acciones .= '<a class="btn btn-info btn-sm ml-4" href="' . route('admin.anuncios.show', $anuncios) . '">Mostrar Anuncio</a>';
                }
                if ($user->can('admin.anuncios')) {
                    $acciones .= '<a class="btn btn-primary btn-sm ml-4" href="' . route('admin.users.edit_anuncio', $anuncios) . ' }">Editar</a>';
                }
                //  $acciones .= '<form action="{{route(\'admin.anuncios.destroy\', $pedido)}}" method="POST" style="display: inline"> @csrf '
                // .'@method(\'delete\') '
                // .' <button type="submit" class="btn btn-danger mr-1">Eliminar</button></form>';
                return $acciones;
            })->toJson();
    }



    public function user()
    {


        $users = User::all();

        return Datatables($users)
            ->addColumn('id', function ($users) {
                $id = $users->id;
                return $id;
            })            
            ->addColumn('nombre', function ($users) {
                $cl_str = $users->name;
                return $cl_str;
            })
            ->addColumn('email', function ($users) {
                $cl_str = $users->email;
                return $cl_str;
            })
            ->addColumn('rol', function ($users) {
                $roles = $users->getRoleNames();                
                $cl_str = $roles;
                return $cl_str;
            })            
            ->addColumn('action', function ($users) {
                $user = Auth()->user();
                $acciones = '';
                if ($user->can('admin.users.show')) {
                    $acciones .= '<a class="btn btn-info btn-sm ml-4" href="' . route('admin.users.show', $users) . '">Ver/Crear Anuncio</a>';
                 $acciones .= '<a class="btn btn-success btn-sm" href="'. route('admin.users.editroles', $users) . '">Roles</a>';
                }
                if ($user->can('admin.users.edit')) {
                    $acciones .= '<a class="btn btn-primary btn-sm ml-4" href="' . route('admin.users.edit', $users) . '">Editar</a>';
                }
                 
                 $acciones .= '<a class="btn btn-danger btn-sm ml-4" href="' . route('admin.user.suplantar', $users) . '">Login como</a>';
                 return $acciones;
            })->toJson();
    }



}
