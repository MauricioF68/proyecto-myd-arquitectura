<?php

namespace App\Http\Controllers;

use App\Mail\NotificacionProyectoMail;
use App\Models\Proyecto;
use App\Models\ProyectoFoto;
use App\Models\ClienteRegistrado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProyectoController extends Controller
{
    private function checkAdmin()
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }
        return null;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }
    
        // Iniciar la consulta, pero no ejecutarla aún
        $proyectos = Proyecto::with('fotos');
    
        // Lógica de búsqueda por nombre o cliente
        if ($request->filled('search')) {
            $proyectos->where(function ($query) use ($request) {
                $query->where('titulo', 'like', '%' . $request->search . '%')
                      ->orWhere('nombre_empresa_cliente', 'like', '%' . $request->search . '%');
            });
        }
    
        // Lógica de filtrado por año y mes
        if ($request->filled('year')) {
            $proyectos->whereYear('created_at', $request->year);
        }
        if ($request->filled('month')) {
            $proyectos->whereMonth('created_at', $request->month);
        }
    
        // Lógica de filtrado por una fecha específica
        if ($request->filled('date')) {
            $proyectos->whereDate('created_at', $request->date);
        }
    
        // Ahora sí, ejecutar la consulta con todos los filtros aplicados
        $proyectos = $proyectos->orderBy('created_at', 'desc')->get();
    
        return view('admin.proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }
        return view('admin.proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }
        // 1. Validar los datos del formulario
        $validatedData = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'nombre_empresa_cliente' => 'required|max:255',
            'estadisticas' => 'nullable',
            'tiempo_trabajado' => 'nullable',
            'foto_empresa_cliente' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fotos_proyecto' => 'nullable|array',
            'fotos_proyecto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Manejar la subida de la foto de la empresa
        if ($request->hasFile('foto_empresa_cliente')) {
            $path = $request->file('foto_empresa_cliente')->store('public/proyectos');
            $validatedData['foto_empresa_cliente'] = $path;
        }

        // 3. Crear el proyecto en la base de datos
        $proyecto = Proyecto::create($validatedData);

        // 4. Manejar la subida de las fotos múltiples
        if ($request->hasFile('fotos_proyecto')) {
            foreach ($request->file('fotos_proyecto') as $foto) {
                $path = $foto->store('public/proyectos/galeria');
                $proyecto->fotos()->create([
                    'path' => $path,
                ]);
            }
        }

        // 5. ENVIAR LA NOTIFICACIÓN POR CORREO A LOS CLIENTES REGISTRADOS
        $clientes = ClienteRegistrado::all();
        foreach ($clientes as $cliente) {
            Mail::to($cliente->correo_electronico)->send(new NotificacionProyectoMail($proyecto));
        }

        // 6. Redirigir al usuario de vuelta al panel de proyectos con un mensaje de éxito
        return redirect('/admin/proyectos')->with('success', '¡Proyecto y fotos creadas y clientes notificados con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        $proyecto = Proyecto::with('fotos')->findOrFail($id);

        return view('admin.proyectos.edit', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        $proyecto = Proyecto::findOrFail($id);

        $validatedData = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'nombre_empresa_cliente' => 'required|max:255',
            'estadisticas' => 'nullable',
            'tiempo_trabajado' => 'nullable',
            'foto_empresa_cliente' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fotos_proyecto' => 'nullable|array',
            'fotos_proyecto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto_empresa_cliente')) {
            if ($proyecto->foto_empresa_cliente) {
                Storage::delete($proyecto->foto_empresa_cliente);
            }
            $path = $request->file('foto_empresa_cliente')->store('public/proyectos');
            $validatedData['foto_empresa_cliente'] = $path;
        }

        $proyecto->update($validatedData);

        if ($request->hasFile('fotos_proyecto')) {
            foreach ($request->file('fotos_proyecto') as $foto) {
                $path = $foto->store('public/proyectos/galeria');
                $proyecto->fotos()->create(['path' => $path]);
            }
        }

        return redirect('/admin/proyectos')->with('success', '¡Proyecto actualizado con éxito!');
    }

    /**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    if (! auth()->user()->is_admin) {
        return redirect('/');
    }

    $proyecto = Proyecto::with('fotos')->findOrFail($id);

    // Eliminar la foto de la empresa si existe
    if ($proyecto->foto_empresa_cliente) {
        Storage::delete($proyecto->foto_empresa_cliente);
    }

    // Eliminar todas las fotos de la galería del proyecto
    foreach ($proyecto->fotos as $foto) {
        Storage::delete($foto->path);
        $foto->delete();
    }

    // Eliminar el registro del proyecto en la base de datos
    $proyecto->delete();

    return redirect('/admin/proyectos')->with('success', '¡Proyecto eliminado con éxito!');
}



}