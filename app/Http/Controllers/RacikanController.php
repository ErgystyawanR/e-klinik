<?php

namespace App\Http\Controllers;
use App\Models\Obat;
use App\Models\Signa;
use App\Models\Transaksiracikan;
use App\Models\Transaksiracikandetail;
use Illuminate\Http\Request;

class RacikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $data = Transaksiracikan::all();

        return view('pages.racikan', compact('data'));
    }

    public function show_form(){
        $signa = Signa::all()->sortBy('signa_nama');
        $obat = Obat::orderBy('obatalkes_nama')->get();
        return view('pages.formracikan', compact('obat', 'signa'));
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
        $lastTransaction = Transaksiracikan::latest('no_transaksi')->first();
    
        if ($lastTransaction) {
            $lastNumber = substr($lastTransaction->no_transaksi, 2); 
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); 
            $no_transaksi = 'TR' . $nextNumber; 
        } else {
            $no_transaksi = 'TR001'; 
        }
    
        $racikan = Transaksiracikan::create([
            'no_transaksi' => $no_transaksi,
            'nama_racikan' => $request->nama_racikan,
            'signa' => $request->signa,
        ]);

        $obatCount = count($request->nama_obat);
    
        for ($i = 0; $i < $obatCount; $i++) {
            Transaksiracikandetail::create([
                'no_transaksi' => $no_transaksi,
                'nama_obat' => $request->nama_obat[$i],
                'qty' => $request->qty[$i],
            ]);
    
            $obat = Obat::where('obatalkes_nama', $request->nama_obat[$i])->first();
            if ($obat) {
                $obat->stok -= $request->qty[$i];
                $obat->save();
            }
        }
        return redirect()->back()->with('success', 'Transaksi obat berhasil disimpan.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $no_transaksi)
    {
         $transaksiDetail = Transaksiracikandetail::where('no_transaksi', $no_transaksi)->get();
         return view('pages.detailobatracik', compact('transaksiDetail'));
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
