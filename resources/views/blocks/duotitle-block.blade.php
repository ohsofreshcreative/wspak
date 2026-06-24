<!--- duotitle -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-duotitle relative -smt -spb ' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-10">
			@if (!empty($g_duotitle['image']))
			<div data-gsap-element="img" class="__img  order1 relative">
				<img class="radius max-h-[700px]" src="{{ $g_duotitle['image']['url'] }}" alt="{{ $g_duotitle['image']['alt'] ?? '' }}">
				<div class="_box absolute bottom-6 right-6 radius px-8 py-4 text-white bg-gradient-p overflow-hidden isolation-auto">
					<div class="absolute inset-0 z-0 pointer-events-none"
						style="background-image: url('{{ get_template_directory_uri() }}/resources/images/shape_s.svg'); background-repeat: no-repeat; background-position: left bottom; background-size: cover; background-size: 130% auto; mix-blend-mode: overlay; opacity: 0.2;">
					</div>
					<div class="relative z-10">
						<span class="mb-2 block text-h2 !text-white ">
							{{ $g_duotitle['title_number'] }}
						</span>
						<div data-gsap-element="txt" class="__txt">
							{!! $g_duotitle['text_number'] !!}
						</div>
					</div>
				</div>
			</div>
			@endif
			<div class="__content order2">
				<span data-gsap-element="txt" class="text-secondary mb-6 block text-lg">{{ $g_duotitle['header_small'] }}</span>
				<h2 data-gsap-element="header" class="">{{ $g_duotitle['header'] }}</h2>

				<div data-gsap-element="txt" class="__txt mt-4">
					{!! $g_duotitle['text'] !!}
				</div>
				<div class="inline-buttons m-btn">
					@if (!empty($g_duotitle['button1']))
					<x-button
						:href="$g_duotitle['button1']['url']"
						variant="primary"
						class=""
						data-gsap-element="btn">
						{{ $g_duotitle['button1']['title'] }}
					</x-button>
					@endif
					@if (!empty($g_duotitle['button2']))
					<x-button
						:href="$g_duotitle['button2']['url']"
						variant="secondary"
						class=""
						data-gsap-element="btn">
						{{ $g_duotitle['button2']['title'] }}
					</x-button>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>