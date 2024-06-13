@extends('app')
    @section('title','Vote')
    @section('content')
        @if(session()->has('success'))
            <div tabindex="-1" class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="p-4 w-full max-w-md max-h-full ">
                    <div class="bg-white rounded-lg shadow dark:bg-gray-700 bg-gradient-to-b from-[#454490] to-[#366EB2]">
                        <div class="p-4 md:p-5 text-center flex items-center flex-col ">
                            <div role="status">
                                <svg aria-hidden="true" class="inline w-10 h-10 text-gray-600 animate-spin  fill-white" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
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
