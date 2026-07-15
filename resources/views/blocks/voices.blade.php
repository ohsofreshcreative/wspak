<!---- voices ---->

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

		@if (!empty($voices))
		<div class="grid grid-cols-1 md:grid-cols-4 gap-8">

			{{-- SEKCJA FILTRÓW (PO LEWEJ STRONIE) --}}
			<div data-gsap-element="card" class="voices-section col-span-1 mb-8 md:mb-0">
				@php
				$filterLabels = [
				'gender' => 'Płeć',
				'age' => 'Wiek głosu',
				'timbre' => 'Barwa',
				'price' => 'Grupa cenowa',
				'style' => 'Styl interpretacji',
				];
				@endphp
				<div class="mb-6">
				<p class="pb-2 !font-semibold">Wyszukaj lektora</p>
					<input
						type="text"
						id="voice-search"
						class="w-full border !border-primary rounded-lg px-4 py-2">
				</div>
				<div class="voices-filters flex flex-col gap-6">
					@foreach ($filterLabels as $key => $label)
					@if (!empty($filters[$key]))
					<div class="filter-group border-b border-secondary pb-4" data-filter-group="{{ $key }}">
						<p class="filter-group__label !font-semibold pb-4">{{ $label }}</p>
						<div class="flex gap-2 flex-col">
							@foreach ($filters[$key] as $opt)
							<label class="voice-checkbox">
								<input
									type="checkbox"
									class="voice-filter"
									data-filter="{{ $key }}"
									value="{{ Str::slug($opt) }}">
								<span class="text-lg font-medium">{{ $opt }}</span>
							</label>
							@endforeach
						</div>
					</div>
					@endif
					@endforeach
				</div>
			</div>

			{{-- KAFELKI - prawa strona--}}
			<div data-gsap-element="grid-layout" class="col-span-1 md:col-span-3 flex flex-col gap-10">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start ">
					@foreach ($voices as $voice)
					<div class="voice-card p-4 bg-white radius"
						data-gender="{{ Str::slug($voice['gender'] ?? '') }}"
						data-age="{{ Str::slug($voice['age'] ?? '') }}"
						data-timbre="{{ Str::slug($voice['timbre'] ?? '') }}"
						data-price="{{ Str::slug($voice['price'] ?? '') }}"
						data-style="{{ Str::slug($voice['style'] ?? '') }}"
						data-name="{{ Str::lower($voice['name'] ?? '') }}">

						{{-- Górna sekcja --}}
						<div class="flex justify-between items-start">
							<div class="flex flex-col min-h-[76px]">
								<div class="flex items-center gap-1 mb-6">
									@php
									$count = (($voice['price'] ?? '') == 'premium') ? 3 : ((($voice['price'] ?? '') == 'ekonomiczna') ? 2 : 1);
									@endphp
									@for ($i = 0; $i
									< $count; $i++)
										<x-icon.price-icon class="w-2 h-auto flex-shrink-0" />
									@endfor
								</div>

								<h3 class="!text-2xl !font-bold">
									{{ $voice['name'] ?? '' }}
								</h3>
							</div>
							@if(!empty($voice['avatar']))
							<img
								src="{{ $voice['avatar'] }}"
								alt="{{ $voice['name'] ?? '' }}"
								data-gsap-element="img" class="w-19 h-19 rounded-full object-cover flex-shrink-0 ml-4">
							@endif
						</div>

						{{-- Tagi --}}
						<div class="flex flex-wrap gap-1 mt-4 mb-4">
							@if(!empty($voice['age']))
							<span class="bg-primary-25 text-primary-900 text-xs font-medium px-2 py-1 rounded-[48px]">
								{{ trim($voice['age']) }}
							</span>
							@endif
							@if(!empty($voice['timbre']))
							@foreach(explode(',', $voice['timbre']) as $tag)
							<span class="bg-primary-25 text-primary-900 text-xs font-medium px-2 py-1 rounded-[48px]">
								{{ trim($tag) }}
							</span>
							@endforeach
							@endif
							@if(!empty($voice['style']))
							@foreach(explode(',', $voice['style']) as $tag)
							<span class="bg-primary-25 text-primary-900 text-xs font-medium px-2 py-1 rounded-[48px]">
								{{ trim($tag) }}
							</span>
							@endforeach
							@endif
						</div>

						<span class="text-lg text-primary-100 !font-semibold block mb-2">
							Próbka
						</span>

						{{-- Audio --}}
						<div class="voice-audio-tracks flex flex-wrap gap-1 items-center mb-4">
							@if(!empty($voice['audio_tracks']))
							@foreach($voice['audio_tracks'] as $track)
							@if(!empty($track['file']))
							<div class="voice-player relative" x-data="audioPlayer('{{ $track['file'] }}')">
								<audio x-ref="audio" preload="none">
									<source src="{{ $track['file'] }}" type="audio/mpeg">
								</audio>
								<div class="relative w-10 h-10 flex items-center justify-center">
									<svg class="absolute top-0 left-0 w-full h-full -rotate-90" viewBox="0 0 100 100">
										<circle cx="50%" cy="50%" r="42" fill="none" stroke="#E2E8F0" stroke-width="10" />
										<circle
											cx="50%"
											cy="50%"
											r="42"
											fill="none"
											stroke="#00579B"
											stroke-width="10"
											stroke-dasharray="263.89"
											:stroke-dashoffset="263.89 - (263.89 * progress / 100)"
											stroke-linecap="round" />
									</svg>

									<button
										@click="togglePlay"
										type="button"
										class="relative z-10 w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center">

										<svg x-show="!isPlaying" class="w-9 h-9" viewBox="0 0 43 43">
											<path d="M31.6304 24.2657L18.4714 31.863C17.9711 32.1513 17.4228 32.2959 16.8746 32.2959C16.3263 32.2959 15.7781 32.1513 15.2777 31.863C14.278 31.2854 13.6808 30.2525 13.6808 29.0973V13.9027C13.6808 12.7485 14.278 11.7146 15.2777 11.137C16.2775 10.5594 17.4707 10.5594 18.4705 11.137L31.6294 18.7343C32.6292 19.3119 33.2263 20.3449 33.2263 21.5C33.2263 22.6551 32.6302 23.6881 31.6304 24.2657Z" fill="white" />
										</svg>

										<svg x-show="isPlaying" x-cloak class="w-6 h-6" viewBox="0 0 24 24">
											<path d="M6 19h4V5H6zm8-14v14h4V5z" fill="white" />
										</svg>
									</button>
								</div>
							</div>
							@endif
							@endforeach
							@endif
						</div>

						<button
							type="button"
							class="btn btn-secondary !px-4 !py-2 !text-sm">
							Wybierz głos
						</button>
					</div>
					@endforeach
				</div>

				@if(($voices_pages ?? 1) > 1)
				<div class="flex justify-center items-center gap-2 mt-4">
					{{-- PREV --}}
					@if(($voices_page ?? 1) > 1)
					<a href="?vp={{ $voices_page - 1 }}"
						class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white hover:opacity-80 transition-opacity">
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
							<path d="M9.12868 6.58362L5.37373e-06 6.58362L0 5.08363L9.12868 5.08363L5.10571 1.06066L6.16638 0L12 5.83362L6.16637 11.6673L5.1057 10.6066L9.12868 6.58362Z"
								fill="white"
								transform="rotate(180 6 6)" />
						</svg>
					</a>
					@endif

					{{-- NUMERY --}}
					@for($i = 1; $i <= $voices_pages; $i++)
						<a
						href="?vp={{ $i }}"
						class="px-4 py-2 rounded-lg !text-primary-900 transition-opacity hover:opacity-40 {{ ($voices_page ?? 1) == $i ? 'border-2 border-primary-900' : 'border border-primary-100' }}">
						{{ $i }}
						</a>
						@endfor

						{{-- NEXT --}}
						@if(($voices_page ?? 1) < $voices_pages)
							<a href="?vp={{ $voices_page + 1 }}"
							class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white hover:opacity-80 transition-opacity">
							<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
								<path d="M9.12868 6.58362L5.37373e-06 6.58362L0 5.08363L9.12868 5.08363L5.10571 1.06066L6.16638 0L12 5.83362L6.16637 11.6673L5.1057 10.6066L9.12868 6.58362Z" fill="white" />
							</svg>
							</a>
							@endif
				</div>
				@endif
			</div>
		</div>
		@endif

	</div>
</section>