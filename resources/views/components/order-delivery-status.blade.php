@php
$badgeClass = 'badge ';

switch ($status) {
    case 'En tránsito':
        $badgeClass .= 'bg-info';
        break;
    case 'Paquete entregado y firmado por la destinataria.':
        $badgeClass .= 'bg-success';
        break;
    case 'Se intentó entregar el paquete pero no se logró.':
        $badgeClass .= 'bg-warning';
        break;
    case 'El paquete puede ser devuelto.':
    case 'Expirado':
        $badgeClass .= 'bg-danger';
        break;
    default:
        $badgeClass .= 'bg-secondary';
        break;
}
@endphp


<span class="{{ $badgeClass }} fw-normal">
    @switch($status)
        @case('En tránsito')
            <i class="bi bi-truck"></i>
            @break
        @case('Paquete entregado y firmado por la destinataria.')
            <i class="bi check-circle"></i>
            @break
        @case('Se intentó entregar el paquete pero no se logró.')
            <i class="bi calendar-x"></i>
            @break
        @default
            <i class="bi question-circle"></i>
    @endswitch
    {{ $status }}
</span>