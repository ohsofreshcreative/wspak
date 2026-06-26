@php
use App\Walkers\DropdownWalker;
use App\Walkers\MobileDropdownWalker;

$social_media = get_field('social_media', 'option');
@endphp

<header x-data="{ mobileOpen: false }" class="relative top-0 z-50 bg-background masthead fixed-top">

<<<<<<< Updated upstream
    <!-- Desktop Header -->
    <div class="items-center justify-between hidden h-full py-4 px-12 mx-auto lg:flex">
        <a class="brand shrink-0" href="{{ home_url('/') }}">
            @if ($logo)
            <img src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?? 'Logo' }}" class="w-auto h-20">
            @else
            <span class="text-xl font-bold">{{ $siteName }}</span>
            @endif
        </a>
        @if (has_nav_menu('primary_navigation'))
        <nav class="ml-6 lg:ml-15 nav-primary w-full" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
            {!! wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'menu_class' => 'nav flex gap-x-3 lg:gap-x-6 text-lg font-medium justify-center items-center',
            'container' => false,
            'echo' => false,
            'walker' => new DropdownWalker(),
            ]) !!}
        </nav>
        @endif
=======
	<!-- Desktop Header -->
	<div class="items-center justify-between hidden h-full py-4 px-12 mx-auto md:flex">
		<a class="brand shrink-0" href="{{ home_url('/') }}">
			@if ($logo)
			<img src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?? 'Logo' }}" class="w-auto h-14">
			@else
			<span class="text-xl font-bold">{{ $siteName }}</span>
			@endif
		</a>
		@if (has_nav_menu('primary_navigation'))
		<nav class="ml-6 lg:ml-15 nav-primary w-full" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
			{!! wp_nav_menu([
			'theme_location' => 'primary_navigation',
			'menu_class' => 'nav flex gap-x-3 lg:gap-x-6 text-lg font-medium justify-center items-center',
			'container' => false,
			'echo' => false,
			'walker' => new DropdownWalker(),
			]) !!}
		</nav>
		@endif
>>>>>>> Stashed changes

        <div class="flex items-center gap-x-4 shrink-0">
            <a href="/kontakt/" class="btn btn-secondary">
                Kontakt
            </a>
            <div class="flex items-center gap-x-3 text-white">
                @include('partials.social-media', ['social_media' => $social_media])
            </div>
        </div>
    </div>

<<<<<<< Updated upstream
    <!-- Mobile Header Bar -->
    <div class="flex items-center justify-between p-4 mobile-menu fixed-top lg:hidden">
        <a class="brand shrink-0" href="{{ home_url('/') }}">
            @if ($logo)
            <img src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?? 'Logo' }}" class="w-auto h-18">
            @else
            <span class="text-lg font-bold">{{ $siteName }}</span>
            @endif
        </a>
        <button
            @click.stop="mobileOpen = !mobileOpen"
            class="p-0 text-white primary"
            aria-expanded="mobileOpen"
            aria-controls="mobile-menu-panel">
            <span class="sr-only">Otwórz menu główne</span>
            <svg x-show="!mobileOpen" class="block w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg x-show="mobileOpen" class="block w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
=======
		<div class="flex items-center gap-x-4 shrink-0">
    <a href="/kontakt/" class="btn btn-secondary">
        Kontakt
    </a>

    @if(!empty($social_media))
        <div class="flex items-center gap-x-3 text-white">
            @foreach($social_media as $social)
                @if(!empty($social['link']))
                    <a href="{{ $social['link']['url'] }}" 
                       target="{{ $social['link']['target'] ?? '_blank' }}" 
                       class="hover:text-secondary-100 transition-colors duration-200"
                       title="{{ $social['link']['title'] ?? $social['icon'] }}">
                        
                        @if($social['icon'] === 'facebook')
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="24" viewBox="0 0 13 24" fill="none">
  <path d="M3.57972 13.5469C3.49022 13.5469 1.52138 13.5469 0.62645 13.5469C0.149155 13.5469 0 13.3667 0 12.9161C0 11.7146 0 10.4831 0 9.2816C0 8.801 0.178986 8.65081 0.62645 8.65081H3.57972C3.57972 8.5607 3.57972 6.81852 3.57972 6.00751C3.57972 4.80601 3.78853 3.66458 4.38515 2.61327C5.0116 1.53191 5.90653 0.811013 7.04011 0.390488C7.78588 0.12015 8.53165 0 9.33709 0H12.2605C12.6782 0 12.8571 0.180225 12.8571 0.600751V4.02503C12.8571 4.44556 12.6782 4.62578 12.2605 4.62578C11.4551 4.62578 10.6497 4.62578 9.84422 4.65582C9.03878 4.65582 8.62115 5.04631 8.62115 5.88736C8.59132 6.78849 8.62115 7.65957 8.62115 8.59074H12.0815C12.5588 8.59074 12.7378 8.77096 12.7378 9.25156V12.8861C12.7378 13.3667 12.5887 13.5169 12.0815 13.5169C11.0076 13.5169 8.71064 13.5169 8.62115 13.5169V23.3091C8.62115 23.8198 8.47199 24 7.93504 24C6.68214 24 5.45907 24 4.20617 24C3.7587 24 3.57972 23.8198 3.57972 23.3692C3.57972 20.2153 3.57972 13.637 3.57972 13.5469Z" fill="white"/>
