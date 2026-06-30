<!--- contact --->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-contact bg-primary-900 text-white -spt -spb relative -smt overflow-hidden ' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="second_blur bg-primary-100 absolute"></div>
	<div class="blur bg-primary-100 absolute"></div>
	<div class="absolute right_shape z-10 mix-blend-overlay w-[890px] h-[890px] lg:w-[990px] lg:h-[990px] lg:right-4 -right-30 -bottom-40 lg:bottom-auto lg:top-18 -rotate-[25deg]">
		<img class="w-full h-full" src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg">
	</div>
	<div class="__wrapper c-main  z-2">
		<div class=" grid grid-cols-1 lg:grid-cols-2 items-center gap-10 z-10">
			<div class="__content flex flex-col justify-between">
				@if(!empty($g_contact_1['header']))
				<h3 data-gsap-element="header" class="m-header">{!! $g_contact_1['header'] !!}</h3>
				@endif
				<div class="grid grid-cols-2 !items-start">
					<div class="">
						@if(!empty($g_contact_1['phone']))
						<a data-gsap-element="txt" class="__phone flex items-center mb-2" href="tel:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['phone'] }}</a>
						@endif

						@if(!empty($g_contact_1['phone2']))
						<a data-gsap-element="txt" class="__phone flex items-center" href="tel:{{ $g_contact_1['phone2'] }}">{{ $g_contact_1['phone2'] }}</a>
						@endif
					</div>
					@if(!empty($g_contact_1['mail']))
					<a data-gsap-element="txt" class="__mail flex items-center" href="mailto:{{ $g_contact_1['mail'] }}">{{ $g_contact_1['mail'] }}</a>
					@endif
				</div>
				@if(!empty($g_contact_1['text']))
				<p data-gsap-element="txt" class="py-10 ">{!! $g_contact_1['text'] !!}</p>
				@endif

				<a data-gsap-element="txt" class="__location inline-flex items-center text-white w-max !border-b !border-secondary pb-1 hover:!border-white" href="#lokalizacje">
					Zobacz na mapie
					<span class="ml-2 w-3 h-3 bg-secondary rounded-full flex items-center justify-center shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="8" height="7" viewBox="0 0 8 7" fill="none">
							<path d="M0 3.19049C0 2.8223 0.298477 2.52382 0.666667 2.52382H7.33333C7.70153 2.52382 8 2.8223 8 3.19049C8 3.55868 7.70153 3.85716 7.33333 3.85716H0.666667C0.298477 3.85716 0 3.55868 0 3.19049Z" fill="white" />
							<path d="M4.33817 0.195263C4.59851 -0.0650875 5.02063 -0.0650875 5.28097 0.195263L7.802 2.71627C8.06233 2.97662 8.06233 3.39873 7.802 3.65908C7.54167 3.91943 7.11953 3.91943 6.8592 3.65908L4.33817 1.13807C4.07781 0.877724 4.07781 0.455611 4.33817 0.195263Z" fill="white" />
							<path d="M7.802 2.72863C7.5416 2.46828 7.11953 2.46828 6.85913 2.72863L4.33815 5.24964C4.0778 5.50999 4.0778 5.9321 4.33815 6.19245C4.5985 6.45279 5.02061 6.45279 5.28096 6.19245L7.802 3.67144C8.06233 3.41109 8.06233 2.98898 7.802 2.72863Z" fill="white" />
						</svg>
					</span>
				</a>
			</div>
			<div data-gsap-element="form" class="bg-custom-blue radius p-8 md:p-10 z-20 ">
				@if(!empty($g_contact_2['title']))
				<h4 class=" mb-4">{!! $g_contact_2['title'] !!}</h4>
				@endif
				@if(!empty($g_contact_2['shortcode']))
				{!! do_shortcode($g_contact_2['shortcode']) !!}
				@endif
			</div>
		</div>
	</div>
</section>