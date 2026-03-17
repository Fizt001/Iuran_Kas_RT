<x-sidebar-layout>
    <x-slot name="header">
        Dashboard {{ ucfirst(Auth::user()->role) }} - {{ config('app.rt_identity') }} 
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-gray-500 text-sm font-medium">Total Kas RT</h3>
            <p class="text-3xl font-bold text-indigo-600">Rp 0</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-gray-500 text-sm font-medium">Jumlah Warga</h3>
            <p class="text-3xl font-bold text-gray-800">0</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-gray-500 text-sm font-medium">Status Iuran Anda</h3>
            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Lunas</span>
        </div>
    </div>
</x-sidebar-layout>