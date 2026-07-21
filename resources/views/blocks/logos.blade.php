@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}
@endphp
<!-- logos  -->
<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-logos relative -smt -spb {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main relative">
		<h2 data-gsap-element="header" class="w-full mb-8 md:mb-12">{{ $g_logos['title'] }}</h2>
	</div>
	@if (!empty($g_logos['gallery']))
	<div data-gsap-element="logos" class="__logos mt-10 md:mt-12 relative">
		<div class="absolute inset-x-0 top-1/2 -translate-y-1/2 z-30 pointer-events-none">
		</div>
		<div class="__wrapper js-logo-slider">
			@foreach ($g_logos['gallery'] as $image)
			<div class="__slide border border-primary-100 radius bg-white flex items-center justify-center p-6 min-w-[300px] max-w-[300px] md:min-w-[320px] md:max-w-[320px] h-[152px] flex-shrink-0">
				<img src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? '' }}" class="max-w-full max-h-full object-contain w-auto h-auto pointer-events-none select-none">
			</div>
			@endforeach
			@foreach ($g_logos['gallery'] as $image)
			<div class="__slide border border-primary-100 radius bg-white flex items-center justify-center p-6 min-w-[300px] max-w-[300px] md:min-w-[320px] md:max-w-[320px] h-[152px] flex-shrink-0">
				<img src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? '' }}" class="max-w-full max-h-full object-contain w-auto h-auto pointer-events-none select-none">
			</div>
			@endforeach
		</div>
		<div class="c-main  relative pt-10">
			<button class="js-logo-prev  pointer-events-auto hover:opacity-80 transition-opacity duration-300 cursor-pointer mr-2">
				<x-icon.arrow-left class="h-10 w-auto" />
			</button>
			<button class="js-logo-next  pointer-events-auto hover:opacity-80 transition-opacity duration-300 cursor-pointer">
				<x-icon.arrow-right class="h-10 w-auto" />
			</button>
		</div>
	</div>
	@endif
</section>