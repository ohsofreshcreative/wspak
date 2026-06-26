@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- community --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	class="b-community bg-background overflow-hidden -smt -spt -spb relative {{ $sectionClass }} {{ $section_class }}">
	<div class="blur absolute"></div>
<div class="absolute z-4 left_shape hidden xl:block"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>
<div class="absolute z-4 right_shape hidden xl:block mix-blend-overlay"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg"></div>

	<div class=" __wrapper relative">
		<div class="__inside c-main relative">
			<div class="__content c-main text-center">
				@if(!empty($g_community['title_sub']))
				<span class="block text-sm md:text-base text-secondary-500 m-title">
					{{ $g_community['title_sub'] }}
				</span>
				@endif
				<h1 data-gsap-element="header" class=" text-white m-header">
					{!! $g_community['header'] !!}
				</h1>
				<div data-gsap-element="txt" class="txt !text-2lg text-white w-full mt-auto">
					{!! $g_community['text'] !!}
				</div>
<div class="_socials flex justify-center mt-6">

@include('partials.social-media', ['custom_color' => 'secondary'])
</div>
			</div>
		</div>
</section>