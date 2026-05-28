<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\BookingStatusMail;
use App\Models\Admin;
use App\Models\Type;
use App\Models\Booking;
use App\Models\Residence;
use App\Models\User;
use App\Models\Payment;
use App\Models\Review;

class AdminController extends Controller
{

    /* ====================== DASHBOARD ====================== */


    public function homes(Request $request)
    {
        $reviews = Review::with('user')
            ->latest()
            ->get();

        $sejours = Booking::with('user')->get();

        foreach ($sejours as $sejour) {

            $start = Carbon::parse($sejour->date_arrivee);
            $end = Carbon::parse($sejour->date_depart);
            $now = Carbon::now();

            $totalDays = $start->diffInDays($end);
            $passedDays = $start->diffInDays($now);

            $sejour->progress = $totalDays > 0
                ? max(0, min(100, 100 - (($passedDays / $totalDays) * 100)))
                : 0;
        }

        $currentYear = date('Y');
        $lastYear = $currentYear - 1;

        // utilisateurs uniques année courante
        $currentYearUsers = Booking::whereYear('created_at', $currentYear)
            ->distinct('user_id')
            ->count('user_id');

        //  utilisateurs uniques année précédente
        $lastYearUsers = Booking::whereYear('created_at', $lastYear)
            ->distinct('user_id')
            ->count('user_id');

        //  croissance (%)
        $usersGrowth = $lastYearUsers > 0
            ? (($currentYearUsers - $lastYearUsers) / $lastYearUsers) * 100
            : 100;


        // Stats
        $totalBookings = Booking::count();
        $totalUsers = Booking::distinct('user_id')->count('user_id');
        $totalRevenue = Payment::sum('montant');
        $totalItems = Booking::sum('nombre_adultes');

        $cancelledBookings = Booking::where('statut', 'Annulé')->count();
        $confirmedBookings = Booking::where('statut', 'Confirmé')->count();
        $completedBookings = Booking::where('statut', 'Terminé')->count();
        $pendingBookings   = Booking::where('statut', 'Attente')->count();

        // année sélectionnée
        $year = $request->get('year', date('Y'));

        // 📊 BOOKINGS PAR MOIS
        $bookingsByMonth = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $bookingsByMonth[$i] ?? 0;
        }

        // 💰 REVENUS PAR MOIS
        $revenueByMonth = Payment::selectRaw('MONTH(created_at) as month, SUM(montant) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $revenueChart = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueChart[] = $revenueByMonth[$i] ?? 0;
        }

