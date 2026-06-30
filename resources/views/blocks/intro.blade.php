<!--- intro -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-intro relative -smt mb-20 md:-mb-28 z-10' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="__wrapper c-main relative ">
		<div class="__col grid grid-cols-1 xl:grid-cols-2 items-center md:mb-12 mb-8">
			<div class="flex md:gap-14 gap-6">
				@if (!empty($g_intro['icon']))
				<div data-gsap-element="img" class="__img h-full order1">
					<img class=" shrink-0 h-10 w-10" src="{{ $g_intro['icon']['url'] }}" alt="{{ $g_intro['icon']['alt'] ?? '' }}">
				</div>
				@endif
				<h3 data-gsap-element="header" class="m-title">{{ $g_intro['header'] }}</h3>
			</div>
			<div data-gsap-element="txt" class="__txt ">
				{!! $g_intro['text'] !!}
			</div>
		</div>
		@if (!empty($g_intro['image']))
		<div data-gsap-element="img" class="__img h-full order1 max-h-[545px]  ">
			<img class="radius h-auto w-full max-h-[400px]  md:max-h-[545px] object-cover" src="{{ $g_intro['image']['url'] }}" alt="{{ $g_intro['image']['alt'] ?? '' }}">
		</div>
		@endif
	</div>
</section>