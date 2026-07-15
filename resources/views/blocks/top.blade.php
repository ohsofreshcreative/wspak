<!--- top -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-top relative -spt -spb bg-background' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="absolute z-4 left_shape "><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>
	<div class="absolute z-4 right_shape "><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>
	<div class="__wrapper c-main relative z-5">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
			@if (!empty($g_top['image']))
			<div data-gsap-element="img" class="__img h-full order1">
				<img class="radius" src="{{ $g_top['image']['url'] }}" alt="{{ $g_top['image']['alt'] ?? '' }}">
			</div>
			@endif
			<div class="__top order2">
				<h2 data-gsap-element="header" class="!text-white">{{ $g_top['header'] }}</h2>
				<div data-gsap-element="txt" class="__txt mt-4 text-white">
					{!! $g_top['text'] !!}
				</div>
				<div class="inline-buttons m-btn">
					@if (!empty($g_top['button1']))
					<x-button
						:href="$g_top['button1']['url']"
						variant="secondary"
						class=""
						data-gsap-element="btn">
						{{ $g_top['button1']['title'] }}
					</x-button>
					@endif
					@if (!empty($g_top['button2']))
					<x-button
						:href="$g_top['button2']['url']"
						variant="white"
						class=""
						data-gsap-element="btn">
						{{ $g_top['button2']['title'] }}
					</x-button>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>