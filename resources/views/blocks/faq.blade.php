<!--- faq --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-faq relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-20">

		<div class="__content">
			<h2 data-gsap-element="header" class="">{{ $g_faq['header'] }}</h2>
			<div class="inline-buttons m-btn mb-6 md:mb-0">
				@if (!empty($g_faq['button']))
				<x-button
					:href="$g_faq['button']['url']"
					variant="primary"
					class=""
					data-gsap-element="btn">
					{{ $g_faq['button']['title'] }}
				</x-button>
				@endif
			</div>
		</div>
		<div data-gsap-element="tabs" class="tabs-wrapper flex flex-col mt-4">
			@foreach ($r_faq as $item)
			<div class="tabs rounded-2xl bg-white h-max">
				<input class="tab-check" type="checkbox" name="radio-a" id="check{{ $loop->index }}">
				<label class="tabs-label flex items-center justify-between" for="check{{ $loop->index }}">
					<div class="flex items-center gap-4">
						<p class="!text-lg text-h7">{{ $item['title'] }}</p>
					</div>
					<x-icon.arrow-up class="__arrow text-secondary w-6 h-6" />
				</label>
				<div class="tabs-content text-primary-900">
					{!! $item['txt'] !!}
				</div>
			</div>
			@endforeach
		</div>

	</div>

</section>