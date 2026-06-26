<!-- overview  -->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-overview relative -smt ' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
<div class="c-main grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-12 items-end ">
        <div class="flex flex-col order-2 lg:order-none">
            @if(!empty($g_overview['title_sub']))
                <span class="block text-sm md:text-base text-secondary-500 m-title">
                    {{ $g_overview['title_sub'] }}
                </span>
            @endif
			@if(!empty($g_overview['header']))
				<h2 data-gsap-element="header" class=" mb-6">
					{{ $g_overview['header'] }}
				</h2>
				@endif
            <div data-gsap-element="text" class="_txt">
                {!! $g_overview['text'] !!}
            </div>
        </div>
        <div class="flex justify-end w-full shrink-0 order-1 lg:order-none">
            <img 
                src="{{ $g_overview['image_logo']['url'] }}" 
                alt="{{ $g_overview['image']['alt'] }}" 
                class="w-full max-w-[200px] md:max-w-[266px] h-auto object-contain shrink-0" 
            />
        </div>
    </div>
		@if (!empty($g_overview['image']))
			<div data-gsap-element="img" class="__img order1 w-full c-main pt-8">
				<img class="w-full h-full  radius max-h-[500px] object-cover"
					src="{{ $g_overview['image']['url'] }}"
					alt="{{ $g_overview['image']['alt'] ?? '' }}">
			</div>
			@endif
</section>

