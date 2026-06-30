<!--- cards --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-cards relative -spt -spb overflow-hidden' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="absolute z-10 left_shape hidden xl:block"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_white.svg"></div>
	<div class="absolute z-0 lg:z-10 right_shape "><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_white.svg"></div>
	<div class="__wrapper c-main">
		<div class="__top">
			<h2 data-gsap-element="header" class="m-header">{{ strip_tags($g_cards['header']) }}</h2>
			<p data-gsap-element="text">{{ $g_cards['text'] }}</p>
		</div>

		@if (!empty($r_cards))
		@php
		$itemCount = count($r_cards);
		$gridCols = 1;
		if ($itemCount == 2) $gridCols = 2;
		if ($itemCount == 3) $gridCols = 3;
		if ($itemCount >= 4) $gridCols = 4; // Twój dotychczasowy warunek
		$gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
		@endphp

		<div class="grid {{ $gridClass }} gap-8 mt-10 text-center">
			@foreach ($r_cards as $item)
			<div data-gsap-element="card" class="__card relative bg-white p-8 radius ">
				@if (!empty($item['image']['url']))
				<div class="rounded-full overflow-hidden mb-6 w-16 h-16 mx-auto flex items-center justify-center bg-[#FFE3FD]">
					<img class="w-8 h-8 object-contain" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
				</div>
				@endif
				@if (!empty($item['title']))
				<p class="text-h7">{{ $item['title'] }}</p>
				@endif
				@if (!empty($item['text']))
				<p>{{ $item['text'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</section>