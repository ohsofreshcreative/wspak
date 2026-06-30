@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}

$grouped_tabs = [];
if (!empty($r_tabs)) {
foreach ($r_tabs as $item) {
$tabName = $item['tab'] ?: 'Inne';
if (!isset($grouped_tabs[$tabName])) {
$grouped_tabs[$tabName] = [];
}
$grouped_tabs[$tabName][] = $item;
}
}
@endphp

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-tabs relative -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main relative">
		@if (!empty($g_tabs['header']))
		<div class=" text-center">
			<h2 data-gsap-element="header" class="m-header">{{ $g_tabs['header'] }}</h2>
			@if(!empty($g_tabs['text']))
			<div class="__txt mt-4 max-w-3xl mx-auto">
				{!! $g_tabs['text'] !!}
			</div>
			@endif
		</div>
		@endif

		@if(!empty($grouped_tabs))
		<div x-data="{ activeTab: 0 }" class="">
			<div class="flex justify-center flex-wrap gap-4 m-header ">
				@foreach ($grouped_tabs as $name => $items)
				<button
					@click="activeTab = {{ $loop->index }}"
					:class="{ 
                        'bg-secondary text-white border border-transparent': activeTab === {{ $loop->index }}, 
                        'bg-white border border-secondary text-secondary hover:bg-gray-50': activeTab !== {{ $loop->index }} 
                    }"
					class="text-base font-semibold whitespace-nowrap py-3 px-6 rounded-full transition-all duration-200 focus:outline-none">
					{{ $name }}
				</button>
				@endforeach
			</div>
			<div>
				@foreach ($grouped_tabs as $name => $items)
				<div x-show="activeTab === {{ $loop->index }}" x-cloak class="transition-opacity duration-300">
					@foreach ($items as $item)
					<div class="grid grid-cols-1 xl:grid-cols-2 gap-8 lg:gap-16 items-center">
						@if(!empty($item['images']))
						<div x-data="{ activeSlide: 0, totalSlides: {{ count($item['images']) }} }" class="relative w-full z-20">
							<div class="relative aspect-4/3 xl:aspect-auto xl:h-142 w-full radius overflow-hidden  z-10">
								<div class="w-full h-full relative">
									@foreach ($item['images'] as $imgIndex => $img)
									<div x-show="activeSlide === {{ $imgIndex }}"
										x-transition:enter="transition ease-in-out duration-500 absolute inset-0"
										x-transition:enter-start="opacity-0 scale-102"
										x-transition:enter-end="opacity-100 scale-100"
										x-transition:leave="transition ease-in-out duration-500 absolute inset-0"
										x-transition:leave-start="opacity-100 scale-100"
										x-transition:leave-end="opacity-0 scale-98"
										class="absolute inset-0 w-full h-full">
										<img class="w-full h-full object-cover" src="{{ $img['url'] }}" alt="{{ $img['alt'] ?? '' }}" />
									</div>
									@endforeach
								</div>
							</div>
							@if(count($item['images']) > 1)
							<div class="absolute top-1/2 left-0 w-full -translate-y-1/2 flex justify-between items-center pointer-events-none z-50">
								<div @click="activeSlide = (activeSlide === 0) ? totalSlides - 1 : activeSlide - 1"
									class="__prev flex items-center justify-center pointer-events-auto -translate-x-1/2 cursor-pointer transition-all duration-400 z-50">
									<x-icon.arrow-left class="cursor-pointer h-10 w-auto" />
								</div>
								<div @click="activeSlide = (activeSlide === totalSlides - 1) ? 0 : activeSlide + 1"
									class="__next flex items-center justify-center pointer-events-auto translate-x-1/2 cursor-pointer transition-all duration-300 z-50">
									<x-icon.arrow-right class="cursor-pointer h-10 w-auto" />
								</div>
							</div>
							@endif
						</div>
						@endif
						<div class="__content flex flex-col justify-center">
							@if (!empty($item['title']))
							<h3 class="text-h2 m-header">{{ $item['title'] }}</h3>
							@endif

							@if (!empty($item['text']))
							<div class="__txt">
								{!! $item['text'] !!}
							</div>
							@endif
						</div>
					</div>
					@endforeach
				</div>
				@endforeach
			</div>
		</div>
		@endif

		@if (!empty($g_tabs['button']))
		<div class=" text-center">
			<a href="{{ $g_tabs['button']['url'] }}" class="main-btn m-btn" target="{{ $g_tabs['button']['target'] ?? '_self' }}">
				{{ $g_tabs['button']['title'] }}
			</a>
		</div>
		@endif
	</div>
</section>