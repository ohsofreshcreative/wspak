<!--- reviews -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-reviews relative overflow-hidden -spt -spb bg-[#091838]' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="blur bg-primary-100"></div>
	<div class="second_blur bg-primary-100"></div>
	<div class="absolute right_shape z-12 hidden md:block"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg"></div>

	<div class="absolute gradient-left inset-y-0 left-0 md:w-[24vw] w-[14vw] z-10" style="background: linear-gradient(90deg, #091838 0%, rgba(9, 24, 56, 0.00) 100%);"></div>
	<div class="absolute gradient-right inset-y-0 right-0 md:w-[24vw] w-[14vw] z-10" style="background: linear-gradient(90deg, rgba(9, 24, 56, 0.00) 0%, #091838 100%);"></div>

	<div class="__wrapper c-main">
		<div class="__content">
			<div data-gsap-element="header" class="__wrapper relative block w-full z-20 pb-10">
				<h2 class="text-center !text-secondary">{{ $g_reviews['title']}}</h2>
			</div>
			<div class="relative pt-16 md:pt-10">
				<div class="absolute inset-x-0 top-1/2 -translate-y-1/2 z-30 pointer-events-none">
					<button class="__prev absolute left-2 top-1/2 -translate-y-1/2 pointer-events-auto hover:opacity-80 transition-opacity duration-300">
						<x-icon.arrow-left class="h-10 w-auto" />
					</button>
					<button class="__next absolute right-2 top-1/2 -translate-y-1/2 pointer-events-auto hover:opacity-80 transition-opacity duration-300">
						<x-icon.arrow-right class="h-10 w-auto" />
					</button>
				</div>
				<div data-gsap-element="swiper" class="swiper reviews-swiper !overflow-visible">
					<div class="swiper-wrapper flex">
						@foreach($r_reviews as $card)
						<div class="swiper-slide !w-full md:!w-[calc(100%/1.5)] md:!max-w-[calc(100%/1.5)] !px-5 md:!px-14">
							<div data-gsap-element="card" class="__card relative  md:py-14">
								<div class="relative text-white flex flex-col z-10 px-10">
									@if(!empty($card['txt']))
									<img class="absolute -top-20 -left-2" src="{{ get_template_directory_uri() }}/resources/images/quote.svg" />
									<div class="__content relative z-10">
										<p class="__txt block text-xl md:text-2xl !mb-9">{!! $card['txt'] !!}</p>
										<b class="font-header  md:text-xl">{{ $card['name'] }}</b>
										<b class="font-header  md:text-xl">{{ $card['text'] }}</b>
									</div>
									@endif
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>