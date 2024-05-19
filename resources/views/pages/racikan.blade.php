@extends('layouts.app', ['title' => 'Obat Racikan'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Obat Racikan</h4>
                    <div class="card-header-form">
                        <td><a href="{{ route('formracikan') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Tambah</a></td>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>No Tranksaksi</th>
                                <th>Nama Racikan</th>
                                <th>Signa</th>
                                <th>Aksi</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $item->no_transaksi }}</td>
                                    <td>{{ $item->nama_racikan }}</td>
                                    <td>{{ $item->signa }}</td>
                                    <td><a href="{{ route('show.racikan', ['no_transaksi' => $item->no_transaksi]) }}" class="btn btn-info">Detail</a></td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
