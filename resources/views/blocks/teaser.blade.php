@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- teaser --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	class="b-teaser bg-background overflow-hidden mt-8 py-23 relative radius {{ $sectionClass }} {{ $section_class }}">
	@if(!empty($g_teaser['image']))
        <div class="absolute inset-0 z-1 pointer-events-none">
            <img class="w-full h-full object-cover" src="{{ $g_teaser['image']['url'] }}" alt="{{ $g_teaser['image']['alt'] ?? '' }}">
<div class="absolute inset-0 bg-[#091838]/50 mix-blend-multiply pointer-events-none"></div>     
   </div>
    @endif
	<div class="blur absolute"></div>

<div class="absolute z-4 right_shape block mix-blend-overlay"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg"></div>

	<div class=" __wrapper relative z-10">
		<div class="__inside c-main relative ">
			<div class="__content w-full xl:w-1/2 md:w-2/3 px-6 xl:pl-14 md:pr-0">
				
				<h5 data-gsap-element="header" class=" text-white ">
					{!! $g_teaser['header'] !!}
				</h5>
				<div data-gsap-element="txt" class="txt !text-2xl text-white w-full my-4 ">
					{!! $g_teaser['text'] !!}
				</div>
					@if (!empty($g_teaser['button1']))
					<x-button
						:href="$g_teaser['button1']['url']"
						variant="secondary"
						class=""
						data-gsap-element="btn">
						{{ $g_teaser['button1']['title'] }}
					</x-button>
					@endif

			</div>
		</div>
</section>