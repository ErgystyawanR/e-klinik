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
                        <h4 id="judulTabel">Resep Obat (Racikan)</h4>
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
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-primary" onclick="tambahItem()">Tambah </button>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row mb-4">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Obat</th>
                                            <th>Qty</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <form id="prescriptionForm" action="{{ route('transaksiracikan.store') }}"
                                        method="POST">
                                        @csrf
                                        <input id="no_transaksi" type="hidden" class="form-control" name="no_transaksi"
                                            value="">
                                        <div class="form-group row mb-4 d-flex ml-3">
                                            <label for="nama_racikan" class="col-form-label col-md-3 text-md-right">Nama
                                                Racikan</label>
                                            <div class="col-md-4">
                                                <input id="nama_racikan" type="text" class="form-control"
                                                    name="nama_racikan">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4 d-flex ml-3">
                                            <label for="signa"
                                                class="col-form-label text-md-right col-md-3">Signa</label>
                                            <div class="col-md-6">
                                                <select class="form-control" id="signa" name="signa">
                                                    <option value="" selected disabled>Pilih Signa</option>
                                                    @foreach ($signa as $item)
                                                        <option value="{{ $item->signa_nama }}">{{ $item->signa_nama }} -
                                                            {{ $item->signa_kode }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
            var obatDropdown = document.getElementById('obat');
            var selectedObat = obatDropdown.options[obatDropdown.selectedIndex];
            var qtyValue = document.getElementById('qty').value;
            var namaObat = selectedObat.textContent;
            var stokObat = parseInt(selectedObat.getAttribute('data-stok'));
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
            obatRow.innerHTML = '<td>' + namaObat + '</td><td>' + qty +
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

            var qtyInput = document.createElement('input');
            qtyInput.type = 'hidden';
            qtyInput.name = 'qty[]';
            qtyInput.value = qty;
            form.appendChild(qtyInput);
        }

        function hapusItem(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
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
