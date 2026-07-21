<!-- offer  -->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-offer z-5 relative -mt-25 !overflow-visible' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="c-main ">
		<div class="__posts-grid flex flex-col gap-6 w-full ">
			@if(!empty($posts))
			@foreach($posts as $post)
			@php
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : null;
			$icon_id = get_field('offer_icon', $post->ID);
			@endphp
			<!-- wrapper dla animacji wejścia GSAP (bez transition-transform!) -->
			<div data-gsap-element="card" class="w-full">
				<!-- kafelek z efektem hover i przejściem CSS -->
				<div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-6 items-stretch group transition-transform duration-500 hover:-translate-y-2 overflow-hidden">
					<!-- contents-->
					<div class="bg-gradient-main radius flex flex-col justify-between relative p-10 h-105 lg:h-full lg:max-h-91.5">
						<a href="{{ get_permalink($post->ID) }}" class="absolute inset-0 z-30" aria-label="{{ get_the_title($post->ID) }}"></a>
						<div>
							@if(!empty($icon_id))
							<div class="mb-6 w-10 h-10 flex items-center justify-center shrink-0">
								{!! wp_get_attachment_image($icon_id, 'thumbnail', false, ['class' => 'w-full h-full object-contain']) !!}
							</div>
							@endif
							<h5 class=" text-white m-title">
								{{ get_the_title($post->ID) }}
							</h5>

							@if($show_excerpt)
							<div class="_txt text-white! ">
								{!! get_the_excerpt($post->ID) !!}
							</div>
							@endif
						</div>
						<div class="mt-10">
							<x-icon.arrow-right class=" block text-white transform group-hover:translate-x-1 transition-transform h-12 w-12 md:h-16 md:w-16" />

						</div>
					</div>
					<!-- Zdjęcie z prawej -->
					<div class="hidden lg:block radius overflow-hidden relative h-105 lg:h-full lg:max-h-91.5">
						@if($image_url)
						<img
							src="{{ $image_url }}"
							alt="{{ get_the_title($post->ID) }}"
							class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110" />

						<a href="{{ get_permalink($post->ID) }}" class="absolute inset-0 z-30" aria-label="{{ get_the_title($post->ID) }}"></a>
						@endif
					</div>
				</div>
			</div>
			@endforeach
			@else
			<div class="no-posts bg-white p-6 radius text-center text-gray-400 shadow-sm">
				Brak postów do wyświetlenia.
			</div>
			@endif
		</div>

	</div>
</section>