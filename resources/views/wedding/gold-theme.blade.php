<!DOCTYPE html>
<html lang="id">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/output.css') }}" />

    <meta property="og:title" content="Undangan Digital">
    <meta property="og:description" content="Wedding of {{ $wedding->bride_nickname }} & {{ $wedding->groom_nickname }}">
    <meta property="og:image" content="{{ $wedding->cover_image ? Storage::url($wedding->cover_image) : asset('assets/5.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <title>Wedding {{ $wedding->bride_nickname }} & {{ $wedding->groom_nickname }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/heart.ico') }}">
  </head>

  {{-- data-theme dipakai kalau nanti mau menambah override CSS per-tema di style.css,
       mis: [data-theme="maroon"] .bg-base { background-color: #7a1620; } --}}
  <body data-theme="{{ $wedding->theme ?? 'gold' }}"
    style="background-image: url('{{ asset($wedding->theme_assets['bg']) }}');">

    <!-- =========================================================
       MODAL
  ========================================================== -->

    <div class="relative z-10" aria-labelledby="modal-title" role="dialog"
      aria-modal="true" id="modal-container">

      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        aria-hidden="true"></div>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">

        <div
          class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">

          <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
            id="modal-content">

            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">

              <div class="flex sm:flex sm:items-start lg:items-center">

                <div class="mt-3 text-center sm:ml-4 sm:mt-0">

                  <h3>Undangan Pernikahan Untuk</h3>

                  <h3 class="heading">{{ request()->query('to', 'Bapak/Ibu/Saudara/i') }}</h3>

                  <div class="mt-2">
                    <img src="{{ asset($wedding->theme_assets['ring']) }}" alt>
                  </div>

                  <div
                    class="w-name-first text-xl font-greatvibes absolute top-1/2 left-1/2 font-bold transform -translate-x-1/2 -translate-y-1/2">
                    <h3 class="text-2xl font-semibold text-gray-900"
                      id="modal-title">
                      The Wedding of
                    </h3>
                    <h1>{{ $wedding->bride_name }}</h1>
                    <h1>({{ $wedding->bride_nickname }})</h1>
                    <p class="text-sm">dan</p>
                    <h1>{{ $wedding->groom_name }}</h1>
                    <h1>({{ $wedding->groom_nickname }})</h1>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="bg-white px-4 flex py-3 sm:flex sm:flex-row-reverse justify-center sm:px-6">
              <button id="btn-close" type="button"
                class="inline-flex w-80 justify-center rounded-md bg-base px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-deepBlue sm:ml-3 sm:w-auto">
                Buka Undangan
              </button>

            </div>

          </div>

        </div>

      </div>

    </div>

    <!-- =========================================================
       MAIN
  ========================================================== -->

    <main
      class="container p-2 max-w-screen-3xl mx-auto max-sm:px-3 font-serif md:py-5 py-5 max-w-2xl text-center grid gap-4">

      <!-- =========================================================
         NAMA MEMPELAI
    ========================================================== -->
      <section class="content-name rounded-lg">
        <h3 class="text-lg font-bold font-playwrite leading-loose">
          Pernikahan
        </h3>

        <h2 id="fera" class="text-3xl font-bold font-sacramento leading-loose">
          {{ $wedding->bride_name }} ({{ $wedding->bride_nickname }})
        </h2>

        <p class="text-xs">
          @if ($wedding->bride_child_order)
            Putri ke-{{ $wedding->bride_child_order }}
          @endif
          @if ($wedding->bride_father)
            Bpk. {{ $wedding->bride_father }}
          @endif
          @if ($wedding->bride_mother)
            & Ibu {{ $wedding->bride_mother }}
          @endif
        </p>

        <h5 class="text-md font-medium leading-loose">
          dengan
        </h5>

        <h2 id="tawing" class="text-3xl font-bold font-sacramento leading-loose">
          {{ $wedding->groom_name }} ({{ $wedding->groom_nickname }})
        </h2>

        <p class="text-xs">
          @if ($wedding->groom_child_order)
            Putra ke-{{ $wedding->groom_child_order }}
          @endif
          @if ($wedding->groom_father)
            Bpk. {{ $wedding->groom_father }}
          @endif
          @if ($wedding->groom_mother)
            & Ibu {{ $wedding->groom_mother }}
          @endif
        </p>

      </section>

      <!-- =========================================================
         REMARKS
    ========================================================== -->

      <section class="remarks-content rounded-lg">

        <h3
          class="text-xl font-bold underline underline-offset-4 font-playwrite">
          Assalamualaikum Warahmatullahi Wabarokatuh
        </h3>

        <p class="text-sm">
          Dengan memohon Ridho serta Rahmat Allah SWT, kami bermaksud
          menyelenggarakan pernikahan kami yang Insya Allah akan
          diselenggarakan pada:
        </p>

        <div class="wedding-time leading-loose text-md">

          <p>
            {{ $wedding->wedding_date->translatedFormat('d F Y') }}
            @if ($wedding->wedding_date_hijri)
              ({{ $wedding->wedding_date_hijri }})
            @endif
          </p>

          @if ($wedding->wedding_time)
            <p>
              {{ $wedding->wedding_time }}
            </p>
          @endif

          <p>
            Bertempat di
          </p>

          @if ($wedding->location_address)
            <p class="max-md:leading-6">
              {{ $wedding->location_address }}
            </p>
          @endif

        </div>

        <p class="text-sm">
          Merupakan suatu Kehormatan dan Kebahagiaan Bagi Kami, Apabila
          Bapak/Ibu/Saudara/i Berkenan Hadir Untuk memberikan Doa Restu Kepada
          kami.
        </p>

        <h3
          class="text-xl font-bold underline underline-offset-4 font-playwrite">
          Wassalamualaikum Warahmatullahi Wabarokatuh
        </h3>

      </section>

      <!-- =========================================================
         LOVE STORY
    ========================================================== -->

      @if ($wedding->loveStories->isNotEmpty())
        <section class="story rounded-lg">

          <div class="story-header">

            <span class="story-subtitle">
              OUR LOVE STORY
            </span>

            <h2>
              Perjalanan Kisah Cinta Kami
            </h2>

            <p class="story-intro">
              Setiap pertemuan memiliki alasan, setiap perjalanan memiliki cerita,
              dan setiap kisah cinta memiliki waktunya sendiri.
            </p>

          </div>

          <div class="love-timeline">

            @foreach ($wedding->loveStories as $index => $story)
              <article class="story-item">

                <div class="story-marker">
                  <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                </div>

                <div class="story-card">

                  <span class="story-label">
                    {{ $story->label }}
                  </span>

                  <h3>
                    {{ $story->title }}
                  </h3>

                  <div class="story-line"></div>

                  @foreach (preg_split('/\r?\n\r?\n/', $story->content) as $paragraph)
                    @if (trim($paragraph) !== '')
                      <p>
                        {{ trim($paragraph) }}
                      </p>
                    @endif
                  @endforeach

                </div>

              </article>
            @endforeach

          </div>

        </section>
      @endif

    {{-- GALERI FOTO PREWEDDING --}}
    @if ($wedding->gallery_photos && count($wedding->gallery_photos) > 0)
        <section class="gallery-content rounded-lg">
            <div class="gallery-header">
                <span class="story-subtitle">OUR MOMENT</span>

                <h2 class="text-2xl font-bold underline underline-offset-4 font-playwrite">
                    Galeri Foto
                </h2>

                <p class="story-intro text-sm">
                    Beberapa momen kebahagiaan kami yang ingin kami bagikan kepada
                    Bapak/Ibu/Saudara/i.
                </p>
            </div>

            <div class="gallery-grid grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 md:gap-3 mt-4">
                @foreach ($wedding->gallery_photos as $index => $photo)
                    <div class="gallery-item overflow-hidden rounded-lg shadow-md aspect-square">
                        <img
                            src="{{ Storage::url($photo) }}"
                            alt="Galeri foto prewedding {{ $index + 1 }}"
                            loading="lazy"
                            class="h-full w-full object-cover"
                        >
                    </div>
                @endforeach
            </div>
        </section>
    @endif
      <!-- =========================================================
         LOCATION
    ========================================================== -->

      @if ($wedding->location_map_embed)
        <section class="location rounded-lg">

          <h2
            class="text-xl font-bold underline underline-offset-4 font-playwrite mb-2">
            Lokasi Acara
          </h2>

          <div class="maps-content flex items-center justify-center max-w-2/3">

            <iframe
              src="{{ $wedding->location_map_embed }}"
              width="600" height="450" style="border:0;" allowfullscreen
              loading="lazy"
              referrerpolicy="strict-origin-when-cross-origin">
            </iframe>

          </div>

        </section>
      @endif

      <!-- =========================================================
         TITIP HADIAH
    ========================================================== -->

      @if ($wedding->giftAccounts->isNotEmpty())
        <section class="notes-content rounded-md">

          <article
            class="content-wrapper grid grid-cols-1 xl:grid-cols-1 max-w-3xl mx-auto">

            <h2 class="text-xl font-bold underline underline-offset-4">
              Titip Hadiah
            </h2>

            <p class="pb-2">
              Kehadiran dan doa restu Anda adalah kebahagiaan terbesar bagi kami.
              Namun, jika Anda berkeinginan memberikan tanda kasih, kami
              menyediakan
              fasilitas titipan hadiah melalui rekening berikut:
            </p>

            <div class="ex-content grid grid-cols-1 md:grid-cols-2 gap-4 mx-auto">

              @foreach ($wedding->giftAccounts as $account)
                <aside
                  class="in-content rounded-xl p-2 border-b-2 text-white shadow-xl border-white">

                  <h3>
                    {{ $account->bank_name }}
                  </h3>

                  <img src="{{ $account->logo ? Storage::url($account->logo) : asset('assets/card.png') }}"
                    class="max-h-5 max-w-5 mx-auto"
                    alt="{{ $account->bank_name }}">

                  <span>

                    <strong class="copied-text">
                      {{ $account->account_number }}
                    </strong>

                    <br>

                    <button
                      class="copy-text rounded-md p-1 text-xs bg-softBlue border-white border-[1px] hover:bg-deepBlue"
                      data-copy="{{ $account->account_number }}">
                      Salin
                    </button>

                  </span>

                  <p>
                    A/n {{ $account->account_holder }}
                  </p>

                </aside>
              @endforeach

            </div>

          </article>

        </section>
      @endif

      <!-- =========================================================
         SURAH
    ========================================================== -->

      <section class="surah-dua rounded-lg">

        <p>
          {{ $wedding->quote_arabic ?: 'وَمِنۡ اٰيٰتِهٖۤ اَنۡ خَلَقَ لَكُمۡ مِّنۡ اَنۡفُسِكُمۡ اَزۡوَاجًا لِّتَسۡكُنُوۡۤا اِلَيۡهَا وَجَعَلَ بَيۡنَكُمۡ مَّوَدَّةً وَّرَحۡمَةً ؕ اِنَّ فِىۡ ذٰ لِكَ لَاٰيٰتٍ لِّقَوۡمٍ يَّتَفَكَّرُوۡنَ‏ ٢١' }}
        </p>

        <p>
          {{ $wedding->quote_translation ?: 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan diantaramu rasa kasih dan sayang. Sungguh, pada yang demikian itu benar-benar terdapat tanda-tanda kebesaran Allah bagi kaum yang berpikir.' }}
        </p>

        <p>
          ({{ $wedding->quote_source ?: 'QS Ar-Rum Ayat 21' }}).
        </p>

        <br>

      </section>

      <!-- =========================================================
         UCAPAN
    ========================================================== -->

      <section
        class="notes-client w-full flex flex-col items-center justify-center rounded-lg">
        <article class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">

          <aside class="form-notes flex flex-col gap-1">
            <div class="header-notes">
              <h3
                class="mt-3 notes-to font-bold underline underline-offset-4">
                Ucapan untuk Kedua Mempelai
              </h3>
            </div>

            @if (session('success'))
              <p class="text-sm text-green-600">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('wedding.wishes.store', $wedding->slug) }}" class="flex flex-col gap-1">
              @csrf

              <label for="name">
                <span class="p-1 shadow-md">
                  Nama
                </span>
              </label>

              <input
                class="heading p-1 shadow-md focus:outline-none mb-1"
                type="text" id="name" name="name" value="{{ old('name') }}"
                placeholder="Isikan nama anda">
              @error('name')
                <span class="text-xs text-red-500">{{ $message }}</span>
              @enderror

              <label for="note">
                <span class="p-1 shadow-md">
                  Pesan:
                </span>
              </label>

              <textarea
                class="p-1 shadow-md border-base focus:outline-none rounded-sm border-b-2 mb-1"
                id="note" name="message"
                placeholder="Isikan pesan anda">{{ old('message') }}</textarea>
              @error('message')
                <span class="text-xs text-red-500">{{ $message }}</span>
              @enderror

              <button type="submit"
                class="submit-btn border border-spacing-5 rounded-md bg-base text-white hover:bg-deepBlue">
                Kirim
              </button>
            </form>

          </aside>

          <aside
            class="message-notes w-full h-44 p-3 overflow-y-scroll rounded-md">

            <div class="overflow-y-auto bg-none">

              <div class="notes text-left flex flex-col gap-1">

                @forelse ($wedding->wishes as $wish)
                  <div
                    class="flex flex-col border-2 rounded-md p-1 bg-base border-white">
                    <h2 class="heading font-bold text-xl">{{ $wish->name }}</h2>
                    <p class="text-white text-sm">{{ $wish->message }}</p>
                  </div>
                @empty
                  <div
                    class="flex flex-col border-2 rounded-md p-1 bg-base border-white">
                    <h2 class="heading font-bold text-xl">Belum ada ucapan</h2>
                  </div>
                @endforelse

              </div>

            </div>

          </aside>

        </article>

      </section>

      <!-- =========================================================
         WEDDING NAME
    ========================================================== -->

      <section class="w-name rounded-lg">
        <p>
          Atas kehadiran dan do'a restunya, kami ucapkan Terima Kasih
        </p>
        <p>
          Hormat Kami,
        </p>
        <br>
        <div
          class="flex mx-auto font-bold font-sacramento flex-col justify-between items-center gap-5 w-3/4">
          <p class="text-4xl font-bold font-greatvibes leading-loose">
            {{ $wedding->bride_nickname }} & {{ $wedding->groom_nickname }}
          </p>
          <img class="rounded-full max-w-[50%]"
            src="{{ $wedding->couple_photo ? Storage::url($wedding->couple_photo) : asset('assets/marriage.png') }}"
            alt="top-photo">
        </div>

      </section>

      <section class="wedding-audio flex flex-col max-h-12 rounded-md">
      </section>

      <!-- =========================================================
         FOOTER
    ========================================================== -->

      <footer
        class="footer px-1 text-black flex flex-col items-center justify-center text-center gap-1 w-full rounded-lg">

        <p class="text-sm">
          Ingin membuat undangan digital simpel seperti ini?
          Hubungi sosial media dibawah 🥰
        </p>

        <div
          class="footer-social flex flex-row items-center w-full justify-center gap-2 pb-4">

          <a target="_blank"
            class="social-icon-link hover:-translate-y-1 hover:shadow-lg"
            href="https://www.facebook.com/machbub.achwani">

            <img class="max-w-8" src="{{ asset('assets/fb.svg') }}" alt="Facebook">

          </a>

          <a target="_blank"
            class="social-icon-link hover:-translate-y-1 hover:shadow-lg"
            href="https://www.instagram.com/mhbb_is">

            <img class="max-w-8" src="{{ asset('assets/ig.svg') }}" alt="Instagram">

          </a>

          <a target="_blank"
            class="social-icon-link hover:-translate-y-1 hover:shadow-lg"
            href="https://wa.me/6283890771449">

            <img class="max-w-8" src="{{ asset('assets/wa.svg') }}" alt="WhatsApp">

          </a>

        </div>
        <p class="flex flex-row items-center justify-center pb-2 gap-1">

          Made with

          <img src="{{ asset('assets/love.png') }}" alt="img-icon">

          by Mahbub Ahwani
        </p>

      </footer>

      <!-- =========================================================
         FLOATING AUDIO DISC
    ========================================================== -->
      @if ($wedding->audio_file)
        <div class="fixed-audio" onclick="toggleAudio()">
          <div id="audio-disc" class="disc-icon">
            <img src="{{ asset('assets/disk.png') }}" alt="audio-disc">
          </div>

          <audio id="myAudio" loop src="{{ asset('assets/sezairi.mp3') }}" type="audio/mpeg"></audio>
        </div>
      @endif

    </main>

    <script src="{{ asset('js/script.js') }}"></script>
  </body>

</html>