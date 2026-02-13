@component('mail::message')
# Confirmação da sua Reserva

Olá **{{ $reserve->client->name }}**,

A sua reserva foi confirmada com sucesso!

### Detalhes da Reserva:
- **Número da Reserva:** {{ $reserve->id }}
- **Carro:** {{ $reserve->car->brand->name }} 
- **Cor:** {{ $reserve->car->color->name ?? 'Não especificada' }}
- **Combustível:** {{ $reserve->car->fuel->name ?? 'Não especificado' }}
- **Data de Retirada:** {{ \Carbon\Carbon::parse($reserve->pickup_date)->format('d/m/Y H:i') }}
- **Local de Retirada:** {{ $reserve->pickup_location }}
- **Data de Devolução:** {{ \Carbon\Carbon::parse($reserve->dropoff_date)->format('d/m/Y H:i') }}
- **Local de Devolução:** {{ $reserve->return_location }}
- **Estado da Reserva:** {{ ucfirst($reserve->status) }}
- **Valor Total:** {{ number_format($reserve->total_amount, 2, ',', '.') }} Kz
- **Motorista:** {{ $reserve->driver ? $reserve->driver->full_name : 'Sem motorista' }}



Qualquer dúvida, é só responder este e-mail (angocars574@gmail.com) ou ligar para nós +244 923 000 000.

Obrigado por escolher o AngoCars!  
Estamos ansiosos para lhe atender.

Atenciosamente,  
**AngoCars o Melhor da Banda**
@endcomponent