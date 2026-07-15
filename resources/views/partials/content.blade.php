<article class="{{ implode(' ', get_post_class('__card')) }}">

	<a data-gsap-element="card"  class="rounded-2xl h-full" href="{{ get_permalink() }}">
		<div class="__content relative  rounded-2xl h-full">
			@if (has_post_thumbnail())
			<div data-gsap-element="img" class="block rounded-2xl overflow-hidden">
				<img src="{{ get_the_post_thumbnail_url(null, 'large') }}" alt="{{ get_the_title() }}" class="w-full img-s object-cover">
			</div>
			@endif

			<div class="mb-4 mt-4">
				@php
				$categories = get_the_category(get_the_ID());
				$cat_name = '';
				if (!empty($categories)) {
				foreach ($categories as $category) {
				if (mb_strtolower($category->name) === 'baza wiedzy') {
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

			<h6 class="mt-6 text-primary-900">
				{!! get_the_title() !!}
			</h6>


		</div>
	</a>
</article>