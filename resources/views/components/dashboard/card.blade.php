@props([
    'icon' => 'circle',
    'color' => 'gray',
    'title' => 'Título',
    'value' => '0'
])

<div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
    <div class="p-3 bg-{{ $color }}-100 rounded-full">
        <i data-lucide="{{ $icon }}" class="w-6 h-6 text-{{ $color }}-600"></i>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
        <p class="text-2xl font-bold text-gray-800">{{ $value }}</p>
    </div>
</div>
