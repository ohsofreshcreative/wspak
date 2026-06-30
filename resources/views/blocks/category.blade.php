<!-- category  -->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-category relative -smt !overflow-visible' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="c-main !overflow-visible">
		<div class="__content mb-12 flex justify-between items-center">
			<div>
				<h2 data-gsap-element="title" class=" ">{{ $posts_settings['title'] }}</h2>
			</div>
			<div class="flex items-center gap-6">
				<div class="flex md:gap-4 gap-2">
					<x-icon.arrow-left class="js-posts-prev cursor-pointer hover:opacity-30  md:h-16 h-10 w-auto duration-300 transition-all" />
					<x-icon.arrow-right class="js-posts-next cursor-pointer hover:opacity-30  md:h-16 h-10 w-auto duration-300 transition-all" />
				</div>
			</div>
		</div>
		<div data-gsap-element="swiper" class="__posts-grid relative w-full !overflow-visible">
			@if(!empty($posts))
			<div class="swiper posts-slider !overflow-visible w-full">
				<div class="swiper-wrapper !overflow-visible">
					@foreach($posts as $post)
					@php
					$thumbnail_id = get_post_thumbnail_id($post->ID);
					$image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : null;
					$icon_id = get_field('offer_icon', $post->ID);
					@endphp
					<div class="swiper-slide group relative bg-white p-6 radius flex flex-col w-full min-h-[500px] md:min-h-[600px] transform transition-all duration-300 transition-opacity delay-75 overflow-hidden"
						style="@if($image_url) background-image: url('{!! $image_url !!}'); background-size: cover; background-position: center; @endif">
								<div class="absolute inset-0 bg-vertical opacity-50 z-10"></div>

						@if(!empty($icon_id))
						<div class="w-full h-auto flex justify-end relative z-20 mb-6 ml-auto">
							{!! wp_get_attachment_image($icon_id, 'thumbnail', false, ['class' => 'w-10 h-auto object-contain ml-auto text-right']) !!}
						</div>
						@endif
						<div class="relative z-20 flex flex-col flex-1 h-full w-full">
							<div>
								<h5 class=" text-white m-title">
									{{ get_the_title($post->ID) }}
								</h5>
								@if($show_excerpt)
								<div class="text-white text-lg">
									{!! get_the_excerpt($post->ID) !!}
								</div>
								@endif
							</div>
						</div>
						<div class="absolute bottom-4 right-4 z-20">
							<x-icon.arrow-right class="text-right block text-white transform group-hover:translate-x-1 transition-transform" />
						</div>
						<a href="{{ get_permalink($post->ID) }}" class="absolute inset-0 z-30 hidden-link" aria-label="{{ get_the_title($post->ID) }}">
						</a>
					</div>
					@endforeach
				</div>
			</div>
			@else
			<div class="no-posts bg-white p-6 radius text-center text-gray-400 shadow-sm">
				Brak postów do wyświetlenia.
			</div>
			@endif
		</div>
	</div>
</section>