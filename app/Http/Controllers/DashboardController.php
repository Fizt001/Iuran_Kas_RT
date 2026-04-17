<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resident;
use App\Models\Payment;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        // KHUSUS WARGA: Cek profil dulu, kalau belum ada lempar ke halaman lengkapi profil
        if ($user->role == 'warga' && !$user->resident) {
            return redirect()->route('profile.complete');
        }

        if ($user->role == 'admin') {
            $data = [
                'total_warga' => Resident::count(),
                'total_akun' => User::count(),
                'total_jenis_iuran' => Contribution::count(),
                'total_kas' => Payment::where('status', 'success')->sum('jumlah_bayar'),
            ];
        } 
        elseif ($user->role == 'bendahara') {
            $data = [
                'total_kas' => Payment::where('status', 'success')->sum('jumlah_bayar'),
                'perlu_verifikasi' => Payment::where('status', 'pending')->count(),
                'pemasukan_bulan_ini' => Payment::where('status', 'success')
                                        ->whereMonth('tanggal_bayar', date('m'))
                                        ->whereYear('tanggal_bayar', date('Y'))
                                        ->sum('jumlah_bayar'),
            ];
        } 
        else { // Role: Warga
            $data = [
                'total_bayar_saya' => Payment::where('user_id', $user->id)
                                    ->where('status', 'success')
                                    ->sum('jumlah_bayar'),
                'status_bulan_ini' => Payment::where('user_id', $user->id)
                                    ->whereMonth('tanggal_bayar', date('m'))
                                    ->whereYear('tanggal_bayar', date('Y'))
                                    ->first(),
            ];
        }

        return view('dashboard', compact('data'));
    }
}