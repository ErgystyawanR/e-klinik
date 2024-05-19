@extends('layouts.app', ['title' => 'Signa'])

@section('content')
        <div class="section-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Signa</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>Signa Kode</th>
                                        <th>Signa Nama</th>             
                                    </tr>
                                    @foreach ($signa as $item)
                                        <tr>
                                            <td>{{ $item->signa_kode }}</td>
                                            <td>{{ $item->signa_nama }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
