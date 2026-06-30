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
	<div class="__logos mt-12 md:mt-16">
		<div class="__wrapper ">
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
	</div>
	@endif
</section>