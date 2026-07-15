@extends('layouts.app')

@section('content')

@php
$term = get_queried_object();
$categories = get_categories();

$category_header = get_field('category_header', $term);
$category_description = get_field('category_description', $term);
$category_image = get_field('category_image', $term);

$g_contact_1 = get_field('g_contact_1', 'option');
$g_contact_2 = get_field('g_contact_2', 'option') ?: [];

// Pobranie pól ACF dla sekcji 'contact'
$section_id = $g_contact_2['section_id'] ?? '';
$section_class = $g_contact_2['section_class'] ?? '';
$flip = $g_contact_2['flip'] ?? false;

// Przygotowanie klas CSS
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';

// Wygenerowanie unikalnego ID dla SVG
$unique_id = 'clip_'.uniqid();
@endphp

<div data-gsap-anim="section" class="hero category-header relative">
	<div class="absolute z-0 right_shape hidden xl:block right-25 -top-14 xl:h-[600px]  w-auto">
		<img data-gsap-element="img" class="w-full h-full" src="/wp-content/uploads/2026/06/hero_blog.svg">
	</div>
	<div class="__wrapper c-main relative z-10 lg:pt-10">
		<div class="__content w-full md:w-2/3">
			<h2 data-gsap-element="header" class="text-primary-900 -spt mb-10">
				Wiedza, inspiracje i kulisy produkcji audio
			</h2>
		</div>

		<div id="category-tabs" class="category-tabs z-20 relative rounded-full">
			<div class="lg:flex  ">
				<div class="lg:w-fit flex flex-wrap  gap-3">
					<div data-gsap-element="card" class=" !w-auto">
						<a href="{{ get_category_link(get_category_by_slug('baza-wiedzy')->term_id) }}"
							class="__tab block bg-primary-100 rounded-full px-6 py-4 {{ is_category('baza-wiedzy') ? 'active' : '' }}">
							Wszystkie wpisy
						</a>
					</div>
					@foreach($categories as $category)
					@if($category->slug !== 'baza-wiedzy')
					<div data-gsap-element="card" class="!w-auto">
						<a href="{{ get_category_link($category->term_id) }}"
							class="__tab block bg-primary-100 rounded-full px-6 py-4 {{ $term && $term->term_id === $category->term_id ? 'active' : '' }}">
							{{ $category->name }}
						</a>
					</div>
					@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<div data-gsap-anim="section">
	@if (have_posts())
	<div data-gsap-element="stagger" class="__posts c-main !mt-10 posts grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
		@while (have_posts()) @php(the_post())

		@includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
		@endwhile
	</div>
</div>

{{-- {!! get_the_posts_navigation() !!} --}}
{!! the_posts_pagination() !!}
@else
<div class="mt-20 mb-20">
	<div class="c-main">
		<h3 class="">Brak wpisów w tej kategorii.</h3>
		<a class="main-btn m-btn" href="/wszystkie-wpisy/">Sprawdź wszystkie wpisy</a>
	</div>
</div>
@endif

<!--- contact --->
<div
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-contact-block bg-primary-900 text-white -spt -spb relative -smt overflow-hidden' ,
	])>

	<div class="blur bg-primary-100 absolute"></div>
	<div class="second_blur bg-primary-100 absolute"></div>

	<div class="absolute right_shape z-10 block mix-blend-overlay w-[1300px] h-[1360px]  -top-10 md:-left-10 -left-6 rotate-[15deg]">
		<img src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg" alt="">
	</div>

	<div class="__wrapper c-main relative z-20">
		<div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-10 lg:gap-30 z-10">

			<div class="__content flex flex-col justify-between">
				@if(!empty($g_contact_1['header']))
				<h3 data-gsap-element="header" class="m-header">{!! $g_contact_1['header'] !!}</h3>
				@endif

				@if(!empty($g_contact_1['text']))
				<p data-gsap-element="txt" class="pb-6">{!! $g_contact_1['text'] !!}</p>
				@endif

				@if(!empty($g_contact_1['phone']))
				<a data-gsap-element="txt" class="__phone flex items-center mb-2" href="tel:{{ str_replace(' ', '', $g_contact_1['phone']) }}">{{ $g_contact_1['phone'] }}</a>
				@endif

				@if(!empty($g_contact_1['phone2']))
				<a data-gsap-element="txt" class="__phone flex items-center" href="tel:{{ str_replace(' ', '', $g_contact_1['phone2']) }}">{{ $g_contact_1['phone2'] }}</a>
				@endif

				@if(!empty($g_contact_1['mail']))
				<a data-gsap-element="txt" class="__mail flex items-center" href="mailto:{{ $g_contact_1['mail'] }}">{{ $g_contact_1['mail'] }}</a>
				@endif


			</div>

			<div data-gsap-element="form" class="bg-custom-blue radius p-8 md:p-10 z-20 relative">
				@if(!empty($g_contact_2['title']))
				<h4 class="mb-4">{!! $g_contact_2['title'] !!}</h4>
				@endif

				@if(!empty($g_contact_2['shortcode']))
				{!! do_shortcode($g_contact_2['shortcode']) !!}
				@endif
			</div>

		</div>
	</div>
</div>

@endsection