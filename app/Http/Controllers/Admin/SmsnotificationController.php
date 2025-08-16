<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Smsnotification;
use Illuminate\Http\Request;

/**
 * Class SmsnotificationController
 * @package App\Http\Controllers
 */
class SmsnotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.smsnotificacion.index')->only('index');
        $this->middleware('can:admin.smsnotificacion.edit')->only('edit', 'update');
        $this->middleware('can:admin.smsnotificacion.create')->only('create', 'store');
        $this->middleware('can:admin.smsnotificacion.show')->only('show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smsnotifications = Smsnotification::paginate();

        return view('admin.smsnotification.index', compact('smsnotifications'))
            ->with('i', (request()->input('page', 1) - 1) * $smsnotifications->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $smsnotification = new Smsnotification();
        return view('admin.smsnotification.create', compact('smsnotification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Smsnotification::$rules);

        $smsnotification = Smsnotification::create($request->all());

        return redirect()->route('smsnotifications.index')
            ->with('success', 'Smsnotification created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $smsnotification = Smsnotification::find($id);

        return view('admin.smsnotification.show', compact('smsnotification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $smsnotification = Smsnotification::find($id);

        return view('admin.smsnotification.edit', compact('smsnotification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Smsnotification $smsnotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Smsnotification $smsnotification)
    {
        request()->validate(Smsnotification::$rules);

        $smsnotification->update($request->all());

        return redirect()->route('smsnotifications.index')
            ->with('success', 'Smsnotification updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $smsnotification = Smsnotification::find($id)->delete();

        return redirect()->route('smsnotifications.index')
            ->with('success', 'Smsnotification deleted successfully');
    }

    public function new_notifications_index()
    {
        
        $apiKey = env('SMS_API_KEY');

        $request = json_encode([
            "api_key" => $apiKey
        ]);
        
        $headers = ['Content-Type: application/json'];            
        
        $ch = curl_init('https://api.gateway360.com/api/3.0/account/get-balance');
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        
        $result = curl_exec($ch);
        
        // Verificar si hubo un error en la solicitud cURL
        if (!curl_errno($ch)) {
            $response = json_decode($result, true); // Convertir a array asociativo
            
            // Validar si el "status" es "ok"
            $statusResult = (isset($response['status']) && $response['status'] === 'ok') ? 'ok' : 'error';
        } else {
            $statusResult = 'error';
        }
        
        curl_close($ch);
        
        // Obtener los últimos 100 registros, ordenados de manera descendente por 'created_at' y paginados de 10 en 10
        $smsnotifications = Smsnotification::orderBy('created_at', 'desc')->take(100)->paginate(10);

        // Contar respuestas exitosas ("ok")
        $totalEnviados = Smsnotification::where('respuesta', 'ok')->count();

        // Contar respuestas con error
        $totalErrores = Smsnotification::where('respuesta', 'error')->count();

        // Pasar los datos a la vista
        return view('admin.new.notifications', compact('smsnotifications', 'totalEnviados', 'totalErrores', 'statusResult'));

            }
}
