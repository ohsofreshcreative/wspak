@php
$contact = get_field('g_contact_info', 'option');
$socials = get_field('social_media', 'option');
@endphp

<footer class="footer overflow-hidden text-white relative z-10">
    <div class="blur bg-primary-100 absolute"></div>
    <div class="absolute shape z-20 w-[1000px] h-[1000px] top-24 right-[-750px] hidden lg:block">
        <img class="w-full h-auto" src="{{ get_template_directory_uri() }}/resources/images/shape.svg">
    </div>
    <div class="__wrapper c-main relative z-10">
        <div class="__widgets grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 py-10 lg:py-36">
            <div class="flex flex-col gap-6">
                @if(!empty($contact['image']))
                <a href="{{ home_url('/') }}" class="inline-block">
                    <img src="{{ $contact['image']['url'] }}" alt="{{ get_bloginfo('name') }}" class="max-w-[210px] h-auto">
                </a>
                @endif
                @if(!empty($contact))
                <div class="flex flex-col gap-3">
                    @if(!empty($contact['phone']))
                    <a href="tel:{!! str_replace(' ', '', $contact['phone']) !!}" class="flex items-center gap-2 text-sm hover:opacity-80 transition-opacity">
                        <img src="{{ get_template_directory_uri() }}/resources/images/footer_phone.svg" alt="" class="w-6 h-6 shrink-0">
                        <span>{{ $contact['phone'] }}</span>
                    </a>
                    @endif
                    @if(!empty($contact['phone2']))
                    <a href="tel:{!! str_replace(' ', '', $contact['phone2']) !!}" class="flex items-center gap-2 text-sm hover:opacity-80 transition-opacity">
                        <img src="{{ get_template_directory_uri() }}/resources/images/footer_phone.svg" alt="" class="w-6 h-6 shrink-0">
                        <span>{{ $contact['phone2'] }}</span>
                    </a>
                    @endif
                    @if(!empty($contact['mail']))
                    <a href="mailto:{{ $contact['mail'] }}" class="flex items-center gap-3 text-sm hover:opacity-80 transition-opacity">
                        <img src="{{ get_template_directory_uri() }}/resources/images/mail.svg" alt="" class="w-6 h-6 shrink-0">
                        <span>{{ $contact['mail'] }}</span>
                    </a>
                    @endif
                </div>
                @endif
                @if(!empty($socials))
                <div class="flex items-center gap-x-3 text-white md:hidden mt-2">
                    @include('partials.social-media', ['items' => $socials, 'style' => 'mobile_footer'])
                </div>
                @endif
            </div>

            @for ($i = 1; $i <= 3; $i++)
                @if (is_active_sidebar('sidebar-footer-' . $i))
                <div class="footer-widget-container relative">
                    <div class="flex justify-between items-center widget-trigger cursor-pointer md:cursor-default" onclick="this.querySelector('.widget-arrow').classList.toggle('rotate-180')">
                        <div class="widget-title-wrapper w-full">
                            @php(dynamic_sidebar('sidebar-footer-' . $i))
                        </div>
                        <svg class="widget-arrow absolute top-3 right-0 transition-transform duration-300 md:hidden shrink-0 pointer-events-none z-10"
                            xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.63287 7.40425L12.4915 2.79009C13.5563 1.77912 12.8322 0.000205704 11.3579 0.00020564C11.3579 0.00020564 10.2345 0.000241831 9.117 0.000205542C7.99951 0.000169254 4.74344 -0.000409223 3.87506 0.000205313C3.00668 0.000819848 1.64069 0.000205215 1.64069 0.000205215 0.166391 0.000205151 -0.557652 1.77912 0.507116 2.79009L5.36574 7.40425C6.00132 8.00694 7.00056 8.00694 7.63615 7.40425L7.63287 7.40425Z" fill="#E65796" />
                        </svg>
                    </div>
                </div>
                @endif
            @endfor
        </div>
    </div>

    <div class="border-t border-primary-100"></div>
    <div class="c-main flex flex-col md:flex-row lg:justify-center lg:items-center gap-6 py-10 footer-bottom">
        @if(!empty($socials))
        <div class="hidden md:flex lg:items-center pr-8 border-r border-primary-100 gap-x-3 text-white">
            @include('partials.social-media', ['items' => $socials])
        </div>
        @endif
        <p class="md:pr-8 md:border-r border-primary-100 !text-xs text-left">Copyright ©{{ date('Y') }} {{ get_bloginfo('name') }}. All Rights Reserved</p>
        <p class="flex gap-2 !text-xs  lg:items-center">Designed &amp; Developed by
            <a target="_blank" rel="nofollow" href="https://www.ohsofresh.pl" title="OhSoFresh">
                <img class="oh" src="{{ get_template_directory_uri() }}/resources/images/ohsofresh.svg" alt="OhSoFresh">
            </a>
        </p>
    </div>
</footer>