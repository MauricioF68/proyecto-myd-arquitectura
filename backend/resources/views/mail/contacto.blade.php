<x-mail::message>
# Nuevo Mensaje del Formulario de Contacto

Se ha recibido un nuevo mensaje a través del formulario de contacto de tu sitio web.

**Tipo de Solicitante:** {{ ucfirst($data['tipo_solicitante']) }}

{{-- ✅ INICIO DE LA CORRECCIÓN --}}
{{-- Verificamos que el tipo sea 'empresa' Y que cada dato opcional exista y no esté vacío antes de mostrarlo --}}
@if ($data['tipo_solicitante'] === 'empresa')

    @if (isset($data['ruc']) && !empty($data['ruc']))
    **RUC:** {{ $data['ruc'] }}
    @endif

    @if (isset($data['razon_social']) && !empty($data['razon_social']))
    **Razón Social:** {{ $data['razon_social'] }}
    @endif

    @if (isset($data['nombre_empresa']) && !empty($data['nombre_empresa']))
    **Nombre de la Empresa:** {{ $data['nombre_empresa'] }}
    @endif

@endif
{{-- ✅ FIN DE LA CORRECCIÓN --}}

**Nombre Completo:** {{ $data['nombre_completo'] }}
**Número de Celular (WhatsApp):** {{ $data['numero_celular'] }}
**Correo Electrónico:** {{ $data['correo_electronico'] }}

**Mensaje:**
{{ $data['mensaje'] }}


{{-- Se ha mejorado el enlace para limpiar el número y añadir el código de país --}}
<x-mail::button :url="'https://wa.me/51' . preg_replace('/[^0-9]/', '', $data['numero_celular'])">
Responder por WhatsApp
</x-mail::button>

</x-mail::message>