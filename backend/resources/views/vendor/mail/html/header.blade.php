{{-- resources/views/vendor/mail/html/header.blade.php --}}
<tr>
<td class="header" style="padding: 25px 0; text-align: center;">
<a href="{{ config('app.url') }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{-- Reemplazamos el logo de Laravel por el tuyo --}}
<img src="{{ asset('img/logo-empresa.png') }}" class="logo" alt="Logo de MYD Controles" style="width: auto; max-width: 200px; height: auto;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>