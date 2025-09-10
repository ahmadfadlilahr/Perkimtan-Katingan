{{-- resources/views/components/home/unduhan-preview.blade.php --}}
<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Unduhan Populer</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Dokumen dan formulir yang sering diunduh masyarakat
            </p>
        </div>

        @if($unduhanPreview && $unduhanPreview->count() > 0)
            <div class="mx-auto mt-12 max-w-4xl">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($unduhanPreview as $unduhan)
                        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 group">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-indigo-100 group-hover:bg-indigo-200 transition-colors duration-200">
                                        <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">
                                        {{ Str::limit($unduhan->judul, 50) }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ Str::limit($unduhan->deskripsi, 70) }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ asset('storage/unduhan/' . $unduhan->file) }}"
                                   target="_blank"
                                   class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                    Unduh File
                                    <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('unduhan.public') }}"
                       class="inline-flex items-center rounded-md bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-200">
                        Lihat Semua Unduhan
                        <svg class="ml-2 -mr-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        @else
            <div class="mt-12 text-center text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="mt-2">Belum ada file untuk diunduh</p>
            </div>
        @endif
    </div>
</section>
