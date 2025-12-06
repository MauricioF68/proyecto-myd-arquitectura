<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMail; // Importamos la clase de correo
use App\Models\FormularioContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Importamos la fachada de correo
use Illuminate\Support\Facades\Http;

class ContactoController extends Controller
{
    private function checkAdmin()
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $solicitudes = FormularioContacto::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.solicitudes.index', compact('solicitudes'));
    }
    public function showForm()
    {
        return view('contacto');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'tipo_solicitante' => 'required|in:persona,empresa',
            'nombre_completo' => 'required|max:255',
            'numero_celular' => 'required|max:20',
            'correo_electronico' => 'required|email|max:255',
            'mensaje' => 'required',
            'ruc' => 'nullable|max:20',
            'razon_social' => 'nullable|max:255',
            'nombre_empresa' => 'nullable|max:255',
        ]);

        // Guardar los datos en la base de datos
        FormularioContacto::create($validatedData);

        // Enviar el correo electrónico de notificación al administrador
        Mail::to('mauricioterrones98@gmail.com')->send(new ContactoMail($validatedData));

        // Redirigir al usuario con un mensaje de éxito
        return redirect('/contacto')->with('success', '¡Tu solicitud ha sido enviada con éxito!');
    }

public function consultarRuc(string $ruc)
{
    $token = env('DECOLECTA_TOKEN');

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/json',
    ])->get("https://api.decolecta.com/v1/sunat/ruc?numero={$ruc}");

    if ($response->successful()) {
        $data = $response->json();
        return response()->json([
            'ruc' => $data['numero_documento'] ?? null,
            'razon_social' => $data['razon_social'] ?? null,
            'nombre_empresa' => $data['razon_social'] ?? null,
        ]);
    }

    return response()->json(['error' => 'No se encontraron datos para este RUC.'], 404);
}
}