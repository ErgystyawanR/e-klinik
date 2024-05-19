@extends('layouts.app', ['title' => 'Obat Non Racikan'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Obat Non Racikan</h4>
                    <div class="card-header-form">
                        <td><a href="{{ route('formnonracikan') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Tambah</a></td>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>No Tranksaksi</th>
                                <th>Nama Obat</th>
                                <th>Aksi</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $item->no_transaksi }}</td>
                                    <td>{{ $item->nama_obat }}</td>
                                    <td><a href="{{ route('show.nonracikan', ['no_transaksi' => $item->no_transaksi]) }}" class="btn btn-info">Detail</a></td>
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
