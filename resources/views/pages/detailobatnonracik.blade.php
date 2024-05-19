@extends('layouts.app', ['title' => 'Detail Transaksi Obat Non Racikan'])

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Transaksi Obat Non Racikan</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No Transaksi</th>
                                <td>{{ $transaksi->no_transaksi }}</td>
                            </tr>
                            <tr>
                                <th>Nama Obat</th>
                                <td>{{ $transaksi->nama_obat }}</td>
                            </tr>
                            <tr>
                                <th>Signa</th>
                                <td>{{ $transaksi->signa }}</td>
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <td>{{ $transaksi->qty }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
