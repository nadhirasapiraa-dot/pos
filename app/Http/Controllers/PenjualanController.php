<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()

            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })

            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ], 
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        if($keyword) {
        $products = Produk::where('stok', '>', 0)
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })
        ->orderBy('nama')
        ->get();
        }else {
           $products = Produk::where('stok', '>', 0)
        ->orderBy('nama')
        ->get();
        }
        
        $mode = 'create' ;

        return view('penjualan.pos' , compact('sale' , 'products' , 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
            if (
        Auth::user()->role->name === 'kasir'
        && $penjualan->user_id !== Auth::id()
        ) {
            abort(403);
        }

        $penjualan->load(['itemPenjualan.produk', 'user']);

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {   

        if (
        Auth::user()->role->name === 'kasir'
        && $penjualan->user_id !== Auth::id()
    ) {
        abort(403);
    }

    $sale = $penjualan;

    abort_if($sale->status === 'COMPLETED', 403);

    $sale->load('itemPenjualan');
    $products = Produk::orderBy('nama')->get();
    $mode = 'edit';

    return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        if (Auth::user()->role->name === 'kasir' && $penjualan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($penjualan->status !== 'OPEN') {
            return back()->with('errors', 'Transaksi sudah diproses');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong');
        }

        // 1. Validasi Input
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS',
            'bayar'          => 'required_if:payment_method,CASH|nullable|numeric|min:0',
        ]);

        $total = $penjualan->itemPenjualan()->sum('subtotal');
        $bayar = $request->payment_method === 'CASH' ? $request->bayar : $total;

        // Validasi jika uang tunai kurang dari total pembayaran
        if ($request->payment_method === 'CASH' && $bayar < $total) {
            return back()->with('errors', 'Uang pembayaran kurang dari total tagihan!');
        }

        $kembalian = $bayar - $total;

        // 2. Simpan Transaksi
        DB::transaction(function () use ($penjualan, $request, $total, $bayar, $kembalian) {
            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran'  => $total,
                'bayar'             => $bayar,
                'kembalian'         => $kembalian,
                'status'            => 'COMPLETED'
            ]);
        });

        // 3. Redirect langsung ke Halaman Struk dengan pesan sukses
        return redirect()
            ->route('penjualan.cetak', $penjualan->id)
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete' , $penjualan);
        
    // ! Pastikan hanya transaksi OPEN
    if ($penjualan->status !== 'OPEN') {
        return redirect()->route('penjualan.create')->with('errors', 'Transaksi sudah selesai tidak bisa dibatalkan');
    }

    DB::transaction(function () use ($penjualan) {

        foreach ($penjualan->itemPenjualan as $item) {
            // ▲ kembalikan stok
            $item->produk->increment('stok', $item->kuantitas);
        }

        // ✖ hapus item
        $penjualan->itemPenjualan()->delete();

        // ✖ hapus penjualan
        $penjualan->delete();
    });

    return redirect()
        ->route('penjualan.index')
        ->with('success', 'Transaksi berhasil dibatalkan');
}

public function cetakStruk(Request $request, Penjualan $penjualan)
{
    if (Auth::user()->role->name === 'kasir' && $penjualan->user_id !== Auth::id()) {
        abort(403);
    }

    $penjualan->load(['itemPenjualan.produk', 'user']);

    // Ambil data bayar & kembalian dari parameter URL, beri default jika diakses langsung
    $bayar = $request->query('bayar', $penjualan->total_pembayaran);
    $kembalian = $request->query('kembalian', 0);

    return view('penjualan.struk', compact('penjualan', 'bayar', 'kembalian'));
}
        

}
