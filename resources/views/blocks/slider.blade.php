@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $nolist ? ' no-list' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}
@endphp

<!--- slider --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-slider bg-gradient-main relative overflow-hidden text-white -spt -spb {{ $sectionClass }} {{ $section_class }}">
	<div data-gsap-element="img" class="absolute z-4 left_shape"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>
	<div data-gsap-element="img" class="absolute z-4 right_shape"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg"></div>
	<div class="__wrapper c-main block relative z-20 text-center">
		@if(!empty($g_slider['title']))
		<h2 data-gsap-element="header" class="text-center !text-white m-header">{{ $g_slider['title']}}</h2>
		@endif
		@if(!empty($g_slider['text']))
		<div data-gsap-element="txt" class="__txt text-white max-w-2xl mx-auto mb-14 text-lg">
			{!! $g_slider['text'] !!}
		</div>
		@endif
	</div>
	<div data-gsap-element="slider" class="relative c-main z-20">
		<div class="absolute inset-x-0 top-1/2 -translate-y-1/2 z-30 pointer-events-none ">
			<button class="js-slider-prev absolute left-2 top-1/2 -translate-y-1/2 pointer-events-auto opacity-100 hover:opacity-80 transition-opacity duration-300">
				<x-icon.arrow-left class="cursor-pointer h-10 w-auto" />
			</button>
			<button class="js-slider-next absolute right-2 top-1/2 -translate-y-1/2 pointer-events-auto opacity-100 hover:opacity-80 transition-opacity duration-300">
				<x-icon.arrow-right class="cursor-pointer h-10 w-auto" />
			</button>
		</div>
		<div class="swiper slider-standard mx-12 lg:mx-18">
			<div class="swiper-wrapper">
				@foreach($slider as $slide)
				<div class="swiper-slide w-full">
					<div class="grid grid-cols-1 lg:grid-cols-2  md:gap-6 gap-14 items-center min-h-[450px]">
						<div class="flex flex-col order-2 lg:order-1">
							@if(!empty($slide['header']))
							<h3 class="text-white m-title">
								{{ $slide['header'] }}
							</h3>
							@endif
							@if(!empty($slide['opis']))
							<div class="md:text-lg !font-medium">
								{!! $slide['opis'] !!}
							</div>
							@endif
						</div>
						<div class="w-full max-h-100 xl:max-h-110  md:aspect-square order-1 lg:order-2">
							@if(!empty($slide['image']))
							<img src="{{ $slide['image']['url'] }}" alt="{{ $slide['header'] ?? '' }}" class="w-full h-full object-cover radius max-h-100 xl:max-h-110">
							@endif
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>