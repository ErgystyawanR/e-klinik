@extends('layouts.app', ['title' => 'Form Resep'])

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-header">
                        <h4 id="judulTabel">Resep Obat (Non - Racikan)</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-2">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Obat</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control mb-2" id="obat" onchange="updateStok()">
                                    <option value="" selected disabled>Pilih Obat</option>
                                    @foreach ($obat as $item)
                                        <option value="{{ $item->id }}" data-stok="{{ $item->stok }}">
                                            {{ $item->obatalkes_nama }}</option>
                                    @endforeach
                                </select>
                                <span class="font-weight-600" id="stokObat"></span>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="qty" class="col-md-3 col-form-label text-md-right">Qty</label>
                            <div class="col-md-3">
                                <input id="qty" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Signa</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control" id="signa">
                                    <option value="" selected disabled>Pilih Signa</option>
                                    @foreach ($signa as $item)
                                        <option value="{{ $item->id }}">{{ $item->signa_nama }} -
                                            {{ $item->signa_kode }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-12 d-flex justify-content-end">
                                <button id="tambahButton" class="btn btn-primary" onclick="tambahItem()">Tambah </button>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row mb-4">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Obat</th>
                                            <th>Signa</th>
                                            <th>Qty</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <form id="prescriptionForm" action="{{ route('transaksinonracikan.store') }}"
                                        method="POST">

                                        @csrf
                                        <tbody id="daftarObat">

                                            {{-- Form draft resep obat start --}}
                                            {{-- Akan tampil dengan javascript --}}
                                            {{-- Form draft resep obat end --}}

                                            {{-- input hidden akan terkirim ke tabel database transaksi --}}

                                        </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mb-4">Kirim</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tambahItem() {
            var addButton = document.querySelector('#tambahButton');
            addButton.style.display = 'none';
            var obatDropdown = document.getElementById('obat');
            var selectedObat = obatDropdown.options[obatDropdown.selectedIndex];
            var signaDropdown = document.getElementById('signa');
            var selectedSigna = signaDropdown.options[signaDropdown.selectedIndex];
            var qtyValue = document.getElementById('qty').value;
            var namaObat = selectedObat.textContent;
            var stokObat = parseInt(selectedObat.getAttribute('data-stok'));
            var signa = selectedSigna.textContent;
            var noTransaksi = '';
            var qty = qtyValue;

            // Periksa apakah qty melebihi stok
            if (qty > stokObat) {
                var errorModal =
                    '<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">';
                errorModal += '<div class="modal-dialog  role="document">';
                errorModal += '<div class="modal-content" style="background-color: #FFCD39;">';
                errorModal += '<div class="modal-header">';
                errorModal += '<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">';
                errorModal += '<span aria-hidden="true">&times;</span>';
                errorModal += '</button>';
                errorModal += '</div>';
                errorModal += '<div class="modal-body">';
                errorModal +=
                    '<p class="text-white font-weight-bold"><i class="fas fa-exclamation-triangle"></i> Jumlah permintaan melebihi stok obat yang tersedia.</p>';
                errorModal += '</div>';
                errorModal += '</div>';
                errorModal += '</div>';
                errorModal += '</div>';
                errorModal += '</div>';

                var oldModal = document.getElementById('errorModal');
                if (oldModal) {
                    oldModal.parentNode.removeChild(oldModal);
                }


                document.body.insertAdjacentHTML('beforeend', errorModal);

                $('#errorModal').modal('show');
                return;
            }

            var daftarObat = document.getElementById('daftarObat');

            var obatRow = document.createElement('tr');
            obatRow.innerHTML = '<td>' + namaObat + '</td><td>' + signa + '</td><td>' + qty +
                '</td>' +
                '<td><button class="btn btn-danger btn-sm" onclick="hapusItem(this)">Hapus</button></td>';
            daftarObat.appendChild(obatRow);

            // Set value dari input tersembunyi
            var form = document.getElementById('prescriptionForm');
            var namaObatInput = document.createElement('input');
            namaObatInput.type = 'hidden';
            namaObatInput.name = 'nama_obat[]';
            namaObatInput.value = namaObat;
            form.appendChild(namaObatInput);

            var signaInput = document.createElement('input');
            signaInput.type = 'hidden';
            signaInput.name = 'signa[]';
            signaInput.value = signa;
            form.appendChild(signaInput);

            var qtyInput = document.createElement('input');
            qtyInput.type = 'hidden';
            qtyInput.name = 'qty[]';
            qtyInput.value = qty;
            form.appendChild(qtyInput);

            var noTransaksiInput = document.createElement('input');
            noTransaksiInput.type = 'hidden';
            noTransaksiInput.name = 'no_transaksi[]';
            noTransaksiInput.value = '';
            form.appendChild(noTransaksiInput);
        }

        function hapusItem(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);

            var addButton = document.querySelector('#tambahButton');
            addButton.style.display = 'block';
        }



        function updateStok() {
            var obatDropdown = document.getElementById('obat');
            var selectedObat = obatDropdown.options[obatDropdown.selectedIndex];
            var stokObat = parseInt(selectedObat.getAttribute('data-stok'));
            var stokObatSpan = document.getElementById('stokObat');
            stokObatSpan.textContent = 'Stok : ' + stokObat;
        }
    </script>
@endsection
