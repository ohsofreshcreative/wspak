<!-- hero  -->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-hero bg-background relative text-white pt-[30px] lg:pt-[90px]  pb-[310px] ' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="absolute z-1 lg:z-4 left_shape "><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>
	<div class="absolute z-1  lg:z-4 right_shape "><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>

	<div class="c-main mx-auto px-4 flex flex-col gap-12">
		<div class="w-full text-left">
			@php
			$carouselWords = collect($g_hero['r_hero'] ?? [])->pluck('title')->filter()->toArray();
			$wordCount = count($carouselWords);
			@endphp

			<h1 class="hero-main-title flex flex-wrap items-baseline gap-y-2 w-full md:w-2/3 font-light">
				<span class="title-part ">{{ $g_hero['title'] ?? '' }}</span>

				@if($wordCount > 0)
				<span class="text-carousel-container font-semibold">
					<span class="text-carousel-slider " style="--steps: {{ $wordCount }};">
						@foreach($carouselWords as $word)
						<span class="text-carousel-item uppercase">{{ $word }}</span>
						@endforeach
						<span class="text-carousel-item ">{{ $carouselWords[0] }}</span>
					</span>
				</span>
				@endif
				<span class="title-part">{{ $g_hero['title2'] ?? '' }}</span>
			</h1>
		</div>
	</div>
</section>
<div class="c-main">
	<video
		autoplay
		muted
		loop
		playsinline
		class="w-full h-[400px] md:h-[500px] object-cover -mt-[250px] radius relative z-3">
		<source src="{{ $g_hero['video'] ?? '' }}" type="video/mp4">
	</video>
</div>

<section class="bg-bg relative z-10 py-20 md:py-40">
	<div class="c-main grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-12 items-center">
		<div class="lg:col-span-9 flex flex-col text-left order-2 lg:order-none">
			@if(!empty($g_hero['title_sub']))
			<span class="block text-sm md:text-base text-secondary-500 m-title">
				{{ $g_hero['title_sub'] }}
			</span>
			@endif
			<div data-gsap-element="text" class="text-h3">
				{!! $g_hero['text'] !!}
			</div>
		</div>
		<div class="lg:col-span-3 flex justify-end w-full shrink-0 order-1 lg:order-none">
			<img
				src="{{ $g_hero['image']['url'] }}"
				alt="{{ $g_hero['image']['alt'] }}"
				class="w-full max-w-[266px] h-auto object-contain shrink-0" />
		</div>
	</div>
</section>
