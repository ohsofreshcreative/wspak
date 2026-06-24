@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- banner --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	class="b-banner bg-background pt-0lg:pt-[90px]  lg:pb-[200px] pb-[100px] relative {{ $sectionClass }} {{ $section_class }}">

<div class="absolute z-4 left_shape hidden xl:block"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>
<div class="absolute z-4 right_shape hidden xl:block"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>

	<div class=" __wrapper relative">
		<div class="__inside c-main relative">
			<div class="__content py-20 grid grid-cols-1 md:grid-cols-2 c-main">
					<h1 data-gsap-element="header" class=" text-white m-header">
						{!! $g_banner['header'] !!}
					</h1>
					<div data-gsap-element="txt" class="txt !text-2lg text-white w-full mt-auto">
						{!! $g_banner['text'] !!}
					</div>
					
				
			</div>
		</div>
		

</section>