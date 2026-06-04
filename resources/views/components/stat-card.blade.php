@props(['title', 'value', 'icon', 'color' => 'blue', 'footer' => null, 'footerColor' => 'gray'])

@php
    $bgColors = [
        'blue' => 'bg-[#DBEAFE] text-[#1E40AF]',
        'amber' => 'bg-[#FEF3C7] text-[#B45309]',
        'green' => 'bg-[#D1FAE5] text-[#047857]',
        'purple' => 'bg-[#F3E8FF] text-[#7E22CE]',
        'gray' => 'bg-gray-100 text-gray-600',
    ];

    $textColors = [
        'blue' => 'text-[#2563EB]',
        'amber' => 'text-[#F59E0B]',
        'green' => 'text-[#10B981]',
        'red' => 'text-[#EF4444]',
        'gray' => 'text-[#64748B]',
    ];

    $iconBg = $bgColors[$color] ?? $bgColors['gray'];
    $footerText = $textColors[$footerColor] ?? $textColors['gray'];
@endphp

<div class="card-enterprise p-6">
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm font-medium text-[#64748B]">{{ $title }}</p>
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $iconBg }}">
            <i data-lucide="{{ $icon }}" class="w-6 h-6"></i>
        </div>
    </div>
    
    <p class="text-4xl font-bold text-[#0F172A] mb-2">{{ $value }}</p>
    
    @if($footer)
        <p class="text-sm font-medium {{ $footerText }} flex items-center gap-1">
            {{ $footer }}
        </p>
    @endif
</div>
