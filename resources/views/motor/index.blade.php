{{-- resources/views/motor/index.blade.php --}}
@extends('layouts.motor')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Dashboard Motor</h2>
            <button onclick="openModal('addModal')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Motor
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Motor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Motor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecepatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="motorTable">
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah Motor</h3>
            <form id="addMotorForm" class="space-y-4">
                <div>
                    <input type="text" name="nama" placeholder="Nama Motor" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="merk" placeholder="Merk" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="harga" placeholder="Harga" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jenis" placeholder="Jenis Motor" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="Kecepatan" placeholder="Kecepatan" class="w-full px-3 py-2 border rounded-md" required>
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Motor</h3>
            <form id="editMotorForm" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <input type="text" name="nama" id="edit_nama" placeholder="Nama Motor" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="merk" id="edit_merk" placeholder="Merk" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="harga" id="edit_harga" placeholder="Harga" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jenis" id="edit_jenis" placeholder="Jenis Motor" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="Kecepatan" id="edit_Kecepatan" placeholder="Kecepatan" class="w-full px-3 py-2 border rounded-md" required>
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
                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Motor</h3>
                <button onclick="closeModal('detailModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Nama Motor</p>
                    <p id="detail_nama" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Merk</p>
                    <p id="detail_merk" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Harga</p>
                    <p id="detail_harga" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Jenis Motor</p>
                    <p id="detail_jenis" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Kecepatan</p>
                    <p id="detail_Kecepatan" class="text-base font-medium"></p>
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
    // Load motor
    function loadMotor() {
        fetch('/api/motor')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('motorTable');
                tbody.innerHTML = '';
                
                data.data.forEach(motor => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${motor.nama}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${motor.merk}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${motor.harga}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${motor.jenis}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${motor.Kecepatan}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick='showDetail(${JSON.stringify(motor).replace(/'/g, "&apos;")})' class="text-green-600 hover:text-green-900">Detail</button>
                                <button onclick='editMotor(${JSON.stringify(motor).replace(/'/g, "&apos;")})' class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button onclick="deleteMotor(${motor.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Add motor
    document.getElementById('addMotorForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/api/motor', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('addModal');
            loadMotor();
            this.reset();
        })
        .catch(error => console.error('Error:', error));
    });


    // Add new function to show detail
    function showDetail(motor) {
        try {
            // Parse motor if it's still a string
            if (typeof motor === 'string') {
                motor = JSON.parse(motor);
            }
            
            // Populate detail modal
            document.getElementById('detail_nama').textContent = motor.nama;
            document.getElementById('detail_merk').textContent = motor.merk;
            document.getElementById('detail_harga').textContent = motor.harga;
            document.getElementById('detail_jenis').textContent = motor.jenis;
            document.getElementById('detail_Kecepatan').textContent = motor.Kecepatan;
            
            // Open detail modal
            openModal('detailModal');
        } catch (error) {
            console.error('Error in showDetail:', error);
        }
    }

    // Edit motor
    function editMotor(motor) {
        try {
        // Parse motor jika masih dalam bentuk string
        if (typeof motor === 'string') {
            motor = JSON.parse(motor);
        }
        
        document.getElementById('edit_id').value = motor.id;
        document.getElementById('edit_nama').value = motor.nama;
        document.getElementById('edit_merk').value = motor.merk;
        document.getElementById('edit_harga').value = motor.harga;
        document.getElementById('edit_jenis').value = motor.jenis;
        document.getElementById('edit_Kecepatan').value = motor.Kecepatan;
        
        openModal('editModal');
    } catch (error) {
        console.error('Error in editMotor:', error);
    }
    }

    document.getElementById('editMotorForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        const id = data.id;
        delete data.id;

        fetch(`/api/motor/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('editModal');
            loadMotor();
        })
        .catch(error => console.error('Error:', error));
    });

    // Delete motor
    function deleteMotor(id) {
        if (confirm('Apakah Anda yakin ingin menghapus motor ini?')) {
            fetch(`/api/motor/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                loadMotor();
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
    document.addEventListener('DOMContentLoaded', loadMotor);
</script>
@endpush