<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerAuthController extends Controller
{
    // =========================
    // TAMPILKAN LOGIN
    // =========================
    public function showLogin()
    {
        // Kalau sudah login, redirect ke landing
        if (Auth::guard('customer')->check()) {
            return redirect('/');
        }

        return view('landing.login.login');
    }

    // =========================
    // PROSES LOGIN
    // =========================
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];


        if (Auth::guard('customer')->attempt($credentials)) {

            $request->session()->regenerate();

            // Set a one-time flag to show a welcome greeting on the next page
            $request->session()->flash('welcome', true);

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput();
    }

    // =========================
    // PROSES REGISTER
    // =========================
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customer,email',
            'password' => 'required|min:6|confirmed',

            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string',
            'gender'   => 'nullable|in:Laki-laki,Perempuan',
        ]);

        // Generate ID otomatis contoh CS001
        $last = Customer::orderBy('customerId', 'desc')->first();
        $number = $last ? (int) substr($last->customerId, 2) + 1 : 1;
        $customerId = 'CS' . str_pad($number, 3, '0', STR_PAD_LEFT);

        $customer = Customer::create([
            'customerId'            => $customerId,
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => Hash::make($request->password),
            'alamat'                => $request->address,
            'customerNoTelp'        => $request->phone,
            'customerJenisKelamin'  => $request->gender,
        ]);


        // Auto login setelah register
        Auth::guard('customer')->login($customer);

        $request->session()->regenerate();

        // Set welcome flag for freshly-registered users
        $request->session()->flash('welcome', true);

        return redirect('/');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // =========================
    // PROFILE CUSTOMER
    // =========================
    public function profile()
    {
        $customer = Auth::guard('customer')->user();

        return view('landing.customer.profile', compact('customer'));
    }

    // =========================
    // TAMPILKAN FORM EDIT PROFILE
    // =========================
    public function edit()
    {
        $customer = Auth::guard('customer')->user();

        return view('landing.customer.edit', compact('customer'));
    }

    // =========================
    // PROSES UPDATE PROFILE
    // =========================
    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:customer,email,' . $customer->customerId . ',customerId',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'gender'  => 'nullable|in:Laki-laki,Perempuan',

            'avatar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $updateData = [
            'name'                  => $request->name,
            'email'                 => $request->email,
            'alamat'                => $request->address,
            'customerNoTelp'        => $request->phone,
            'customerJenisKelamin'  => $request->gender,
        ];


        // Handle file upload untuk avatar
        if ($request->hasFile('avatar')) {
            // Hapus file lama jika ada
            if ($customer->avatar && file_exists(public_path($customer->avatar))) {
                unlink(public_path($customer->avatar));
            }
            
            // Simpan file baru
            $file = $request->file('avatar');
            $filename = 'avatar_' . $customer->customerId . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/avatar'), $filename);
            $updateData['avatar'] = 'images/avatar/' . $filename;
        }

        // Hanya update password jika ada input password baru
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }


        $customer->update($updateData);

        return redirect()->route('landing.customer.profile')
                        ->with('success', 'Profil berhasil diperbarui!');
    }

}
