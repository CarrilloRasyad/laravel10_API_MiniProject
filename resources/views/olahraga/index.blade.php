{{-- resources/views/olahraga/index.blade.php --}}
@extends('layouts.olahraga')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Dashboard Olahraga</h2>
            <button onclick="openModal('addModal')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Olahraga
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cabang Olahraga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Olahraga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pemain</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi Bermain</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="olahragaTable">
                    {{-- Data will be loaded here via JavaScript --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah Olahraga</h3>
            <form id="addOlahragaForm" class="space-y-4">
                <div>
                    <input type="text" name="cabor" placeholder="Cabang Olahraga" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jenis_olahraga" placeholder="Jenis Olahraga" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="jumlah_pemain" placeholder="Jumlah Pemain" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="lokasi_bermain" placeholder="Lokasi Bermain" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="deskripsi" placeholder="Deskripsi" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal('addModal')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Olahraga</h3>
            <form id="editOlahragaForm" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <input type="text" name="cabor" id="edit_cabor" placeholder="Cabang Olahraga" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jenis_olahraga" id="edit_jenis_olahraga" placeholder="Jenis Olahraga" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="jumlah_pemain" id="edit_jumlah_pemain" placeholder="Jumlah Pemain" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="lokasi_bermain" id="edit_lokasi_bermain" placeholder="Lokasi Bermain" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="deskripsi" id="edit_deskripsi" placeholder="Deskripsi" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Detail Modal --}}
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Olahraga</h3>
                <button onclick="closeModal('detailModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Cabang Olahraga</p>
                    <p id="detail_cabor" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Jenis Olahraga</p>
                    <p id="detail_jenis_olahraga" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Jumlah Pemain</p>
                    <p id="detail_jumlah_pemain" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Lokasi Bermain</p>
                    <p id="detail_lokasi_bermain" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Deskripsi</p>
                    <p id="detail_deskripsi" class="text-base font-medium"></p>
                </div>
            </div>
            <div class="mt-6">
                <button onclick="closeModal('detailModal')" class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Load olahraga
    function loadOlahraga() {
        fetch('/api/olahraga')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('olahragaTable');
                tbody.innerHTML = '';
                
                data.data.forEach(olahraga => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${olahraga.cabor}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${olahraga.jenis_olahraga}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${olahraga.jumlah_pemain}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${olahraga.lokasi_bermain}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${olahraga.deskripsi}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick='showDetail(${JSON.stringify(olahraga).replace(/'/g, "&apos;")})' class="text-green-600 hover:text-green-900">Detail</button>
                                <button onclick='editOlahraga(${JSON.stringify(olahraga).replace(/'/g, "&apos;")})' class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button onclick="deleteOlahraga(${olahraga.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Add olahraga
    document.getElementById('addOlahragaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/api/olahraga', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('addModal');
            loadOlahraga();
            this.reset();
        })
        .catch(error => console.error('Error:', error));
    });


    // Add new function to show detail
    function showDetail(olahraga) {
        try {
            // Parse olahraga if it's still a string
            if (typeof olahraga === 'string') {
                olahraga = JSON.parse(olahraga);
            }
            
            // Populate detail modal
            document.getElementById('detail_cabor').textContent = olahraga.cabor;
            document.getElementById('detail_jenis_olahraga').textContent = olahraga.jenis_olahraga;
            document.getElementById('detail_jumlah_pemain').textContent = olahraga.jumlah_pemain;
            document.getElementById('detail_lokasi_bermain').textContent = olahraga.lokasi_bermain;
            document.getElementById('detail_deskripsi').textContent = olahraga.deskripsi;
            
            // Open detail modal
            openModal('detailModal');
        } catch (error) {
            console.error('Error in showDetail:', error);
        }
    }

    // Edit olahraga
    function editOlahraga(olahraga) {
        try {
        // Parse olahraga jika masih dalam bentuk string
        if (typeof olahraga === 'string') {
            olahraga = JSON.parse(olahraga);
        }
        
        document.getElementById('edit_id').value = olahraga.id;
        document.getElementById('edit_cabor').value = olahraga.cabor;
        document.getElementById('edit_jenis_olahraga').value = olahraga.jenis_olahraga;
        document.getElementById('edit_jumlah_pemain').value = olahraga.jumlah_pemain;
        document.getElementById('edit_lokasi_bermain').value = olahraga.lokasi_bermain;
        document.getElementById('edit_deskripsi').value = olahraga.deskripsi;
        
        openModal('editModal');
    } catch (error) {
        console.error('Error in editOlahraga:', error);
    }
    }

    document.getElementById('editOlahragaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        const id = data.id;
        delete data.id;

        fetch(`/api/olahraga/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('editModal');
            loadOlahraga();
        })
        .catch(error => console.error('Error:', error));
    });

    // Delete olahraga
    function deleteOlahraga(id) {
        if (confirm('Apakah Anda yakin ingin menghapus olahraga ini?')) {
            fetch(`/api/olahraga/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                loadOlahraga();
            })
            .catch(error => console.error('Error:', error));
        }
    }

    // Modal functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Load products on page load
    document.addEventListener('DOMContentLoaded', loadOlahraga);
</script>
@endpush
