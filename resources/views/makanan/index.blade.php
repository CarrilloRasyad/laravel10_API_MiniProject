{{-- resources/views/products/index.blade.php --}}
@extends('layouts.makanan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Daftar Makanan</h2>
            <button onclick="openModal('addModal')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Makanan
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Makanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Makanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Negara</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rasa Makanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="makananTable">
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah Makanan</h3>
            <form id="addMakananForm" class="space-y-4">
                <div>
                    <input type="text" name="nama_makanan" placeholder="Nama Makanan" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jenis_makanan" placeholder="Jenis Makanan" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="harga" placeholder="Harga" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="asal_negara" placeholder="Asal Negara" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="rasa_makanan" placeholder="Rasa Makanan" class="w-full px-3 py-2 border rounded-md" required>
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Makanan</h3>
            <form id="editMakananForm" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <input type="text" name="nama_makanan" id="edit_nama_makanan" placeholder="Nama Makanan" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jenis_makanan" id="edit_jenis_makanan" placeholder="Jenis Makanan" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="harga" id="edit_harga" placeholder="Harga" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="asal_negara" id="edit_asal_negara" placeholder="Asal Negara" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="rasa_makanan" id="edit_rasa_makanan" placeholder="Rasa Makanan" class="w-full px-3 py-2 border rounded-md" required>
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
                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Makanan</h3>
                <button onclick="closeModal('detailModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Nama Makanan</p>
                    <p id="detail_nama_makanan" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Jenis Makanan</p>
                    <p id="detail_jenis_makanan" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Harga</p>
                    <p id="detail_harga" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Asal Negara</p>
                    <p id="detail_asal_negara" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Rasa Makanan</p>
                    <p id="detail_rasa_makanan" class="text-base font-medium"></p>
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
    // Load makanan
    function loadMakanan() {
        fetch('/api/makanan')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('makananTable');
                tbody.innerHTML = '';
                
                data.data.forEach(makanan => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${makanan.nama_makanan}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${makanan.jenis_makanan}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${makanan.harga}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${makanan.asal_negara}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${makanan.rasa_makanan}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick='showDetail(${JSON.stringify(makanan).replace(/'/g, "&apos;")})' class="text-green-600 hover:text-green-900">Detail</button>
                                <button onclick='editMakanan(${JSON.stringify(makanan).replace(/'/g, "&apos;")})' class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button onclick="deleteMakanan(${makanan.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Add makanan
    document.getElementById('addMakananForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/api/makanan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('addModal');
            loadMakanan();
            this.reset();
        })
        .catch(error => console.error('Error:', error));
    });

    // Add new function to show detail
    function showDetail(makanan) {
        try {
            // Parse makanan if it's still a string
            if (typeof makanan === 'string') {
                makanan = JSON.parse(makanan);
            }
            
            // Populate detail modal
            document.getElementById('detail_nama_makanan').textContent = makanan.nama_makanan;
            document.getElementById('detail_jenis_makanan').textContent = makanan.jenis_makanan;
            document.getElementById('detail_harga').textContent = makanan.harga;
            document.getElementById('detail_asal_negara').textContent = makanan.asal_negara;
            document.getElementById('detail_rasa_makanan').textContent = makanan.rasa_makanan;
            
            // Open detail modal
            openModal('detailModal');
        } catch (error) {
            console.error('Error in showDetail:', error);
        }
    }

    // Edit makanan
    function editMakanan(makanan) {
        try {
        // Parse makanan jika masih dalam bentuk string
        if (typeof makanan === 'string') {
            makanan = JSON.parse(makanan);
        }
        
        document.getElementById('edit_id').value = makanan.id;
        document.getElementById('edit_nama_makanan').value = makanan.nama_makanan;
        document.getElementById('edit_jenis_makanan').value = makanan.jenis_makanan;
        document.getElementById('edit_harga').value = makanan.harga;
        document.getElementById('edit_asal_negara').value = makanan.asal_negara;
        document.getElementById('edit_rasa_makanan').value = makanan.rasa_makanan;
        
        openModal('editModal');
    } catch (error) {
        console.error('Error in editMakanan:', error);
    }
    }

    document.getElementById('editMakananForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        const id = data.id;
        delete data.id;

        fetch(`/api/makanan/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('editModal');
            loadMakanan();
        })
        .catch(error => console.error('Error:', error));
    });

    // Delete Makanan
    function deleteMakanan(id) {
        if (confirm('Apakah Anda yakin ingin menghapus makanan ini?')) {
            fetch(`/api/makanan/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                loadMakanan();
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

    // Load makanan on page load
    document.addEventListener('DOMContentLoaded', loadMakanan);
</script>
@endpush