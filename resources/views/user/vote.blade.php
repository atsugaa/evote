@extends('app')
    @section('title','Vote')
    @section('content')
        @if(session()->has('success'))
            <div tabindex="-1" class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="p-4 w-full max-w-md max-h-full ">
                    <div class="bg-white rounded-lg shadow dark:bg-gray-700 bg-gradient-to-b from-[#454490] to-[#366EB2]">
                        <div class="p-4 md:p-5 text-center flex items-center flex-col ">
                            <div id="loading-spinner" class="mx-auto mb-4">
                                <svg role="status" class="w-8 h-8 text-gray-500 animate-spin dark:text-gray-600 fill-white" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.59c0 27.614-22.386 50-50 50s-50-22.386-50-50 22.386-50 50-50 50 22.386 50 50zM9.081 50.59c0 22.598 18.322 40.919 40.919 40.919 22.598 0 40.919-18.322 40.919-40.919S72.598 9.67 50 9.67 9.081 27.992 9.081 50.59z" fill="currentColor"/>
                                    <path d="M93.968 39.041c2.272-.52 3.678-2.832 2.757-5.041-4.71-11.97-13.018-22.01-23.435-29.007-10.415-6.996-22.905-10.55-35.47-10.272-12.566.277-24.935 4.334-35.13 11.445C2.495 12.203.72 14.545 1.26 17.043c.518 2.272 2.832 3.678 5.04 2.757 9.269-4.204 19.237-6.395 29.415-6.42 10.18-.026 20.163 2.164 29.46 6.378 9.297 4.213 17.439 10.52 24.175 18.627 6.736 8.107 11.833 17.628 14.394 27.995 2.562 10.367 2.76 21.44.577 32.09-.048.242-.096.482-.145.722a49.643 49.643 0 00-.313 2.173h4.335c2.209 0 4.009-1.8 4.009-4.009V59.086c0-1.188-.493-2.322-1.377-3.168-2.092-2.042-4.262-4.012-6.527-5.91-4.444-3.856-9.31-7.285-14.45-10.154a64.935 64.935 0 00-9.336-4.324c-2.507-1.03-5.114-1.95-7.716-2.747z" fill="currentFill"/>
                                </svg>
                            </div>    
                            <h2 class="text-2xl text-white tracking-tight mb-4">
                                {{ session('success') }}
                            </h2>
                            <form method="POST" action="{{ route('logout') }}" id="autoSubmit">
                                @csrf
                                <button type="submit" class="ring-2 ring-white font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">OK</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div modal-backdrop="" class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40"></div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    setTimeout(function() {
                        document.getElementById('autoSubmit').submit();
                    }, 3000);
                });
            </script>
        @endif
        <section class="m-6 flex flex-col items-center md:m-14 lg:m-20 p-12 rounded-xl bg-gradient-to-r from-[#46428E] to-[#3572B5] text-white text-center">
            <h2 class="text-xl md:text-2xl lg:text-4xl font-bold mb-5">E-VOTE PEMILIHAN KETUA {{ strtoupper($pemilihan['NAMA_VOTING']) }}</h2>
            <p class="text-base md:text-lg mb-5 max-w-lg">Pilihlah Ketua dan Wakil Ketua {{ $pemilihan['NAMA_VOTING'] }} yang dapat menghasilkan program-program yang bermanfaat bagi seluruh siswa</p>
            <div class="text-base text-black bg-white rounded-full py-2 px-6 w-fit mx-auto font-bold md:text-lg">SMAS ISLAM DIPONEGORO  GONDANG MOJOKERTO  {{ date('Y') }}/{{ date('Y')+1 }}</div>
        </section>
        <main class="flex flex-wrap justify-evenly items-center px-6 md:px-24 gap-28 pb-16">
            @foreach ( $Calons as $i => $calon )
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 drop-shadow-md">
                <div class="h-80 overflow-hidden">
                    <img class="rounded-lg " src='{{ asset("storage/images/".$calon['GAMBAR_CALON']) }}' alt="" />
                </div>
                <div class="p-5">
                    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">Calon Ketua {{ $pemilihan['NAMA_VOTING'] }}</h5>
                    <p class="mb-6 text-xl tracking-tight text-gray-900">{{ $calon['KETUA_CALON'] }}</p>
                    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">Calon Wakil Ketua {{ $pemilihan['NAMA_VOTING'] }}<h5>
                        <p class="mb-6 text-xl  tracking-tight text-gray-900">{{ $calon['WAKIL_CALON'] }}</p>
                    <button data-modal-target="popup-modal1{{ $i }}" data-modal-toggle="popup-modal1{{ $i }}" class="inline-flex items-center px-3 mr-2 py-2 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        DETAIL
                        <svg class="rtl:rotate-180 w-3 h-3 text-white mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                    </button>
                    <button data-modal-target="popup-modal{{ $i }}" data-modal-toggle="popup-modal{{ $i }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        VOTE
                        <svg class="rtl:rotate-180 w-3 h-3 text-white mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="popup-modal1{{ $i }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full ">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="p-4 md:p-5 text-center">
                            <div class="h-80 overflow-hidden rounded-lg">
                                <img class=" " src='{{ asset("storage/images/".$calon['GAMBAR_CALON']) }}' alt="" />
                            </div>
                            <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">Calon Ketua {{ $pemilihan['NAMA_VOTING'] }}</h5>
                            <p class="mb-6 text-xl tracking-tight text-gray-900">{{ $calon['KETUA_CALON'] }}</p>
                            <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">Calon Wakil Ketua {{ $pemilihan['NAMA_VOTING'] }}<h5>
                            <p class="mb-6 text-xl  tracking-tight text-gray-900">{{ $calon['WAKIL_CALON'] }}</p>
                            <h5 class="mb-1 text-xl font-bold tracking-tight text-gray-900">Visi</h5>
                            <p class="mb-4 font-normal text-gray-700">{{ $calon['VISI_CALON'] }}</p>
                            <h5 class="mb-1 text-xl font-bold tracking-tight text-gray-900">Misi</h5>
                            <p class="mb-4 font-normal text-gray-700 ">{{ $calon['MISI_CALON'] }}</p> 
                            <button data-modal-hide="popup-modal1{{ $i }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium rounded-lg text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="popup-modal{{ $i }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-xl max-h-full ">
                    <div class="relative p-11 bg-white rounded-lg shadow dark:bg-gray-700 bg-gradient-to-b from-[#454490] to-[#366EB2]">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-16 h-16 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-2xl font-normal text-white">Apakah Anda Yakin Memilih Calon Ini ?</h3>
                            <button data-modal-hide="popup-modal{{ $i }}" type="button" class="py-2.5 px-5 ms-3 mr-4 text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 ring-white ring-2 ">Batal</button>
                            <a href="/pilih?calon={{ $calon['ID_CALON'] }}&user={{ Auth::guard('web')->user()->NISN }}" data-modal-hide="popup-modal{{ $i }}" type="button" class=" font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ring-white ring-2">
                                Yakin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
    
            @endforeach
        </main>
        
        
        
    @endsection
</body>
</html>
