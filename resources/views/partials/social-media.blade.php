@php
$data_socials = $items ?? ($social_media ?? []);
$link_classes = "hover:opacity-80 transition-opacity duration-200 group";
@endphp
@if(!empty($data_socials) && is_array($data_socials))
<div class="flex items-center justify-center gap-x-3 _socials">
	@foreach($data_socials as $social)
		@if(!empty($social['link']))
		<a 
			href="{{ $social['link']['url'] }}"
			target="{{ $social['link']['target'] ?? '_blank' }}"
			class="{{ $link_classes }}"
			title="{{ $social['link']['title'] ?? $social['icon'] }}"
		>
			@if($social['icon'] === 'facebook')
				<x-icon.facebook class="w-6 h-6" />
			@elseif($social['icon'] === 'instagram')
				<x-icon.instagram class="w-6 h-6" />
			@endif
		</a>
		@endif
	@endforeach
</div>
@endif