{{-- resources/views/products/index.blade.php --}}
@extends('layouts.buku')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Daftar Buku</h2>
            <button onclick="openModal('addModal')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Buku
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengarang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Publikasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="bukuTable">
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah Buku</h3>
            <form id="addBukuForm" class="space-y-4">
                <div>
                    <input type="text" name="judul" placeholder="Judul" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="pengarang" placeholder="Nama Pengarang" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="date" name="tanggal_publikasi" placeholder="Tanggal Publikasi" class="w-full px-3 py-2 border rounded-md" required>
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Buku</h3>
            <form id="editBukuForm" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <input type="text" name="judul" id="edit_judul" placeholder="Judul" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="pengarang" id="edit_pengarang" placeholder="Nama Pengarang" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="date" name="tanggal_publikasi" id="edit_tanggal_publikasi" placeholder="Tanggal Publikasi" class="w-full px-3 py-2 border rounded-md" required>
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
                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Buku</h3>
                <button onclick="closeModal('detailModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Judul</p>
                    <p id="detail_judul" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Pengarang</p>
                    <p id="detail_pengarang" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Tanggal Publikasi</p>
                    <p id="detail_tanggal_publikasi" class="text-base font-medium"></p>
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
    // Load buku
    function loadBuku() {
        fetch('/api/buku')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('bukuTable');
                tbody.innerHTML = '';
                
                data.data.forEach(buku => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${buku.judul}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${buku.pengarang}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${buku.tanggal_publikasi}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick='showDetail(${JSON.stringify(buku).replace(/'/g, "&apos;")})' class="text-green-600 hover:text-green-900">Detail</button>
                                <button onclick='editBuku(${JSON.stringify(buku).replace(/'/g, "&apos;")})' class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button onclick="deleteBuku(${buku.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Add buku
    document.getElementById('addBukuForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/api/buku', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('addModal');
            loadBuku();
            this.reset();
        })
        .catch(error => console.error('Error:', error));
    });


    // Add new function to show detail
    function showDetail(buku) {
        try {
            // Parse buku if it's still a string
            if (typeof buku === 'string') {
                buku = JSON.parse(buku);
            }
            
            // Populate detail modal
            document.getElementById('detail_judul').textContent = buku.judul;
            document.getElementById('detail_pengarang').textContent = buku.pengarang;
            document.getElementById('detail_tanggal_publikasi').textContent = buku.tanggal_publikasi;
            
            // Open detail modal
            openModal('detailModal');
        } catch (error) {
            console.error('Error in showDetail:', error);
        }
    }

    // Edit buku
    function editBuku(buku) {
        try {
        // Parse buku jika masih dalam bentuk string
        if (typeof buku === 'string') {
            buku = JSON.parse(buku);
        }
        
        document.getElementById('edit_id').value = buku.id;
        document.getElementById('edit_judul').value = buku.judul;
        document.getElementById('edit_pengarang').value = buku.pengarang;
        document.getElementById('edit_tanggal_publikasi').value = buku.tanggal_publikasi;
        
        openModal('editModal');
    } catch (error) {
        console.error('Error in editBuku:', error);
    }
    }

    document.getElementById('editBukuForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        const id = data.id;
        delete data.id;

        fetch(`/api/buku/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('editModal');
            loadBuku();
        })
        .catch(error => console.error('Error:', error));
    });

    // Delete Buku
    function deleteBuku(id) {
        if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
            fetch(`/api/buku/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                loadBuku();
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

    // Load buku on page load
    document.addEventListener('DOMContentLoaded', loadBuku);
</script>
@endpush