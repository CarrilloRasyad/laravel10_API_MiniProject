{{-- resources/views/sekolah/index.blade.php --}}
@extends('layouts.sekolah')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Dashboard Sekolah</h2>
            <button onclick="openModal('addModal')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Guru
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Guru</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NUPTK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Umur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wali Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gaji</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="sekolahTable">
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah Guru</h3>
            <form id="addSekolahForm" class="space-y-4">
                <div>
                    <input type="text" name="nama_guru" placeholder="Nama Guru" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="email" placeholder="Email" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="NUPTK" placeholder="NUPTK" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="umur" placeholder="Umur" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jenis_kelamin" placeholder="Jenis Kelamin" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="wali_kelas" placeholder="Wali Kelas" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="matpel" placeholder="Mata Pelajaran" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="gaji" placeholder="Gaji" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="alamat" placeholder="Alamat" class="w-full px-3 py-2 border rounded-md" required>
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Sekolah</h3>
            <form id="editSekolahForm" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <input type="text" name="nama_guru" id="edit_nama_guru" placeholder="Nama Guru" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="email" id="edit_email" placeholder="Email" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="NUPTK" id="edit_NUPTK" placeholder="NUPTK" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="umur" id="edit_umur" placeholder="Lokasi Bermain" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jenis_kelamin" id="edit_jenis_kelamin" placeholder="Jenis Kelamin" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="wali_kelas" id="edit_wali_kelas" placeholder="JWali Kelas" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="matpel" id="edit_matpel" placeholder="Mata Pelajaran" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="gaji" id="edit_gaji" placeholder="Gaji" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="alamat" id="edit_alamat" placeholder="Alamat" class="w-full px-3 py-2 border rounded-md" required>
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
                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Guru</h3>
                <button onclick="closeModal('detailModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Nama Guru</p>
                    <p id="detail_nama_guru" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Email</p>
                    <p id="detail_email" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">NUPTK</p>
                    <p id="detail_NUPTK" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Umur</p>
                    <p id="detail_umur" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Jenis Kelamin</p>
                    <p id="detail_jenis_kelamin" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Wali Kelas</p>
                    <p id="detail_wali_kelas" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Mata Pelajaran</p>
                    <p id="detail_matpel" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Gaji</p>
                    <p id="detail_gaji" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p id="detail_alamat" class="text-base font-medium"></p>
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
    // Load sekolah
    function loadSekolah() {
        fetch('/api/sekolah')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('sekolahTable');
                tbody.innerHTML = '';
                
                data.data.forEach(sekolah => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sekolah.nama_guru}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sekolah.email}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sekolah.NUPTK}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sekolah.umur}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sekolah.jenis_kelamin}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sekolah.wali_kelas}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sekolah.matpel}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sekolah.gaji}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sekolah.alamat}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick='showDetail(${JSON.stringify(sekolah).replace(/'/g, "&apos;")})' class="text-green-600 hover:text-green-900">Detail</button>
                                <button onclick='editSekolah(${JSON.stringify(sekolah).replace(/'/g, "&apos;")})' class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button onclick="deleteSekolah(${sekolah.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Add sekolah
    document.getElementById('addSekolahForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/api/sekolah', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('addModal');
            loadSekolah();
            this.reset();
        })
        .catch(error => console.error('Error:', error));
    });


    // Add new function to show detail
    function showDetail(sekolah) {
        try {
            // Parse sekolah if it's still a string
            if (typeof sekolah === 'string') {
                sekolah = JSON.parse(sekolah);
            }
            
            // Populate detail modal
            document.getElementById('detail_nama_guru').textContent = sekolah.nama_guru;
            document.getElementById('detail_email').textContent = sekolah.email;
            document.getElementById('detail_NUPTK').textContent = sekolah.NUPTK;
            document.getElementById('detail_umur').textContent = sekolah.umur;
            document.getElementById('detail_jenis_kelamin').textContent = sekolah.jenis_kelamin;
            document.getElementById('detail_wali_kelas').textContent = sekolah.wali_kelas;
            document.getElementById('detail_matpel').textContent = sekolah.matpel;
            document.getElementById('detail_gaji').textContent = sekolah.gaji;
            document.getElementById('detail_alamat').textContent = sekolah.alamat;
            
            // Open detail modal
            openModal('detailModal');
        } catch (error) {
            console.error('Error in showDetail:', error);
        }
    }

    // Edit sekolah
    function editSekolah(sekolah) {
        try {
        // Parse sekolah jika masih dalam bentuk string
        if (typeof sekolah === 'string') {
            sekolah = JSON.parse(sekolah);
        }
        
            document.getElementById('edit_id').value = sekolah.id;
            document.getElementById('edit_nama_guru').value = sekolah.nama_guru;
            document.getElementById('edit_email').value = sekolah.email;
            document.getElementById('edit_NUPTK').value = sekolah.NUPTK;
            document.getElementById('edit_umur').value = sekolah.umur;
            document.getElementById('edit_jenis_kelamin').value = sekolah.jenis_kelamin;
            document.getElementById('edit_wali_kelas').value = sekolah.wali_kelas;
            document.getElementById('edit_matpel').value = sekolah.matpel;
            document.getElementById('edit_gaji').value = sekolah.gaji;
            document.getElementById('edit_alamat').value = sekolah.alamat;
        
        openModal('editModal');
    } catch (error) {
        console.error('Error in editSekolah:', error);
    }
    }

    document.getElementById('editSekolahForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        const id = data.id;
        delete data.id;

        fetch(`/api/sekolah/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('editModal');
            loadSekolah();
        })
        .catch(error => console.error('Error:', error));
    });

    // Delete sekolah
    function deleteSekolah(id) {
        if (confirm('Apakah Anda yakin ingin menghapus guru ini?')) {
            fetch(`/api/sekolah/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                loadSekolah();
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
    document.addEventListener('DOMContentLoaded', loadSekolah);
</script>
@endpush
