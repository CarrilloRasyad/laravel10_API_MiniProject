{{-- resources/views/mobils/index.blade.php --}}
@extends('layouts.mobil')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Dashboard Mobil</h2>
            <button onclick="openModal('addModal')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Mobil
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Mobil</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mobil</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Polisi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="mobilTable">
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah Mobil</h3>
            <form id="addMobilForm" class="space-y-4">
                <div>
                    <input type="text" name="jenis_mobil" placeholder="Jenis Mobil" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="nama_mobil" placeholder="Nama Mobil" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="merk" placeholder="Merk" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="nopol" placeholder="No Polisi" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="harga" placeholder="Harga" class="w-full px-3 py-2 border rounded-md" required>
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Mobil</h3>
            <form id="editMobilForm" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <input type="text" name="jenis_mobil" id="edit_jenis_mobil" placeholder="Jenis Mobil" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="nama_mobil" id="edit_nama_mobil" placeholder="Nama Mobil" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="merk" id="edit_merk" placeholder="Merk" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="nopol" id="edit_nopol" placeholder="No Polisi" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="harga" id="edit_harga" placeholder="Harga" class="w-full px-3 py-2 border rounded-md" required>
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
                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Mobil</h3>
                <button onclick="closeModal('detailModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Jenis Mobil</p>
                    <p id="detail_jenis_mobil" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Nama Mobil</p>
                    <p id="detail_nama_mobil" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Merk</p>
                    <p id="detail_merk" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">No Polisi</p>
                    <p id="detail_nopol" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Harga</p>
                    <p id="detail_harga" class="text-base font-medium"></p>
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
    // Load mobil
    function loadMobil() {
        fetch('/api/mobil')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('mobilTable');
                tbody.innerHTML = '';
                
                data.data.forEach(mobil => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mobil.jenis_mobil}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mobil.nama_mobil}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mobil.merk}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mobil.nopol}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mobil.harga}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick='showDetail(${JSON.stringify(mobil).replace(/'/g, "&apos;")})' class="text-green-600 hover:text-green-900">Detail</button>
                                <button onclick='editMobil(${JSON.stringify(mobil).replace(/'/g, "&apos;")})' class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button onclick="deleteMobil(${mobil.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Add mobil
    document.getElementById('addMobilForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/api/mobil', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('addModal');
            loadMobil();
            this.reset();
        })
        .catch(error => console.error('Error:', error));
    });


    // Add new function to show detail
    function showDetail(mobil) {
        try {
            // Parse mobil if it's still a string
            if (typeof mobil === 'string') {
                mobil = JSON.parse(mobil);
            }
            
            // Populate detail modal
            document.getElementById('detail_jenis_mobil').textContent = mobil.jenis_mobil;
            document.getElementById('detail_nama_mobil').textContent = mobil.nama_mobil;
            document.getElementById('detail_merk').textContent = mobil.merk;
            document.getElementById('detail_nopol').textContent = mobil.nopol;
            document.getElementById('detail_harga').textContent = mobil.harga;
            
            // Open detail modal
            openModal('detailModal');
        } catch (error) {
            console.error('Error in showDetail:', error);
        }
    }

    // Edit mobil
    function editMobil(mobil) {
        try {
        // Parse mobil jika masih dalam bentuk string
        if (typeof mobil === 'string') {
            mobil = JSON.parse(mobil);
        }
        
        document.getElementById('edit_id').value = mobil.id;
        document.getElementById('edit_jenis_mobil').value = mobil.jenis_mobil;
        document.getElementById('edit_nama_mobil').value = mobil.nama_mobil;
        document.getElementById('edit_merk').value = mobil.merk;
        document.getElementById('edit_nopol').value = mobil.nopol;
        document.getElementById('edit_harga').value = mobil.harga;
        
        openModal('editModal');
    } catch (error) {
        console.error('Error in editMobil:', error);
    }
    }

    document.getElementById('editMobilForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        const id = data.id;
        delete data.id;

        fetch(`/api/mobil/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('editModal');
            loadMobil();
        })
        .catch(error => console.error('Error:', error));
    });

    // Delete mobil
    function deleteMobil(id) {
        if (confirm('Apakah Anda yakin ingin menghapus mobil ini?')) {
            fetch(`/api/mobil/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                loadMobil();
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

    // Load mobils on page load
    document.addEventListener('DOMContentLoaded', loadMobil);
</script>
@endpush