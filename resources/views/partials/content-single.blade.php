@php
$categories = get_the_category();
$category = !empty($categories) ? $categories[0] : null;
@endphp

<section data-gsap-anim="section" class="hero-blog bg-primary-900 relative overflow-hidden">
	<div class="absolute z-4 left_shape"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>
	<div class="absolute z-4 right_shape"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg"></div>
	<div class="absolute blur mix-blend-overlay bg-primary-100"></div>

	<div class="__wrapper c-main relative z-10 -spt">
		<div class="__content w-full sm:w-3/4  pb-30">
			<div class="__top lg:mt-20 ">
				<h1 data-gsap-element="header" class="text-h2 !text-white mt-6">{{ get_the_title() }}</h1>
				@if(has_excerpt())
				<div data-gsap-element="content" class="!text-white mt-4 text-xl">
					{!! get_the_excerpt() !!}
				</div>
				@endif
			</div>
		</div>
	</div>
</section>

<section data-gsap-anim="section ">
	<div id="tresc" class="__entry relative z-10 -mt-16">
		<div class="c-main grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-10 ">

			@if(has_post_thumbnail())
			<div data-gsap-element="image" class="w-full img-2xl radius overflow-hidden ">
				{!! get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'w-full object-cover']) !!}
			</div>
			@endif
@php
$cta = get_field('cta_box');
@endphp
@if(!empty($cta['show']))
<div class="_box mt-auto relative h-[320px] lg:h-[390px] w-full radius overflow-hidden flex flex-col justify-end">

    <div class="absolute inset-0 z-1 pointer-events-none radius">

        @if(!empty($cta['image']))
            {!! wp_get_attachment_image(
                $cta['image'],
                'large',
                false,
                ['class' => 'w-full h-full object-cover radius']
            ) !!}
        @endif

        <div class="absolute inset-0 opacity-80"
             style="background: linear-gradient(0deg, #123071 5%, #E65796 93%);">
        </div>

    </div>

    <div class="_content z-20 relative mt-auto p-8">

        @if(!empty($cta['title']))
            <h5 class="text-white mb-3">
                {{ $cta['title'] }}
            </h5>
        @endif

        @if(!empty($cta['button']))
            <a
                href="{{ $cta['button']['url'] }}"
                target="{{ $cta['button']['target'] }}"
                class="btn btn-secondary">
                {{ $cta['button']['title'] }}
            </a>
        @endif

    </div>

</div>
@endif


		</div>

	</div>
</section>

@php
$content = apply_filters('the_content', get_the_content());

preg_match_all('/<h([1-4])[^>]*>(.*?)<\/h[1-4]>/', $content, $matches, PREG_SET_ORDER);

		$toc = '<nav class="toc">
			<ul>';
				$used_ids = [];
				foreach ($matches as $match) {
				$level = $match[1];
				$title = strip_tags($match[2]);
				$id = sanitize_title($title);
				$base_id = $id;
				$i = 2;
				while (in_array($id, $used_ids)) {
				$id = $base_id . '-' . $i;
				$i++;
				}
				$used_ids[] = $id;
				$content = preg_replace(
				'/<h' . $level . '[^>]*>' . preg_quote($match[2], '/' ) . '<\/h' . $level . '>/' , '<h' . $level . ' id="' . $id . '">' . $match[2] . '</h' . $level . '>' ,
					$content,
					1
					);
					$toc .='<li class="toc-h' . $level . '"><a href="#' . $id . '">' . $title . '</a></li>' ;
					}
					$toc .='</ul></nav>' ;
					@endphp

					<div class="__content c-main __entry -smt grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-10">
<div id="tresc" class="__entry">
						{!! $content !!}
					</div>
					<div class="relative md:sticky top-0 md:top-30 h-max">
						<p class="text-h5 m-title">Co znajdziesz w artykule:</p>
						@if(count($matches))
						{!! $toc !!}
						@endif
					</div>
					</div>

					@php
					$current_id = get_the_ID();
					$categories = wp_get_post_categories($current_id);
					$related_args = [
					'category__in' => $categories,
					'post__not_in' => [$current_id],
					'posts_per_page' => 3,
					'ignore_sticky_posts' => 1,
					];
					$related_query = new WP_Query($related_args);
					@endphp


					@if($related_query->have_posts())
					<section class="bg-white related-posts  -smt pt-20 pb-26">
					<div class="c-main">

						<div class="__content flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-12">
							<h2 class="">Baza wiedzy</h2>
							<a href="/category/blog" class="self-start inline-flex items-center gap-3 !text-primary-100 border-2 border-primary-100 rounded-full py-4 px-14 hover:bg-[#2563eb]/5 transition-all duration-300">
								<span> Zobacz wszystkie wpisy</span>
								<img class="strzałka" src="{{ get_template_directory_uri() }}/resources/images/__arrow.svg">
							</a>
						</div>

						<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:gap-8 gap-4">
							@while($related_query->have_posts())
							@php($related_query->the_post())
							<article @php(post_class('bg-white radius p-6 flex flex-col'))>
								<header>
									@if(has_post_thumbnail())
									<a href="{{ get_permalink() }}">
										{!! get_the_post_thumbnail(null, 'large', ['class' => 'featured-image radius object-cover img-m']) !!}
									</a>
									@endif

									@php($post_categories = get_the_category(get_the_ID()))
									@if(!empty($post_categories))
									<div class="flex flex-wrap gap-2 mt-4">
										@foreach($post_categories as $post_category)
										{{-- Jeśli to kategoria "Blog", przeskocz do następnej --}}
										@if(mb_strtolower($post_category->name) === 'blog')
										@continue
										@endif

										<a href="{{ get_category_link($post_category->term_id) }}" class="bg-primary-lighter hover:bg-primary-light  radius text-xs p-2">{{ $post_category->name }}</a>
										@endforeach
									</div>
									@endif

									<h2 class="entry-title text-h6 mt-4 ">
										<a class="!text-primary-900" href="{{ get_permalink() }}">
											{{ get_the_title() }}
										</a>
									</h2>

								</header>

								<a class=" mt-auto pt-4" href="{{ get_permalink() }}">
                        	<x-icon.arrow-right class="cursor-pointer h-10 w-auto" />
								</a>

							</article>
							@endwhile
							@php(wp_reset_postdata())
						</div>
						</div>
					</section>
					@endif



					<script>
						document.addEventListener('DOMContentLoaded', function() {
							const headings = document.querySelectorAll('h1[id], h2[id], h3[id], h4[id]'); // Select all headings with IDs
							const tocLinks = document.querySelectorAll('.toc ul li a'); // Select all links in the TOC

							function updateActiveLink() {
								headings.forEach((heading) => {
									const headingTop = heading.getBoundingClientRect().top;
									const windowHeight = window.innerHeight;

									if (headingTop < windowHeight - 300) {
										// Remove the 'active' class from all TOC links
										tocLinks.forEach((link) => {
											link.parentNode.classList.remove('active');
										});

										// Add the 'active' class to the corresponding TOC link
										const id = heading.id;
										const activeLink = document.querySelector(`.toc ul li a[href="#${id}"]`);
										if (activeLink) {
											activeLink.parentNode.classList.add('active');
										}
									}
								});
							}
							updateActiveLink();

							window.addEventListener('scroll', updateActiveLink);
						});
					</script>