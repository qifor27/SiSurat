@props(['icon', 'title', 'description'])

<div class="flex flex-col items-center justify-center py-16 text-center">
    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6">
        <i data-lucide="{{ $icon }}" class="w-10 h-10 text-gray-400"></i>
    </div>
    <h3 class="text-lg font-semibold text-[#0F172A] mb-2">{{ $title }}</h3>
    <p class="text-sm text-[#64748B] max-w-sm mx-auto mb-6">
        {{ $description }}
    </p>
    
    @if(isset($action))
        <div>
            {{ $action }}
        </div>
    @endif
</div>
