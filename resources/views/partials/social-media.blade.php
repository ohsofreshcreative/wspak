@php
$link_classes = "hover:text-secondary-100 transition-colors duration-200";
if (isset($style) && $style === 'mobile_footer') {
    $link_classes .= " bg-secondary rounded-full w-8 h-8 flex items-center justify-center";
}
@endphp

@if(!empty($social_media) && is_array($social_media))
        <div class="flex items-center gap-x-3 text-white">
            @foreach($social_media as $social)
                @if(!empty($social['link']))
                    <a href="{{ $social['link']['url'] }}" 
                       target="{{ $social['link']['target'] ?? '_blank' }}" 
                       class="{{ $link_classes }}"
                       title="{{ $social['link']['title'] ?? $social['icon'] }}">
                        
                        @if($social['icon'] === 'facebook')
                            <img src="{{ get_template_directory_uri() }}/resources/images/facebook.svg" alt="Facebook" class="w-4 h-4">
                        @elseif($social['icon'] === 'instagram')
                            <img src="{{ get_template_directory_uri() }}/resources/images/instagram.svg" alt="Instagram" class="w-4 h-4">
                        @else
                            {{-- Fallback for other icons or text --}}
                            {{ $social['link']['title'] }}
                        @endif
                    </a>
                @endif
            @endforeach
        </div>
    @endif