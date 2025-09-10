@extends('layouts.public')

@section('content')
<div class="bg-gray-50 py-12 sm:py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Struktur Organisasi</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Jajaran pimpinan dan pejabat di lingkungan Dinas Perkim.
            </p>
        </div>

        {{-- Level Pimpinan --}}
        @if($kepalaDinas)
        <div class="mx-auto mt-16">
            <h3 class="text-2xl font-semibold text-center text-gray-800 mb-10">Pimpinan</h3>
            <div class="flex justify-center">
                <div class="relative bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center w-full max-w-xs overflow-hidden border-2 border-blue-100">
                    <!-- Top Border Decoration -->
                    <div class="h-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>

                    <!-- Card Content -->
                    <div class="p-6 relative">
                        <!-- Background Pattern -->
                        <div class="absolute top-0 right-0 opacity-5">
                            <svg width="100" height="100" viewBox="0 0 100 100">
                                <circle cx="80" cy="20" r="20" fill="currentColor"/>
                                <circle cx="90" cy="60" r="15" fill="currentColor"/>
                            </svg>
                        </div>

                        <div class="flex justify-center mb-4 relative">
                            <div class="relative">
                                <img class="h-40 w-32 rounded-lg object-cover border-4 border-blue-100 shadow-md" src="{{ asset('storage/pejabat/' . $kepalaDinas->foto) }}" alt="Foto {{ $kepalaDinas->nama }}">
                                <!-- Photo Frame Decoration -->
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <h3 class="text-lg font-bold tracking-tight text-gray-900 relative">
                                {{ $kepalaDinas->nama }}
                                <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-12 h-0.5 bg-blue-500 rounded-full"></div>
                            </h3>
                            <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide bg-blue-50 px-3 py-1 rounded-full">{{ $kepalaDinas->jabatan }}</p>
                            @if($kepalaDinas->nip)
                            <p class="text-sm text-gray-500 font-medium">NIP. {{ $kepalaDinas->nip }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Bottom Border Decoration -->
                    <div class="h-1 bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500"></div>
                </div>
            </div>
        </div>
        @endif

        {{-- Level Sekretaris --}}
        @if($sekretaris)
        <div class="mx-auto mt-16">
            <h3 class="text-2xl font-semibold text-center text-gray-800 mb-10">Sekretariat</h3>
            <div class="flex justify-center">
                <div class="relative bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center w-full max-w-xs overflow-hidden border-2 border-blue-100">
                    <!-- Top Border Decoration -->
                    <div class="h-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>

                    <!-- Card Content -->
                    <div class="p-6 relative">
                        <!-- Background Pattern -->
                        <div class="absolute top-0 right-0 opacity-5">
                            <svg width="100" height="100" viewBox="0 0 100 100">
                                <circle cx="80" cy="20" r="20" fill="currentColor"/>
                                <circle cx="90" cy="60" r="15" fill="currentColor"/>
                            </svg>
                        </div>

                        <div class="flex justify-center mb-4 relative">
                            <div class="relative">
                                <img class="h-40 w-32 rounded-lg object-cover border-4 border-blue-100 shadow-md" src="{{ asset('storage/pejabat/' . $sekretaris->foto) }}" alt="Foto {{ $sekretaris->nama }}">
                                <!-- Photo Frame Decoration -->
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <h3 class="text-lg font-bold tracking-tight text-gray-900 relative">
                                {{ $sekretaris->nama }}
                                <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-12 h-0.5 bg-blue-500 rounded-full"></div>
                            </h3>
                            <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide bg-blue-50 px-3 py-1 rounded-full">{{ $sekretaris->jabatan }}</p>
                            @if($sekretaris->nip)
                            <p class="text-sm text-gray-500 font-medium">NIP. {{ $sekretaris->nip }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Bottom Border Decoration -->
                    <div class="h-1 bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500"></div>
                </div>
            </div>
        </div>
        @endif

{{-- Level Kasubag (Kepala Sub Bagian) --}}
        @if($kasubag->isNotEmpty())
        <div class="mx-auto mt-16">
            <h3 class="text-2xl font-semibold text-center text-gray-800 mb-10">Kasubag (Kepala Sub Bagian)</h3>
            <div class="grid max-w-none grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($kasubag as $sub)
                    <div class="relative bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center overflow-hidden border-2 border-blue-100">
                        <!-- Top Border Decoration -->
                        <div class="h-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>

                        <!-- Card Content -->
                        <div class="p-4 relative">
                            <!-- Background Pattern -->
                            <div class="absolute top-0 right-0 opacity-5">
                                <svg width="80" height="80" viewBox="0 0 100 100">
                                    <circle cx="80" cy="20" r="15" fill="currentColor"/>
                                    <circle cx="90" cy="50" r="10" fill="currentColor"/>
                                </svg>
                            </div>

                            <div class="flex justify-center mb-3 relative">
                                <div class="relative">
                                    <img class="h-36 w-28 rounded-lg object-cover border-4 border-blue-100 shadow-md" src="{{ asset('storage/pejabat/' . $sub->foto) }}" alt="Foto {{ $sub->nama }}">
                                    <!-- Photo Frame Decoration -->
                                    <div class="absolute -top-1 -right-1 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <h3 class="text-base font-bold tracking-tight text-gray-900 relative">
                                    {{ $sub->nama }}
                                    <div class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-10 h-0.5 bg-blue-500 rounded-full"></div>
                                </h3>
                                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide bg-blue-50 px-2 py-1 rounded-full">{{ $sub->jabatan }}</p>
                                @if($sub->nip)
                                <p class="text-xs text-gray-500 font-medium">NIP. {{ $sub->nip }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Bottom Border Decoration -->
                        <div class="h-1 bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500"></div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Level Kepala Bidang --}}
        @if($kepalaBidang->isNotEmpty())
        <div class="mx-auto mt-16">
            <h3 class="text-2xl font-semibold text-center text-gray-800 mb-10">Kepala Bidang</h3>
            <div class="grid max-w-none grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($kepalaBidang as $kabid)
                    <div class="relative bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center overflow-hidden border-2 border-blue-100">
                        <!-- Top Border Decoration -->
                        <div class="h-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>

                        <!-- Card Content -->
                        <div class="p-4 relative">
                            <!-- Background Pattern -->
                            <div class="absolute top-0 right-0 opacity-5">
                                <svg width="80" height="80" viewBox="0 0 100 100">
                                    <circle cx="80" cy="20" r="15" fill="currentColor"/>
                                    <circle cx="90" cy="50" r="10" fill="currentColor"/>
                                </svg>
                            </div>

                            <div class="flex justify-center mb-3 relative">
                                <div class="relative">
                                    <img class="h-36 w-28 rounded-lg object-cover border-4 border-blue-100 shadow-md" src="{{ asset('storage/pejabat/' . $kabid->foto) }}" alt="Foto {{ $kabid->nama }}">
                                    <!-- Photo Frame Decoration -->
                                    <div class="absolute -top-1 -right-1 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <h3 class="text-base font-bold tracking-tight text-gray-900 relative">
                                    {{ $kabid->nama }}
                                    <div class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-10 h-0.5 bg-blue-500 rounded-full"></div>
                                </h3>
                                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide bg-blue-50 px-2 py-1 rounded-full">{{ $kabid->jabatan }}</p>
                                @if($kabid->nip)
                                <p class="text-xs text-gray-500 font-medium">NIP. {{ $kabid->nip }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Bottom Border Decoration -->
                        <div class="h-1 bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500"></div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Level Kepala Seksi --}}
        @if($kepalaSeksi->isNotEmpty())
        <div class="mx-auto mt-16">
            <h3 class="text-2xl font-semibold text-center text-gray-800 mb-10">Kepala Seksi</h3>
            <div class="grid max-w-none grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($kepalaSeksi as $seksi)
                    <div class="relative bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center overflow-hidden border-2 border-blue-100">
                        <!-- Top Border Decoration -->
                        <div class="h-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>

                        <!-- Card Content -->
                        <div class="p-4 relative">
                            <!-- Background Pattern -->
                            <div class="absolute top-0 left-0 opacity-5">
                                <svg width="80" height="80" viewBox="0 0 100 100">
                                    <polygon points="20,20 30,10 40,20 30,30" fill="currentColor"/>
                                    <polygon points="10,50 20,40 30,50 20,60" fill="currentColor"/>
                                </svg>
                            </div>

                            <div class="flex justify-center mb-3 relative">
                                <div class="relative">
                                    <img class="h-36 w-28 rounded-lg object-cover border-4 border-blue-100 shadow-md" src="{{ asset('storage/pejabat/' . $seksi->foto) }}" alt="Foto {{ $seksi->nama }}">
                                    <!-- Photo Frame Decoration -->
                                    <div class="absolute -top-1 -right-1 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <h3 class="text-base font-bold tracking-tight text-gray-900 relative">
                                    {{ $seksi->nama }}
                                    <div class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-10 h-0.5 bg-blue-500 rounded-full"></div>
                                </h3>
                                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide bg-blue-50 px-2 py-1 rounded-full">{{ $seksi->jabatan }}</p>
                                @if($seksi->nip)
                                <p class="text-xs text-gray-500 font-medium">NIP. {{ $seksi->nip }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Bottom Border Decoration -->
                        <div class="h-1 bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500"></div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
