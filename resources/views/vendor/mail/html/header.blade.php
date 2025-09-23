<tr>
    <td class="header">
        <a href="{{ config('app.url') }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                {{-- Ganti logo default Laravel dengan logo Anda --}}
                <img src="{{ config('app.url') }}/assets/icon/logo.svg" class="logo" alt="HostPanel Logo" style="max-height: 45px;">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>