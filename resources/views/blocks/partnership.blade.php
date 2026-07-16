<!-- partnership  -->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-partnership relative -smt  -spb' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main">
		<div class="grid grid-cols-1 lg:grid-cols-2 items-start gap-4 md:gap-14  z-10 relative">
			<div class="__content py-0 lg:sticky lg:top-36 flex flex-col-reverse lg:flex-col justify-center">
				<div class="">
					@if (!empty($g_partnership['title']))
					<span data-gsap-element="header" class="text-lg uppercase text-secondary ">
						{{ $g_partnership['title'] }}
					</span>
					@endif

					@if (!empty($g_partnership['header']))
					<h2 data-gsap-element="header" class="my-6">
						{{ $g_partnership['header'] }}
					</h2>
					@endif
					@if (!empty($g_partnership['txt']))
					<div data-gsap-element="txt" class="text-lg  mb-14 lg:mb-16">
						{!! $g_partnership['txt'] !!}
					</div>
					@endif
				</div>
				@if(!empty($g_partnership['image']['url']))
				<div data-gsap-element="img" class="w-full mb-10 lg:mb-0">
					<img class="object-cover w-full h-full max-h-[288px] lg:max-h-[600px]  radius" src="{{ $g_partnership['image']['url'] }}" alt="{{ $g_partnership['image']['alt'] ?? '' }}" loading="lazy">
				</div>
				@endif
			</div>

			<!-- prawa strona  -->
			<div class=" w-full z-10 relative flex flex-col gap-0 __timeline-container">
				<!-- Tło szyny linii (widoczne zawsze) -->
				<div class="__timeline-track absolute left-0 w-12 flex justify-center pointer-events-none" style="top: 30px; height: calc(100% - 60px);">
					<div class="w-px bg-secondary/20 h-full"></div>
				</div>
				<!-- Rysująca się linia postępu -->
				<div class="__timeline-progress-track absolute left-0 w-12 flex justify-center pointer-events-none" style="top: 30px; height: calc(100% - 60px);">
					<div class="__timeline-progress-bar w-[1.5px] bg-secondary h-full origin-top scale-y-0"></div>
				</div>

				@if(!empty($r_partnership))
				@foreach($r_partnership as $index => $card)
				<div data-gsap-element="stagger" class="__timeline-row flex gap-6 md:gap-8 items-start relative pb-8 last:pb-0">
					<div class="flex flex-col items-center h-full absolute top-0 bottom-0 left-0 w-12">
						<div class="__timeline-circle w-15 h-15 rounded-full flex items-center justify-center p-2 relative z-10 shrink-0 border transition-all duration-300
    {{ $loop->first ? 'bg-secondary border-secondary text-white is-active' : 'bg-white border-secondary text-secondary' }}">
							@if(!empty($card['card_image']))
							<img src="{{ $card['card_image']['url'] }}" alt="ikona" class="__img w-7 h-7 object-contain">
							@endif
						</div>
					</div>
					<div class="grow ml-20 md:ml-30 p-8 border border-primary-100 radius flex flex-col justify-center min-h-[218px] ">
						@if(!empty($card['card_text_top']))
						<span class="text-h7 font-bold text-secondary uppercase mb-8">
							{{ $card['card_text_top'] }}
						</span>
						@endif
						<h4 class="text-primary-900 mb-4 text-h6 font-normal!">
							{{ $card['card_title'] }}
						</h4>
						@if(!empty($card['card_text']))
						<p class="text-base text-primary-900  m-0">
							{{ $card['card_text'] }}
						</p>
						@endif
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</section>