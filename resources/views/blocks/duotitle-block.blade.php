<!--- duotitle -->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-duotitle relative -smt -spb -spt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-10">
			@if (!empty($g_duotitle['image']))
			<div data-gsap-element="img" class="__img  order1 relative">
				<img class="radius max-h-[700px]" src="{{ $g_duotitle['image']['url'] }}" alt="{{ $g_duotitle['image']['alt'] ?? '' }}">
				<div class="_box absolute bottom-6 right-6 radius px-8 py-4 text-white bg-gradient-p overflow-hidden isolation-auto">
					<div class="absolute inset-0 z-0 pointer-events-none"
						style="background-image: url('{{ get_template_directory_uri() }}/resources/images/shape_s.svg'); background-repeat: no-repeat; background-position: left bottom; background-size: cover; background-size: 130% auto; mix-blend-mode: overlay; opacity: 0.2;">
					</div>
					<div class="relative z-10">
						<span class="mb-2 block text-h2 !text-white ">
							{{ $g_duotitle['title_number'] }}
						</span>
						<div data-gsap-element="txt" class="__txt">
							{!! $g_duotitle['text_number'] !!}
						</div>
					</div>
				</div>
			</div>
			@endif
			<div class="__content order2">
				<span data-gsap-element="txt" class="text-secondary mb-6 block text-lg">{{ $g_duotitle['header_small'] }}</span>
				<h2 data-gsap-element="header" class="">{{ $g_duotitle['header'] }}</h2>

				<div data-gsap-element="txt" class="__txt mt-4">
					{!! $g_duotitle['text'] !!}
				</div>
				{{-- KAFELKI LEKTORÓW  --}}
				@if (!empty($voices))
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8 mb-8 items-start">
					@foreach (array_slice($voices, 0, 2) as $voice)
					<div data-gsap-element="card" class="voice-card p-4 bg-white radius flex flex-col shadow-sm"
						data-gender="{{ Str::slug($voice['gender'] ?? '') }}"
						data-age="{{ Str::slug($voice['age'] ?? '') }}"
						data-timbre="{{ Str::slug($voice['timbre'] ?? '') }}"
						data-price="{{ Str::slug($voice['price'] ?? '') }}"
						data-style="{{ Str::slug($voice['style'] ?? '') }}">
						<div>
							{{-- Górna sekcja (Ikonki, Imię, Avatar) --}}
							<div class="flex justify-between items-start">
								<div class="flex flex-col justify-between self-stretch min-h-[76px]">
									<div class="flex items-center gap-0.5 mb-1">
										@php
										$count = (($voice['price'] ?? '') == 'premium') ? 3 : ((($voice['price'] ?? '') == 'ekonomiczna') ? 2 : 1);
										@endphp
										@for ($i = 0; $i
										< $count; $i++)
											<x-icon.price-icon class="w-2 h-auto flex-shrink-0" />
										@endfor
									</div>
									<h3 class="!text-2xl !font-bold ">{{ $voice['name'] ?? '' }}</h3>
								</div>
								@if(!empty($voice['avatar']))
								<img src="{{ $voice['avatar'] }}" alt="{{ $voice['name'] ?? '' }}" class="!w-19 !h-19 rounded-full object-cover flex-shrink-0 ml-4">
								@endif
							</div>
							{{-- Tagi kategorii --}}
							<div class="flex flex-wrap gap-1 mt-4 mb-4">
								@if(!empty($voice['age']))
								<span class="bg-primary-25 text-primary-900 text-xs font-medium px-2 py-1 rounded-[48px]">{{ trim($voice['age']) }}</span>
								@endif

								@if(!empty($voice['timbre']))
								@foreach(explode(',', $voice['timbre']) as $tag)
								<span class="bg-primary-25 text-primary-900 text-xs font-medium px-2 py-1 rounded-[48px]">{{ trim($tag) }}</span>
								@endforeach
								@endif
								@if(!empty($voice['style']))
								@foreach(explode(',', $voice['style']) as $tag)
								<span class="bg-primary-25 text-primary-900 text-xs font-medium px-2 py-1 rounded-[48px]">{{ trim($tag) }}</span>
								@endforeach
								@endif
							</div>
						</div>
						<div class="flex justify-between items-center">
							<button
								type="button"
								class="btn btn-secondary !px-4 !py-2 !text-sm">
								Wybierz głos
							</button>
							{{-- Sekcja z próbkami audio --}}
							<div class="">
								@if(!empty($voice['audio_tracks']))
								@foreach($voice['audio_tracks'] as $track)
								@if(!empty($track['file']))
								<div class="voice-player relative" x-data="audioPlayer('{{ $track['file'] }}')">
									<audio x-ref="audio" preload="none">
										<source src="{{ $track['file'] }}" type="audio/mpeg">
									</audio>
									<div class="relative w-11 h-11 flex items-center justify-center flex-shrink-0">
										<svg class="absolute top-0 left-0 w-full h-full -rotate-90 origin-center" viewBox="0 0 100 100">
											<circle cx="50%" cy="50%" r="42" fill="none" stroke="#E2E8F0" stroke-width="10" />
											<circle cx="50%" cy="50%" r="42" fill="none" stroke="#00579B" stroke-width="10"
												stroke-dasharray="263.89"
												:stroke-dashoffset="263.89 - (263.89 * progress / 100)"
												stroke-linecap="round"
												class="transition-all duration-100 ease-linear" />
										</svg>
										<button @click="togglePlay" type="button" class="relative z-10 w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center focus:outline-none hover:scale-105 transition-transform cursor-pointer">
											<svg x-show="!isPlaying" class="w-9 h-9 " viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M31.6304 24.2657L18.4714 31.863C17.9711 32.1513 17.4228 32.2959 16.8746 32.2959C16.3263 32.2959 15.7781 32.1513 15.2777 31.863C14.278 31.2854 13.6808 30.2525 13.6808 29.0973V13.9027C13.6808 12.7485 14.278 11.7146 15.2777 11.137C16.2775 10.5594 17.4707 10.5594 18.4705 11.137L31.6294 18.7343C32.6292 19.3119 33.2263 20.3449 33.2263 21.5C33.2263 22.6551 32.6302 23.6881 31.6304 24.2657Z" fill="white" />
											</svg>
											<svg x-show="isPlaying" x-cloak class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
												<path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"></path>
											</svg>
										</button>
									</div>
								</div>
								@endif
								@endforeach
								@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>
				@endif
				<div class="inline-buttons m-btn ">
					@if (!empty($g_duotitle['button1']))
					<x-button
						:href="$g_duotitle['button1']['url']"
						variant="primary"
						class=""
						data-gsap-element="btn">
						{{ $g_duotitle['button1']['title'] }}
					</x-button>
					@endif
					@if (!empty($g_duotitle['button2']))
					<x-button
						:href="$g_duotitle['button2']['url']"
						variant="secondary"
						class=""
						data-gsap-element="btn">
						{{ $g_duotitle['button2']['title'] }}
					</x-button>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>