        return view('adminauth.dashboard', compact(
            'usersGrowth',
            'sejours',
            'totalBookings',
            'totalUsers',
            'totalRevenue',
            'totalItems',
            'cancelledBookings',
            'confirmedBookings',
            'completedBookings',
            'pendingBookings',
            'chartData',
            'revenueChart',
            'year',
            'reviews'
        ));
    }


    /* ====================== Utilisateur ====================== */

    public function admins()
    {
        $admins = Admin::latest()->paginate(10);
        return view('adminauth.admins.index', compact('admins'));
    }

    public function createAdmin()
    {
        return view('adminauth.admins.create');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6'
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin créé');
    }

    public function editAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        return view('adminauth.admins.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin mis à jour');
    }

    public function destroyAdmin($id)
    {
        Admin::destroy($id);

        return back()->with('success', 'Admin supprimé');
    }


    /* ====================== RESIDENCES ====================== */
    public function residences()
    {
        $residences = Residence::with(['images', 'types'])->get();
        return view('adminauth.residences.index', compact('residences'));
    }

    public function createResidence()
    {
        return view('adminauth.residences.create');
    }

    public function storeResidence(Request $request)
    {
        $validated = $request->validate([
            'nom'     => 'required|string|max:255',
            'adresse' => 'required|string',
            'prix'    => 'required|numeric',
        ]);

        Residence::create($validated);

        return back()->with('success', 'Résidence ajoutée');
    }

    /* ====================== BOOKINGS ====================== */

    public function index(Request $request)
    {
        $query = Booking::query();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('numero_reservation', 'like', "%{$request->search}%")
                    ->orWhere('nom_client', 'like', "%{$request->search}%");
            });
        }

        // STATUT
        if ($request->statut && $request->statut != 'all') {
            $query->where('statut', $request->statut);
        }

        // DATE ARRIVÉE
        if ($request->date_arrivee) {
            $query->whereDate('date_arrivee', '>=', $request->date_arrivee);
        }

        // DATE DÉPART
        if ($request->date_depart) {
            $query->whereDate('date_depart', '<=', $request->date_depart);
        }

        $bookings = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return view('adminauth.bookings.bookings_table', compact('bookings'))->render();
        }

        return view('adminauth.bookings.index', compact('bookings'));
    }

    public function createBooking()
    {
        $residences = Residence::with('types')->get();

        return view('adminauth.bookings.create', compact('residences'));
    }

    /* ====================== STORE BOOKING ====================== */
    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'residence_id' => 'required|exists:residences,id',
            'type_id' => 'required|exists:types,id',
            'name' => 'required|string|max:255',
            'nombre_adultes' => 'required|integer|min:1',
            'email' => 'nullable|email',
            'phone_number' => 'required|string|max:20',
            'date_arrivee' => 'required|date',
            'date_depart' => 'required|date|after:date_arrivee',
            'montant_verse' => 'nullable|numeric|min:0',
            'custom_price' => 'nullable|numeric|min:0',
        ]);

        $residence = Residence::findOrFail($validated['residence_id']);

        if (!$residence->isAvailable(
            $validated['date_arrivee'],
            $validated['date_depart']
        )) {
            return back()->with(
                'error',
                'Cet appartement est déjà réservé sur ces dates.'
            );
        }
        DB::beginTransaction();

        try {

            // USER
            $email = $validated['email']
                ?? 'client_' . $validated['phone_number'] . '@temp.local';

            $user = User::firstOrCreate(
                ['phone_number' => $validated['phone_number']],
                [
                    'name' => $validated['name'],
                    'email' => $email,
                    'password' => bcrypt(Str::random(10)),
                ]
            );

            // TYPE
            $type = Type::findOrFail($validated['type_id']);

            $jours = Carbon::parse($validated['date_arrivee'])
                ->diffInDays(Carbon::parse($validated['date_depart']));

            // PRIX
            $prixApplique = $validated['custom_price'] ?: $type->prix_base;
            $montantTotal = $jours * $prixApplique;

            // PAIEMENT
            $montantPaye = $validated['montant_verse'] ?? 0;
            $methode_paiement = $request->input('methode_paiement');
            $reste = max(0, $montantTotal - $montantPaye);

            // BOOKING (SANS PRIX)
            // BOOKING
            $booking = Booking::create([
                'user_id' => $user->id,

                'residence_id' => $validated['residence_id'],

                'source' => 'admin',

                'external_uid' => 'ADMIN-' . Str::uuid(),

                'type_id' => $type->id,

                'nombre_adultes' => $validated['nombre_adultes'],
                'nombre_enfants' => 0,

                'date_arrivee' => $validated['date_arrivee'],
                'date_depart' => $validated['date_depart'],

                'numero_reservation' => 'RES-' . time(),

                'details_client' => json_encode([
                    'adultes' => $validated['nombre_adultes']
                ]),

                'statut' => $montantPaye >= $montantTotal
                    ? 'Confirmé'
                    : 'Pending',
            ]);

            // PAYMENT (TOUT LE PRIX ICI)
            Payment::create([
                'booking_id' => $booking->id,

                'montant' => $montantTotal,
                'montant_payer' => $montantPaye,
                'reste_a_payer' => $reste,

                'devise' => 'XOF',
                'methode_paiement' => $methode_paiement,

                'statut' => $montantPaye >= $montantTotal
                    ? 'Soldé'
                    : ($montantPaye > 0 ? 'Partiel' : 'En cour'),

                'date_paiement' => now(),
            ]);

            DB::commit();

            return back()->with('success', 'Réservation créée avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function editBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $residences = Residence::all();

        return view('adminauth.bookings.edit', compact('booking', 'residences'));
    }

    // Clients booking
    public function clientBookings($id)
    {
        $client = User::findOrFail($id);

        $bookings = Booking::with(['residence', 'payment'])
            ->where('user_id', $client->id)
            ->latest()
            ->get();

        return view('adminauth.clients.bookings', compact('client', 'bookings'));
    }

    /* ====================== ACTIONS ====================== */
    public function updateBooking(Request $request, Booking $booking)
    {
        DB::beginTransaction();

        try {

            /*
        |--------------------------------------------------------------------------
        | Vérification disponibilité si update des dates
        |--------------------------------------------------------------------------
        */

            if ($request->action === 'update') {

                $request->validate([
                    'date_arrivee' => 'required|date',
                    'date_depart'  => 'required|date|after:date_arrivee',
                ]);

                $residence = Residence::findOrFail($booking->residence_id);

                $isAvailable = $residence->isAvailable(
                    $request->date_arrivee,
                    $request->date_depart,
                    $booking->id // IMPORTANT : exclure réservation actuelle
                );

                if (!$isAvailable) {

                    return back()->with(
                        'error',
                        'Ces dates sont déjà réservées.'
                    );
                }

                // update dates
                $booking->update([
                    'date_arrivee' => $request->date_arrivee,
                    'date_depart'  => $request->date_depart,
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | Paiement
        |--------------------------------------------------------------------------
        */

            $payment = $booking->payment;

            if ($request->filled('montant_payer')) {

                $ajout = (float) $request->montant_payer;

                $nouveauPaye = $payment->montant_payer + $ajout;

                $reste = max(0, $payment->montant - $nouveauPaye);

                $payment->update([

                    'montant_payer' => $nouveauPaye,

                    'reste_a_payer' => $reste,

                    'statut' => $nouveauPaye >= $payment->montant
                        ? 'Payé'
                        : 'Partiel',
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | Actions admin
        |--------------------------------------------------------------------------
        */

            if ($request->action === 'confirmé') {
                $booking->update([
                    'statut' => 'Confirmé'
                ]);
            }

            if ($request->action === 'annulé') {
                $booking->update([
                    'statut' => 'Annulé'
                ]);
            }

            if ($request->action === 'terminé') {
                $booking->update([
                    'statut' => 'Terminé'
                ]);
            }

            DB::commit();

            return back()->with(
                'success',
                'Mise à jour réussie'
            );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function destroyBooking(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Réservation supprimée');
    }

    /* ====================== CLIENTS ====================== */
    public function clients()
    {
        return view('adminauth.clients.index', [
            'clients' => User::paginate(10)
        ]);
    }

    /* ====================== PAYMENTS ====================== */
    public function payments()
    {
        return view('adminauth.payments.index', [
            'payments' => Payment::paginate(10)
        ]);
    }

    /* ====================== MAIL ====================== */
    private function notifyUser(Booking $booking, string $message)
    {
        if ($booking->user && $booking->user->email) {
            Mail::to($booking->user->email)
                ->send(new BookingStatusMail($booking, $message));
        }
    }
}
