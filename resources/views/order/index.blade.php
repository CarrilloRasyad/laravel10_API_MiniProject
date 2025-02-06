{{-- resources/views/order/index.blade.php --}}
@extends('layouts.order')

@section('judul2')
 Dashboard Order
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Dashboard Order</h2>
            <button onclick="openModal('addModal')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Order
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pembeli</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jasa Pengiriman</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="orderTable">
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
            <form id="addOrderForm" class="space-y-4">
                <div>
                    <input type="text" name="name" placeholder="Nama Pembeli" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="alamat" placeholder="Alamat" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jasa_pengiriman" placeholder="Jasa Pengiriman" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="qty" placeholder="Quantity" class="w-full px-3 py-2 border rounded-md" required>
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Order</h3>
            <form id="editOrderForm" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <input type="text" name="name" id="edit_name" placeholder="Nama Pembeli" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="alamat" id="edit_alamat" placeholder="Alamat" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jasa_pengiriman" id="edit_jasa_pengiriman" placeholder="jasa_pengiriman" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="qty" id="edit_qty" placeholder="Quantity" class="w-full px-3 py-2 border rounded-md" required>
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
                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Order</h3>
                <button onclick="closeModal('detailModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Nama Pembeli</p>
                    <p id="detail_name" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p id="detail_alamat" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Jasa Pengiriman</p>
                    <p id="detail_jasa_pengiriman" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Quantity</p>
                    <p id="detail_qty" class="text-base font-medium"></p>
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
    // Load sekolah
    function loadOrder() {
        fetch('/api/order')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('orderTable');
                tbody.innerHTML = '';
                
                data.data.forEach(order => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.name}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.alamat}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.jasa_pengiriman}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.qty}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${order.harga}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick='showDetail(${JSON.stringify(order).replace(/'/g, "&apos;")})' class="text-green-600 hover:text-green-900">Detail</button>
                                <button onclick='editOrder(${JSON.stringify(order).replace(/'/g, "&apos;")})' class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button onclick="deleteOrder(${order.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Add sekolah
    document.getElementById('addOrderForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/api/order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('addModal');
            loadOrder();
            this.reset();
        })
        .catch(error => console.error('Error:', error));
    });


    // Add new function to show detail
    function showDetail(order) {
        try {
            // Parse order if it's still a string
            if (typeof order === 'string') {
                order = JSON.parse(order);
            }
            
            // Populate detail modal
            document.getElementById('detail_name').textContent = order.name;
            document.getElementById('detail_alamat').textContent = order.alamat;
            document.getElementById('detail_jasa_pengiriman').textContent = order.jasa_pengiriman;
            document.getElementById('detail_qty').textContent = order.qty;
            document.getElementById('detail_harga').textContent = order.harga;
            
            // Open detail modal
            openModal('detailModal');
        } catch (error) {
            console.error('Error in showDetail:', error);
        }
    }

    // Edit sekolah
    function editOrder(order) {
        try {
        // Parse order jika masih dalam bentuk string
        if (typeof order === 'string') {
            order = JSON.parse(order);
        }
        
            document.getElementById('edit_id').value = order.id;
            document.getElementById('edit_name').value = order.name;
            document.getElementById('edit_alamat').value = order.alamat;
            document.getElementById('edit_jasa_pengiriman').value = order.jasa_pengiriman;
            document.getElementById('edit_qty').value = order.qty;
            document.getElementById('edit_harga').value = order.harga;

        
        openModal('editModal');
    } catch (error) {
        console.error('Error in editOrder:', error);
    }
    }

    document.getElementById('editOrderForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        const id = data.id;
        delete data.id;

        fetch(`/api/order/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('editModal');
            loadOrder();
        })
        .catch(error => console.error('Error:', error));
    });

    // Delete sekolah
    function deleteOrder(id) {
        if (confirm('Apakah Anda yakin ingin menghapus order ini?')) {
            fetch(`/api/order/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                loadOrder();
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
    document.addEventListener('DOMContentLoaded', loadOrder);
</script>
@endpush
