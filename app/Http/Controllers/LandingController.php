<?php

namespace App\Http\Controllers;
use App\Models\Dokter;
use App\Models\Customer;
use App\Models\FormAppointment;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index()
    {
        $appointments = [];
        if (Auth::guard('customer')->check()) {
            $appointments = FormAppointment::with('dokter')
                ->where('customerId', Auth::guard('customer')->user()->customerId)
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get();
        }

        return view('landing.index', compact('appointments'));
    }

    public function tentang()
    {
        return view('landing.sections.tentang');
    }

    public function pelayanan()
    {
        return view('landing.sections.pelayanan');
    }

    public function appointment()
    {
        $dokters = Dokter::all();
        $customers = Customer::all();

        return view('landing.sections.appointment', compact('dokters', 'customers'));
    }

    public function blog()
    {
        return view('landing.sections.blog');
    }

    public function kontak()
    {
        return view('landing.sections.kontak');
    }

    public function produk()
    {
        return view('landing.produk.produk');
    }

    public function ksinvestasi()
    {
        return view('landing.artikel.ksinvestasi');
    }

    public function ksditanganmu()
    {
        return view('landing.artikel.ksditanganmu');
    }

    public function tubuhsehat()
    {
        return view('landing.artikel.tubuhsehat');
    }
    public function kstubuhmental()
    {
        return view('landing.artikel.kstubuhmental');
    }
    public function nutrisi(){
        return view('landing.artikel.nutrisi');
    }
    public function mental(){
        return view('landing.artikel.mental');
    }
    public function gaya(){
        return view('landing.artikel.gaya');
    }
}
