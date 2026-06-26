<!--- voices --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-voices relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main">
		@if (!empty($g_voices))
		<div class="__top">
			<h2 data-gsap-element="header" class="m-header">{{ strip_tags($g_voices['header'] ?? '') }}</h2>
			<p data-gsap-element="text">{{ $g_voices['text'] ?? '' }}</p>
		</div>
		@endif

		@if (!empty($r_voices))
		@php
		$itemCount = count($r_voices);
		$gridCols = 1;
		if ($itemCount == 2) $gridCols = 2;
		if ($itemCount == 3) $gridCols = 3;
		if ($itemCount >= 4) $gridCols = 4;
		$gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
		@endphp

		<div class="grid {{ $gridClass }} gap-8 mt-10">
			@foreach ($r_voices as $item)
			<div data-gsap-element="card" class="__card relative bg-white p-8">
				@if (!empty($item['image']['url']))
				<img class="mb-6" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
				@endif
				@if (!empty($item['title']))
				<p class="text-h5">{{ $item['title'] }}</p>
				@endif
				@if (!empty($item['text']))
				<p>{{ $item['text'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif

		@if (!empty($voices))
		<div class="voices-section mt-12">

			{{-- Filtry --}}
			@php
			$filterLabels = [
				'gender' => 'Płeć',
				'age'    => 'Wiek głosu',
				'timbre' => 'Barwa',
				'price'  => 'Grupa cenowa',
				'style'  => 'Styl interpretacji',
			];
			@endphp
			<div class="voices-filters flex flex-wrap gap-8 mb-8">
				@foreach ($filterLabels as $key => $label)
					@if (!empty($filters[$key]))
					<div class="filter-group" data-filter-group="{{ $key }}">
						<p class="filter-group__label font-semibold mb-2">{{ $label }}</p>
						<div class="flex flex-wrap gap-2">
							@foreach ($filters[$key] as $opt)
							<label class="flex items-center gap-1 cursor-pointer">
								<input type="checkbox" class="voice-filter" data-filter="{{ $key }}" value="{{ Str::slug($opt) }}">
								{{ $opt }}
							</label>
							@endforeach
						</div>
					</div>
					@endif
				@endforeach
			</div>

			{{-- Karty głosów --}}
			<div class="grid grid-cols-3 gap-6">
				@foreach ($voices as $voice)
				<div class="voice-card p-4 border"
					data-gender="{{ Str::slug($voice['gender'] ?? '') }}"
					data-age="{{ Str::slug($voice['age'] ?? '') }}"
					data-timbre="{{ Str::slug($voice['timbre'] ?? '') }}"
					data-price="{{ Str::slug($voice['price'] ?? '') }}"
					data-style="{{ Str::slug($voice['style'] ?? '') }}">

					<h3 class="font-bold">{{ $voice['name'] }}</h3>
					<p>Płeć: {{ $voice['gender'] }} | Wiek: {{ $voice['age'] }}</p>
				</div>
				@endforeach
			</div>

		</div>
		@endif

	</div>

</section>
    <div class="c-main"> 
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <aside class="lg:col-span-1">
                <form action="" method="GET" id="filter-form" class="grid grid-cols-1 gap-6">
                    
                    <div class="filter-group">
                        <h4>Płeć</h4>
                        @foreach(get_terms(['taxonomy' => 'voice_gender', 'hide_empty' => false]) as $term)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="gender[]" value="{{ $term->slug }}">
                                <span>{{ $term->name }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="filter-group">
                        <h4>Wiek głosu</h4>
                        @foreach(get_terms(['taxonomy' => 'voice_age', 'hide_empty' => false]) as $term)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="age[]" value="{{ $term->slug }}">
                                <span>{{ $term->name }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="filter-group">
                        <h4>Grupa cenowa</h4>
                        @foreach(get_terms(['taxonomy' => 'voice_price', 'hide_empty' => false]) as $term)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="price[]" value="{{ $term->slug }}">
                                <span>{{ $term->name }}</span>
                            </label>
                        @endforeach
                    </div>
					<div class="filter-group">
    <h4>Barwa głosu</h4>

    @foreach(get_terms(['taxonomy' => 'voice_tone', 'hide_empty' => false]) as $term)
        <label class="flex items-center gap-2">
            <input type="checkbox" name="tone[]" value="{{ $term->slug }}">
            <span>{{ $term->name }}</span>
        </label>
    @endforeach
</div>
<div class="filter-group">
    <h4>Zastosowanie</h4>

    @foreach(get_terms(['taxonomy' => 'voice_usage', 'hide_empty' => false]) as $term)
        <label class="flex items-center gap-2">
            <input type="checkbox" name="usage[]" value="{{ $term->slug }}">
            <span>{{ $term->name }}</span>
        </label>
    @endforeach
</div>

                </form>
            </aside>

            <div class="lg:col-span-3">
                @if(!empty($voices))
                    
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    @foreach($voices as $voice)

        @php
            $avatar_id = get_post_thumbnail_id($voice->ID);
            $avatar_url = $avatar_id ? wp_get_attachment_image_url($avatar_id, 'thumbnail') : null;

            $audio_file = get_field('voice_sample', $voice->ID);

            $genders = wp_get_post_terms($voice->ID, 'voice_gender', ['fields' => 'names']);
            $ages = wp_get_post_terms($voice->ID, 'voice_age', ['fields' => 'names']);
            $tones = wp_get_post_terms($voice->ID, 'voice_tone', ['fields' => 'names']);
            $styles = wp_get_post_terms($voice->ID, 'voice_style', ['fields' => 'names']);
            $usage = wp_get_post_terms($voice->ID, 'voice_usage', ['fields' => 'names']);

            $price = wp_get_post_terms($voice->ID, 'voice_price', ['fields' => 'names']);

            $tags = array_merge(
                $genders,
                $ages,
                $tones,
                $styles,
                $usage
            );
        @endphp

        <div class="voice-card grid grid-cols-1 gap-4">

            <div class="flex justify-between items-start">

                <div>

                    @if(!empty($price))
                        <span class="price-tier">{{ $price[0] }}</span>
                    @endif

                    <h3>{{ get_the_title($voice->ID) }}</h3>

                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>

                </div>

                @if($avatar_url)
                    <img
                        src="{{ $avatar_url }}"
                        alt="{{ get_the_title($voice->ID) }}"
                    >
                @endif

            </div>

            <div class="voice-player">

                @if($audio_file)

                    <div class="flex items-center gap-4">

                        <button class="js-audio-play">
                            ▶
                        </button>

                        <audio
                            class="js-voice-audio"
                            src="{{ $audio_file['url'] }}">
                        </audio>

                        <div class="w-full bg-gray-200 h-1 relative">
                            <div class="bg-black h-1 w-0 js-audio-progress"></div>
                        </div>

                    </div>

                @endif

            </div>

            <button class="w-full">
                Wybierz głos
            </button>

        </div>

    @endforeach

</div>

                    <!-- @if(isset($max_pages) && $max_pages > 1)
                        <div class="pagination flex justify-center gap-4">
                            {!! paginate_links([
                                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                'format' => '?paged=%#%',
                                'current' => $current_page ?? 1,
                                'total' => $max_pages,
                                'prev_text' => '&larr;',
                                'next_text' => '&rarr;',
                                'type' => 'list'
                            ]) !!}
                        </div>
                    @endif

                @else
                    <div class="no-results">
                        Brak lektorów spełniających kryteria.
                    </div>
                @endif -->
            </div>

        </div>
    </div>
</section>