<!--- team --->

<section
    data-gsap-anim="section"
    @if(!empty($section_id)) id="{{ $section_id }}" @endif
    @class([ 'b-team relative -smt -spt -spb overflow-hidden bg-gradient-main' ,
    $sectionClass=> filled($sectionClass),
    $section_class => filled($section_class),
    $background => filled($background) && $background !== 'none',
    ])>
<div class="absolute z-4 left_shape mix-blend-overlay"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg"></div>
<div class="absolute z-4 right_shape mix-blend-overlay"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg"></div>
    <div class="__wrapper c-main">
        <div class="__top">
            <h2 data-gsap-element="header" class="m-header text-center !text-white">{{ strip_tags($g_team['header']) }}</h2>
        </div>

        @if (!empty($r_team))
        @php
        $itemCount = count($r_team);
        $gridCols = 1;
        if ($itemCount == 2) $gridCols = 2;
        if ($itemCount == 3) $gridCols = 3;
        if ($itemCount >= 4) $gridCols = 4; // Twój dotychczasowy warunek
        $gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
        @endphp

        <div class="grid {{ $gridClass }} gap-8 mt-10 text-center text-white">
            @foreach ($r_team as $item)
            <div data-gsap-element="card" class="__card relative bg-primary-900 p-6 radius ">
                @if (!empty($item['image']['url']))
                    <img class="h-[400px] w-full object-cover radius" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
                @endif
                @if (!empty($item['title']))
                <p class="text-h5 mt-8 mb-2">{{ $item['title'] }}</p>
                @endif
                @if (!empty($item['subtitle']))
                <p class="text-h7 text-primary-100 mb-4">{{ $item['subtitle'] }}</p>
                @endif
                @if (!empty($item['text']))
                <p class="!text-base ">{{ $item['text'] }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @endif

    </div>

</section>