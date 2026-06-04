@props(['title', 'subtitle'])

<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-[#0F172A]">{{ $title }}</h1>
        @if(isset($subtitle))
            <p class="text-sm text-[#64748B] mt-1">{{ $subtitle }}</p>
        @endif
    </div>
    
    @if(isset($actions))
        <div class="flex items-center gap-3">
            {{ $actions }}
        </div>
    @endif
</div>
