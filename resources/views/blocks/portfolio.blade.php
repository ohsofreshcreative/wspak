```blade
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-portfolio relative -smt -smb' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
<!-- portfolio  -->
	<div class="__wrapper c-main">
		@if(!empty($title))
		<div class="mb-10">
			<h2 data-gsap-element="header" class="m-header">{{ $title }}</h2>
		</div>
		@endif

		@if(!empty($items))
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
			@foreach($items as $item)
			<div data-gsap-element="card"
				class="portfolio-card p-4 bg-white radius flex flex-col sm:flex-row justify-between">

				<div class="flex flex-col sm:flex-row items-start gap-4">
					@if(!empty($item['cover']))
					<img src="{{ $item['cover'] }}" alt="{{ $item['title'] ?? '' }}"
						class="w-19 h-19 rounded-full object-cover flex-shrink-0">
					@endif

					<div class="flex flex-col">
						<h3 class="!text-2xl !font-bold mb-1">{{ $item['title'] ?? '' }}</h3>

						<div class="flex flex-col gap-2">

							<div class="grid grid-cols-1 sm:grid-cols-2">
								@if(!empty($item['author']))
								<p class="!text-base !font-semibold pr-0 sm:pr-4">
									<span class="!font-medium mr-1">Autor:</span>
									{{ $item['author'] }}
								</p>
								@endif

								@if(!empty($item['reader']))
								<p class="!text-base !font-semibold">
									<span class="!font-medium mr-1">Czyta:</span>
									{{ $item['reader'] }}
								</p>
								@endif
							</div>

							@if(!empty($item['publisher']))
							<p class="!text-base !font-semibold">
								<span class="!font-medium mr-1">Wydawca:</span>
								{{ $item['publisher'] }}
							</p>
							@endif
						</div>

						<span class="text-lg text-primary-100 !font-semibold mt-4 mb-2 block">
							Próbka
						</span>

						<div class="portfolio-audio-tracks mb-2 flex flex-wrap flex-row gap-4 items-center">
							@if(!empty($item['audio_file']))
							<div class="portfolio-player relative" x-data="audioPlayer('{{ $item['audio_file'] }}')">
								<audio x-ref="audio" preload="none">
									<source src="{{ $item['audio_file'] }}" type="audio/mpeg">
								</audio>

								<div class="relative w-10 h-10 flex items-center justify-center flex-shrink-0">
									<svg class="absolute top-0 left-0 w-full h-full -rotate-90 origin-center"
										viewBox="0 0 100 100">
										<circle cx="50%" cy="50%" r="42" fill="none" stroke="#E2E8F0" stroke-width="10" />
										<circle cx="50%" cy="50%" r="42" fill="none" stroke="#00579B" stroke-width="10"
											stroke-dasharray="263.89"
											:stroke-dashoffset="263.89 - (263.89 * progress / 100)"
											stroke-linecap="round"
											class="transition-all duration-100 ease-linear" />
									</svg>

									<button @click="togglePlay" type="button"
										class="relative z-10 w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center focus:outline-none hover:scale-105 transition-transform cursor-pointer">
										<svg x-show="!isPlaying" class="w-9 h-9" viewBox="0 0 43 43" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M31.6304 24.2657L18.4714 31.863C17.9711 32.1513 17.4228 32.2959 16.8746 32.2959C16.3263 32.2959 15.7781 32.1513 15.2777 31.863C14.278 31.2854 13.6808 30.2525 13.6808 29.0973V13.9027C13.6808 12.7485 14.278 11.7146 15.2777 11.137C16.2775 10.5594 17.4707 10.5594 18.4705 11.137L31.6294 18.7343C32.6292 19.3119 33.2263 20.3449 33.2263 21.5C33.2263 22.6551 32.6302 23.6881 31.6304 24.2657Z"
												fill="white" />
										</svg>

										<svg x-show="isPlaying" x-cloak class="w-6 h-6" viewBox="0 0 24 24"
											fill="currentColor">
											<path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"></path>
										</svg>
									</button>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>

				<div class="flex-shrink-0 ml-0 sm:ml-4 mt-3 sm:mt-0">
					@if(!empty($item['badge']))
					<span
						class="bg-primary-25 text-primary-900 text-xs !font-semibold px-2 py-1 rounded-[48px] inline-block whitespace-nowrap">
						{{ trim($item['badge']) }}
					</span>
					@endif
				</div>

			</div>
			@endforeach
		</div>
		@endif
	</div>
</section>
```
