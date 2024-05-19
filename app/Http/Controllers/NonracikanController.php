<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Signa;
use App\Models\Transaksinonracikan;
use Illuminate\Http\Request;

class NonracikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksinonracikan::all();
        return view('pages.nonracikan', compact('data'));
    }
    
    public function show_form()
    {
        $signa = Signa::all()->sortBy('signa_nama');
        $obat = Obat::orderBy('obatalkes_nama')->get();
        return view('pages.formnonracikan', compact('obat', 'signa'));
    }

    /**
     * Show the form for creating a new resource.   
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $lastTransaction = Transaksinonracikan::latest('no_transaksi')->first();

        if ($lastTransaction) {
            $lastNumber = substr($lastTransaction->no_transaksi, 2); 
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); 
            $no_transaksi = 'TR' . $nextNumber; 
        } else {
            $no_transaksi = 'TR001'; 
        }

        $obat = Obat::where('obatalkes_nama', $request->nama_obat)->firstOrFail();
        $obat->stok -= $request->qty[0]; 
        $obat->save(); 
        
        Transaksinonracikan::create([
            'no_transaksi' => $no_transaksi, 
            'nama_obat' => $request->nama_obat[0],
            'signa' => $request->signa[0],
            'qty' => $request->qty[0],
        ]);

        return redirect()->back()->with('success', 'Transaksi obat berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($no_transaksi)
    {
        $transaksi = Transaksinonracikan::where('no_transaksi', $no_transaksi)->first(); 

        return view('pages.detailobatnonracik', compact('transaksi'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
