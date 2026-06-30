@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';
@endphp
<!-- posts  -->
<div data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-posts -smt -smb {{ $sectionClass }} {{ $section_class }}">
	<div class="c-main ">
		<div class="__content flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-12">
			<h2 data-gsap-element="title" class="">
				{{ $posts_settings['title'] ?? 'Baza wiedzy' }}
			</h2>
			@if (!empty($posts_settings['button']))
			<a data-gsap-element="btn" class="self-start inline-flex items-center gap-3 !text-primary-100 border-2 border-primary-100 rounded-full py-4 px-14 hover:bg-[#2563eb]/5 transition-all duration-300" href="{{ home_url('/category/blog/') }}">
				<span class=" !font-medium ">{{ $posts_settings['button']['title'] }}</span>
				<img class="strzałka" src="{{ get_template_directory_uri() }}/resources/images/__arrow.svg">
			</a>
			@endif
		</div>
		<div data-gsap-element="grid-layout" class="__posts-grid relative w-full">
			@if(!empty($posts))
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				@foreach($posts as $post)
				<div class="group relative flex flex-col text-left h-full transition-all duration-300">
					<div class="w-full aspect-[16/9] mb-5 overflow-hidden radius ">
						@if(has_post_thumbnail($post->ID))
						<img src="{{ get_the_post_thumbnail_url($post->ID, 'large') }}"
							alt="{{ get_the_title($post->ID) }}"
							class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
						@endif
					</div>
					<div class="mb-4">
						@php
						$categories = get_the_category($post->ID);
						$cat_name = '';
						if (!empty($categories)) {
						foreach ($categories as $category) {
						if (mb_strtolower($category->name) === 'blog') {
						continue;
						}
						$cat_name = $category->name;
						break;
						}
						}
						@endphp
						@if(!empty($cat_name))
						<span class="inline-block bg-primary-25 text-primary-900 text-xs font-medium px-2 py-1 rounded-[48px]">
							{{ $cat_name }}
						</span>
						@endif
					</div>
					<h6 class=" text-primary-900 mb-6 ">
						{{ get_the_title($post->ID) }}
					</h6>
					<div class="mt-auto pt-2">
						<a href="{{ get_permalink($post->ID) }}"
							class="inline-flex items-center justify-center transition-all duration-300 after:absolute after:inset-0 after:z-10">
							<x-icon.arrow-right class="cursor-pointer h-10 w-auto" />
						</a>
					</div>
				</div>
				@endforeach
			</div>
			@else
			<div class="no-posts bg-white p-6 radius text-center text-gray-400 shadow-sm">
				Brak postów do wyświetlenia.
			</div>
			@endif
		</div>
	</div>
</div>