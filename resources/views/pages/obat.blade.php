@extends('layouts.app', ['title' => 'Obat'])

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Obat</h4>
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="obatTable">
                                    <tr>
                                        <th>Kode Obat</th>
                                        <th>Nama Obat</th>
                                        <th>Stok</th>                          
                                    </tr>
                                    @foreach ($obat as $item)
                                        <tr>
                                            <td>{{ $item->obatalkes_kode }}</td>
                                            <td>{{ $item->obatalkes_nama }}</td>
                                        <td>{{ number_format($item->stok, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

