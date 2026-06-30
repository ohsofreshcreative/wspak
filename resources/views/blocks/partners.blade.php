<!-- partners -->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-partners relative -spt -spb overflow-hidden' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])
	>
	<div class="__wrapper c-main">
		@if (!empty($g_partners['header']))
		<h2 data-gsap-element="header" class="mb-8 md:mb-12">
			{{ strip_tags($g_partners['header']) }}
		</h2>
		@endif
	</div>
	@if (!empty($r_partners))
	<div class="relative w-full overflow-hidden">
		<div class="swiper partners-ticker w-full !overflow-visible">
			<div class="swiper-wrapper ease-linear">

				@foreach ($r_partners as $item)
				@if (!empty($item['image']['url']))

				<div class=" swiper-slide !w-[320px] border border-primary-100 radius bg-white flex items-center justify-center p-6">
					<img
						class=" h-26  object-contain mx-auto"
						src="{{ $item['image']['url'] }}"
						alt="{{ $item['image']['alt'] ?? 'Partner' }}">
				</div>
				@endif
				@endforeach
			</div>
		</div>
	</div>
	@endif
</section>