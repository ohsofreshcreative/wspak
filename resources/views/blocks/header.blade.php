@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp
<!-- header  -->
<section
    data-gsap-anim="section"
    @if(!empty($section_id)) id="{{ $section_id }}" @endif
    class="b-header overflow-hidden h-150 relative {{ $sectionClass }} {{ $section_class }}">
    
    <div class="absolute z-10 left_shape hidden xl:block"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape.svg"></div>
    <div class="absolute z-10 right_shape hidden xl:block mix-blend-overlay"><img class="" src="{{ get_template_directory_uri() }}/resources/images/shape_s.svg"></div>

    @if (!empty($g_header['video']))
        <div class="video-wrapper absolute inset-0 w-full h-full z-1">
            <video
                id="customVideo"
                autoplay
                loop
                muted
                playsinline
                class="w-full h-full object-cover">
                <source src="{{ $g_header['video'] }}" type="video/mp4">
                Twoja przeglądarka nie obsługuje odtwarzania wideo.
            </video>
        </div>

        <div class="__content-overlay absolute inset-0 z-20 flex items-center justify-center min-h-[500px] lg:min-h-[700px]">
            <div class="__content  px-6 py-10 c-main ">
			<div class="max-w-3xl">
                <h1 data-gsap-element="header" class="text-white m-header">
                    {!! $g_header['header'] !!}
                </h1>
                <div data-gsap-element="txt" class="txt !text-2lg text-white w-full mt-6">
                    {!! $g_header['text'] !!}
                </div>
				</div>
            </div>
        </div>
    @endif
</section>