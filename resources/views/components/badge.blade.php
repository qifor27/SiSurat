@props(['type', 'text' => null])

@php
    $styles = [
        // Status Surat
        'draft' => 'bg-[#F8FAFC] text-[#64748B] border-[#E2E8F0]',
        'menunggu_warek' => 'bg-[#FEF3C7] text-[#B45309] border-[#FDE68A]',
        'menunggu_rektor' => 'bg-[#FEF3C7] text-[#B45309] border-[#FDE68A]',
        'selesai' => 'bg-[#D1FAE5] text-[#065F46] border-[#A7F3D0]',
        'dikembalikan' => 'bg-[#FEE2E2] text-[#991B1B] border-[#FECACA]',
        
        // Custom tambahan V2 prompt (Masuk, Proses, Selesai, Tolak)
        'masuk' => 'bg-[#EEF2FF] text-[#4338CA] border-[#C7D2FE]',
        
        // Tingkat Urgensi
        'normal' => 'bg-[#F8FAFC] text-[#64748B] border-[#E2E8F0]',
        'segera' => 'bg-[#FEF3C7] text-[#B45309] border-[#FDE68A]',
        'sangat_segera' => 'bg-[#FEE2E2] text-[#991B1B] border-[#FECACA]',
    ];

    $style = $styles[$type] ?? $styles['draft'];
    $displayText = $text ?? ucwords(str_replace('_', ' ', $type));
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold border {{ $style }}">
    {{ $displayText }}
</span>
