{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Daftar Produk</h2>
            <button onclick="openModal('addModal')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Produk
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jasa Pengiriman</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="productsTable">
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah Produk</h3>
            <form id="addProductForm" class="space-y-4">
                <div>
                    <input type="text" name="nama" placeholder="Nama Produk" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="merk" placeholder="Merk" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jasa_pengiriman" placeholder="Jasa Pengiriman" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="berat" placeholder="Berat" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="alamat" placeholder="Alamat" class="w-full px-3 py-2 border rounded-md" required>
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
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Produk</h3>
            <form id="editProductForm" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <input type="text" name="nama" id="edit_nama" placeholder="Nama Produk" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="merk" id="edit_merk" placeholder="Merk" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="jasa_pengiriman" id="edit_jasa_pengiriman" placeholder="Jasa Pengiriman" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="number" name="berat" id="edit_berat" placeholder="Berat" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <input type="text" name="alamat" id="edit_alamat" placeholder="Alamat" class="w-full px-3 py-2 border rounded-md" required>
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
                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Product</h3>
                <button onclick="closeModal('detailModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Nama Produk</p>
                    <p id="detail_nama" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Merk</p>
                    <p id="detail_merk" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Jasa Pengiriman</p>
                    <p id="detail_jasa_pengiriman" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Berat</p>
                    <p id="detail_berat" class="text-base font-medium"></p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p id="detail_alamat" class="text-base font-medium"></p>
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
    // Load products
    function loadProducts() {
        fetch('/api/product')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('productsTable');
                tbody.innerHTML = '';
                
                data.data.forEach(product => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${product.nama}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${product.merk}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${product.jasa_pengiriman}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${product.berat}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${product.alamat}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${product.qty}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${product.harga}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick='showDetail(${JSON.stringify(product).replace(/'/g, "&apos;")})' class="text-green-600 hover:text-green-900">Detail</button>
                                <button onclick='editProduct(${JSON.stringify(product).replace(/'/g, "&apos;")})' class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button onclick="deleteProduct(${product.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Add product
    document.getElementById('addProductForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/api/product', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('addModal');
            loadProducts();
            this.reset();
        })
        .catch(error => console.error('Error:', error));
    });


    // Add new function to show detail
    function showDetail(product) {
        try {
            // Parse product if it's still a string
            if (typeof product === 'string') {
                product = JSON.parse(product);
            }
            
            // Populate detail modal
            document.getElementById('detail_nama').textContent = product.nama;
            document.getElementById('detail_merk').textContent = product.merk;
            document.getElementById('detail_jasa_pengiriman').textContent = product.jasa_pengiriman;
            document.getElementById('detail_berat').textContent = product.berat;
            document.getElementById('detail_alamat').textContent = product.alamat;
            document.getElementById('detail_qty').textContent = product.qty;
            document.getElementById('detail_harga').textContent = product.harga;
            
            // Open detail modal
            openModal('detailModal');
        } catch (error) {
            console.error('Error in showDetail:', error);
        }
    }

    // Edit product
    function editProduct(product) {
        try {
        // Parse product jika masih dalam bentuk string
        if (typeof product === 'string') {
            product = JSON.parse(product);
        }
        
        document.getElementById('edit_id').value = product.id;
        document.getElementById('edit_nama').value = product.nama;
        document.getElementById('edit_merk').value = product.merk;
        document.getElementById('edit_jasa_pengiriman').value = product.jasa_pengiriman;
        document.getElementById('edit_berat').value = product.berat;
        document.getElementById('edit_alamat').value = product.alamat;
        document.getElementById('edit_qty').value = product.qty;
        document.getElementById('edit_harga').value = product.harga;
        
        openModal('editModal');
    } catch (error) {
        console.error('Error in editProduct:', error);
    }
    }

    document.getElementById('editProductForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        const id = data.id;
        delete data.id;

        fetch(`/api/product/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            closeModal('editModal');
            loadProducts();
        })
        .catch(error => console.error('Error:', error));
    });

    // Delete product
    function deleteProduct(id) {
        if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
            fetch(`/api/product/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                loadProducts();
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
    document.addEventListener('DOMContentLoaded', loadProducts);
</script>
@endpush