</svg>
                            
                        @elseif($social['icon'] === 'instagram')
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path d="M12.0042 5.83728C8.60123 5.83728 5.84623 8.59524 5.84623 11.9952C5.84623 15.3981 8.60423 18.1531 12.0042 18.1531C15.4072 18.1531 18.1622 15.3951 18.1622 11.9952C18.1622 8.59224 15.4042 5.83728 12.0042 5.83728ZM12.0042 15.9921C9.79523 15.9921 8.00723 14.2031 8.00723 11.9952C8.00723 9.78722 9.79623 7.99825 12.0042 7.99825C14.2122 7.99825 16.0012 9.78722 16.0012 11.9952C16.0022 14.2031 14.2132 15.9921 12.0042 15.9921Z" fill="white"/>
<path d="M16.9482 0.0753853C14.7402 -0.0276129 9.27123 -0.022613 7.06123 0.0753853C5.11923 0.166384 3.40623 0.635375 2.02523 2.01635C-0.282773 4.32431 0.0122273 7.43426 0.0122273 11.9952C0.0122273 16.6631 -0.247773 19.701 2.02523 21.974C4.34223 24.29 7.49723 23.987 12.0042 23.987C16.6282 23.987 18.2242 23.99 19.8592 23.357C22.0822 22.494 23.7602 20.507 23.9242 16.9381C24.0282 14.7291 24.0222 9.26123 23.9242 7.05126C23.7262 2.83834 21.4652 0.283382 16.9482 0.0753853ZM20.4432 20.447C18.9302 21.96 16.8312 21.825 11.9752 21.825C6.97523 21.825 4.97023 21.899 3.50723 20.432C1.82223 18.7551 2.12723 16.0621 2.12723 11.9792C2.12723 6.45427 1.56023 2.47534 7.10523 2.19135C8.37923 2.14635 8.75423 2.13135 11.9612 2.13135L12.0062 2.16135C17.3352 2.16135 21.5162 1.60336 21.7672 7.14726C21.8242 8.41224 21.8372 8.79223 21.8372 11.9942C21.8362 16.9361 21.9302 18.9531 20.4432 20.447Z" fill="white"/>
<path d="M18.4062 7.03326C19.201 7.03326 19.8452 6.38901 19.8452 5.59429C19.8452 4.79956 19.201 4.15531 18.4062 4.15531C17.6115 4.15531 16.9672 4.79956 16.9672 5.59429C16.9672 6.38901 17.6115 7.03326 18.4062 7.03326Z" fill="white"/>
</svg>
                        @endif

                    </a>
                @endif
            @endforeach
        </div>
    @endif
</div>
	</div>
>>>>>>> Stashed changes

    <!-- Mobile Menu Panel -->
    <div
        id="mobile-menu-panel"
        x-show="mobileOpen"
        @click.away="mobileOpen = false"
        @keydown.escape.window="mobileOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-full"
        class="mobile-menu fixed top-0 right-0 bottom-0 w-full h-full bg-primary shadow-xl z-[51] overflow-y-auto lg:hidden"
        aria-label="Menu mobilne">
        <div class="p-4 relative z-10">
            <div class="flex items-center justify-between mb-6">
                <span class=""><a class="brand shrink-0" href="{{ home_url('/') }}"><img src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?? 'Logo' }}" class="w-auto h-18"></a></span>
                <button
                    @click="mobileOpen = false"
                    class="p-2 text-white rounded-md">
                    <span class="sr-only">Zamknij menu</span>
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            @if (has_nav_menu('primary_navigation'))
            <nav class="flex flex-col space-y-1 mt-20">
                {!! wp_nav_menu([
                'theme_location' => 'primary_navigation',
                'menu_class' => 'nav-mobile flex flex-col space-y-2',
                'container' => false,
                'echo' => false,
                'walker' => new MobileDropdownWalker(),
                ]) !!}
            </nav>
            @endif

            <div class="mt-8">
                <a href="/kontakt/" class="block w-full btn btn-secondary ">
                    Kontakt
                </a>
            </div>
        </div>

<<<<<<< Updated upstream
    </div>
=======
			<div class="mt-8">
				<a href="/kontakt/" class="block w-full btn btn-secondary ">
					Kontakt
				</a>
			</div>
		</div>

	</div>
>>>>>>> Stashed changes
</header>