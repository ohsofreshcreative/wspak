<!--- contact-block --->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-contact-block bg-primary-900 text-white -spt -spb relative -smt overflow-hidden' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="blur bg-primary-100 absolute"></div>
	<div class="second_blur bg-primary-100 absolute"></div>
	<div class="absolute right_shape z-10 block mix-blend-overlay w-[1300px] h-[1360px]  -top-10 md:-left-10 -left-6">
		<img src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg" alt="">
	</div>
	<div class="__wrapper c-main relative z-20">
		<div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-10 z-10">
			<div class="__content flex flex-col justify-between">
				@if(!empty($g_contact_1['header']))
				<h3 data-gsap-element="header" class="m-header">{!! $g_contact_1['header'] !!}</h3>
				@endif
				@if(!empty($g_contact_1['text']))
				<p data-gsap-element="txt" class="pb-6">{!! $g_contact_1['text'] !!}</p>
				@endif
				@if(!empty($g_contact_1['phone']))
				<a data-gsap-element="txt" class="__phone flex items-center mb-2" href="tel:{{ str_replace(' ', '', $g_contact_1['phone']) }}">{{ $g_contact_1['phone'] }}</a>
				@endif
				@if(!empty($g_contact_1['phone2']))
				<a data-gsap-element="txt" class="__phone flex items-center" href="tel:{{ str_replace(' ', '', $g_contact_1['phone2']) }}">{{ $g_contact_1['phone2'] }}</a>
				@endif
				@if(!empty($g_contact_1['mail']))
				<a data-gsap-element="txt" class="__mail flex items-center" href="mailto:{{ $g_contact_1['mail'] }}">{{ $g_contact_1['mail'] }}</a>
				@endif
		
			</div>
			<div data-gsap-element="form" class="bg-custom-blue radius p-8 md:p-10 z-20 relative">
				@if(!empty($g_contact_2['title']))
				<h4 class="mb-4">{!! $g_contact_2['title'] !!}</h4>
				@endif
				@if(!empty($g_contact_2['shortcode']))
				{!! do_shortcode($g_contact_2['shortcode']) !!}
				@endif
			</div>
		</div>
	</div>
</section>