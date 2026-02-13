<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Car; // Correct namespace for the Car model
use App\Model\Driver;
use App\Model\Reserve;
use App\Model\Client;
use App\Model\Sell;
use App\Model\Accessory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class HomeController extends Controller
{
    public function index()
    {

        //quantidade de carros por tipo
        $sedanCount = Car::where('type_car', 'sedan')->where('status', 'available')->count();
        $suvCount = Car::where('type_car', 'suv')->where('status', 'available')->count();
        $compactCount = Car::where('type_car', 'compact')->where('status', 'available')->count();
        $station_wagonCount = Car::where('type_car', 'station_wagon')->where('status', 'available')->count();
        $sports_carCount = Car::where('type_car', 'sports_car')->where('status', 'available')->count();
        $minivanCount = Car::where('type_car', 'minivan')->where('status', 'available')->count();
        $compact_suvCount = Car::where('type_car', 'compact_suv')->where('status', 'available')->count();
        $coupeCount = Car::where('type_car', 'coupe')->where('status', 'available')->count();
        $sports_coupeCount = Car::where('type_car', 'sports_coupe')->where('status', 'available')->count();
        $coupeCount = Car::where('type_car', 'coupe')->where('status', 'available')->count();
        $sports_coupeCount = Car::where('type_car', 'sports_coupe')->where('status', 'available')->count();

        // Fetch all cars with their related data (brand, models, color, fuel)
        $cars = Car::with(['brand', 'models', 'color', 'fuel', 'reserves'])->whereIn('status', ['available', 'reserved'])->take(9)->get(); // 🔹 só traz disponíveis;
        Log::info('Cars with reservations:', $cars->toArray());

        //total de carros disponíveis
        $totalAvailableCars = Car::where('status', 'available')->count();

        //total de cliente no sistema
        $client = Client::count();

        //total de accessorios no sistema
        $accessories = Accessory::count();
        
        //viaturas a venda
        $sells = Sell::count();

        // Pass the cars to the view
        return view('site.home.index', compact('cars', 'sedanCount', 'suvCount', 'compactCount', 'station_wagonCount', 'sports_carCount', 'minivanCount', 'compact_suvCount', 'coupeCount', 'sports_coupeCount','totalAvailableCars','client','accessories','sells')); // Add 'cars' to compact()
    }

    public function carList(Request $request)
    {
        $type_car = $request->input('type_car'); // traga o tipo clicado

        // Retrieve filter inputs
        $pickup_location = $request->input('pickup_location');
        $dropoff_location = $request->input('dropoff_location');
        $pickup_datetime = $request->input('pickup_datetime');
        $dropoff_datetime = $request->input('dropoff_datetime');
        $brands = $request->input('brands', []); // Array of selected brands
        $categories = $request->input('categories', []); // Array of selected categories
        $years = $request->input('years', []); // Array of selected years
        $colors = $request->input('colors', []); // Array of selected colors
        $seats = $request->input('seats', []); // Array of selected seat counts
        $transmissions = $request->input('transmissions', []); // Array of selected transmissions
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        // Base query: only available cars
        $query = Car::with(['brand', 'models', 'color', 'fuel'])->where('status', 'available');

        if (!empty($type_car)) {
            $query->where('type_car', $type_car); // 🔹 filtra pelo tipo específico
        }

        if (!empty($brands)) {
            $query->whereIn('brand_id', function ($subQuery) use ($brands) {
                $subQuery->select('id')->from('brands')->whereIn('name', $brands);
            });
        }

        if (!empty($categories)) {
            $query->whereIn('category', $categories);
        }

        if (!empty($years)) {
            $query->whereIn('manufacture_date', $years);
        }

        if (!empty($colors)) {
            $query->whereIn('color_id', function ($subQuery) use ($colors) {
                $subQuery->select('id')->from('colors')->whereIn('name', $colors);
            });
        }

        if (!empty($seats)) {
            $query->whereIn('number_of_seats', $seats);
        }

        if (!empty($transmissions)) {
            $query->whereIn('transmission', $transmissions);
        }

        if (!empty($min_price) && !empty($max_price)) {
            $query->whereBetween('price_per_day', [$min_price, $max_price]);
        } elseif (!empty($min_price)) {
            $query->where('price_per_day', '>=', $min_price);
        } elseif (!empty($max_price)) {
            $query->where('price_per_day', '<=', $max_price);
        }

        // Execute the query
        $cars = $query->get();

        // Return to the view with the filtered cars and filter values
        return view('site.reservation.car-list.index', compact(
            'cars',
            'pickup_location',
            'dropoff_location',
            'pickup_datetime',
            'dropoff_datetime',
            'brands',
            'categories',
            'years',
            'colors',
            'seats',
            'transmissions',
            'min_price',
            'max_price',
            'type_car'
        ));
    }


    public function carLocation()
    {
        // Fetch all cars with their related data (brand, models, color, fuel)
        $cars = Car::with(['brand', 'models', 'color', 'fuel'])->where('status', 'available')->get(); // 🔹 só traz disponíveis;

        // Pass the cars to the view
        return view('site.reservation.car-location.index', compact('cars'));
    }

    public function carConfirmed($id)
    {
        // Carrega reserva com carro, cliente e motorista
        $reservation = Reserve::with(['car', 'client', 'driver'])->findOrFail($id);

        // Monta os extras a partir do campo resources da reserva
        $extrasData = [];
        if (!empty($reservation->resources)) {
            // Decodifica o JSON em array
            $resources = json_decode($reservation->resources, true);

            if (is_array($resources)) {
                foreach ($resources as $key) {
                    $extra = config("resources.extras.$key");
                    if ($extra) {
                        $extrasData[] = [
                            'name'  => $extra['label'],
                            'price' => $extra['price'],
                            'icon'  => $extra['icon'],
                        ];
                    }
                }
            }
        }

        return view('site.reservation.car-confirmed.index', [
            'reservation' => $reservation,
            'car'         => $reservation->car,
            'extrasData'  => $extrasData,
        ]);
    }




    public function sell()
    {
        $sells = Sell::orderBy('id', 'desc')->get();
        return view('site.reservation.blog.index', compact('sells'));
    }

    public function accessory()
    {
        //aparecer apenas 5 acessórios na página inicial    

        $accessories = Accessory::orderBy('id', 'desc')->get();
        return view('site.reservation.blog-accessory.index', compact('accessories'));
        
    }




    public function carDetails(Car $car)
    {
        $car->load(['brand', 'models', 'color', 'fuel', 'supplier']);
        return view('site.reservation.car-details.index', compact('car'));
    }


    public function client_create(Request $request)
    {
        $validated = $request->validate([
            'name'                   => 'required|string|max:255',
            'email'                  => 'required|email|unique:clients,email',
            'password'               => 'required|string|min:8',
            'phone'                  => 'nullable|string|max:20',
            /* 'bi'                     => 'nullable|string|max:50',
            'bi_upload'              => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'driver_license'         => 'nullable|string|max:20|unique:clients,driver_license',
            'driver_license_upload'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'address'                => 'nullable|string|max:255', */
        ]);

        // Hashear a senha antes de salvar
        $validated['password'] = Hash::make($validated['password']);

        // Diretórios
        /* $uploadPath = public_path('uploads');

        if ($request->hasFile('driver_license_upload')) {
            $fileName = time() . '_document.' . $request->driver_license_upload->getClientOriginalExtension();
            $request->driver_license_upload->move($uploadPath . '/client/driver_license_upload', $fileName);
            $validated['driver_license_upload'] = $fileName;
        }

        if ($request->hasFile('bi_upload')) {
            $fileName = time() . '_document.' . $request->bi_upload->getClientOriginalExtension();
            $request->bi_upload->move($uploadPath . '/client/client_bi_upload', $fileName);
            $validated['bi_upload'] = $fileName;
        } */

        Client::create($validated);

        return redirect()->route('site.client-login')->with('success', 'cliente criado com sucesso!');
        return redirect()->back()->with('error', 'Erro ao criar o cliente. Tente novamente.');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    if (Auth::guard('client')->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        // FORÇA SEMPRE IR PARA A HOME depois do login
        // (mais limpo, previsível e evita loops infinitos)
        return redirect()->route('home')
            ->with('success', 'Bem-vindo! Login realizado com sucesso!');
    }

    return back()->withErrors([
        'email' => 'E-mail ou senha incorretos.',
    ])->withInput();
}

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('site.client-login')->with('success', 'Saiu da sessão com sucesso!');
       /*  return redirect()->back()->with('error', 'Erro ao fazer logout. Tente novamente.'); */
    }

   

     public function profile(Request $request)
{
    $client = Auth::guard('client')->user();

    // 1. Inicia a query base (sem executar o get() ainda)
    $query = Reserve::with(['car.brand', 'car.models', 'driver'])
        ->where('client_id', $client->id)
        ->orderByDesc('created_at');

    // 2. Aplica o filtro por status, se existir
    if ($request->has('status') && $request->filled('status')) {
        $status = $request->query('status');

        switch ($status) {
            case 'pending':     // Recomendo padronizar para 'pending'
            case 'peding':      // Mantendo suporte ao erro de digitação atual
                $query->whereIn('status', ['pending', 'peding']);
                break;

            case 'in_progress':
                $query->where('status', 'in_progress');
                break;

            case 'completed':
                $query->where('status', 'completed');
                break;

            case 'cancelled':
                $query->whereIn('status', ['cancelled', 'canceled']);
                break;

            // Qualquer outro valor é ignorado silenciosamente
        }
    }

    // 3. Agora sim, executa a query com os filtros aplicados
    $reserves = $query->get();

    return view('site.reservation.client.profile.index', compact('client', 'reserves'));
}

    public function profile_update(Request $request)
    {
        $client = Auth::guard('client')->user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('clients')->ignore($client->id)],
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed', // confirmed verifica password_confirmation
        ]);

        $data = [
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ];

        // Só atualiza senha se o usuário preencheu
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $client->update($data);

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    


   
}
