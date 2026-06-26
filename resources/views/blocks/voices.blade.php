<section
    @if(!empty($section_id)) id="{{ $section_id }}" @endif
    class="b-voices {{ $section_class }} {{ $background }}"
>
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