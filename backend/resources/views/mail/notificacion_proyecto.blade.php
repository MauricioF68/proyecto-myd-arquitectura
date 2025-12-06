<x-mail::message>
# Nuevo Proyecto de MYD Controles Industriales

¡Hola!

Queremos informarte que hemos comenzado un nuevo proyecto emocionante. A continuación, te compartimos algunos detalles:

**Título del Proyecto:** {{ $proyecto->titulo }}

**Descripción:**
{{ $proyecto->descripcion }}

**Empresa Cliente:** {{ $proyecto->nombre_empresa_cliente }}

@if ($proyecto->foto_empresa_cliente)
![Foto de la Empresa]({{ Storage::url($proyecto->foto_empresa_cliente) }})
@endif

Si deseas conocer más sobre este y otros proyectos, o si tienes un nuevo desafío para nosotros, no dudes en contactarnos.

<x-mail::button :url="'mailto:admin@mydcontroles.com'">
Contáctanos
</x-mail::button>

Gracias por ser parte de nuestra comunidad.

Atentamente,
El equipo de MYD Controles Industriales
</x-mail::message>