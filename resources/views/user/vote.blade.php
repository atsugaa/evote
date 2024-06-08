<?php $i=0;
$img=['0.jpeg','1.jpg']?>
@extends('app')
    @section('title','Vote')
    @section('content')

        <section class="m-16 p-12 rounded-xl bg-gradient-to-r from-[#46428E] to-[#3572B5] text-white text-center">
            <h2 class="text-4xl font-bold mb-5">E-VOTE PEMILIHAN KETUA OSIS</h2>
            <p class="text-lg mb-5">Pilihlah Ketua dan Wakil Ketua OSIS yang dapat menghasilkan <br> program-program yang bermanfaat bagi seluruh siswa</p>
            <div class="text-black bg-white rounded-full py-2 px-6 w-fit mx-auto font-bold text-lg">OSIS SMAS ISLAM DIPONEGORO  GONDANG  2024/2025</div>
        </section>
        <main class="flex flex-wrap justify-evenly items-center px-24 gap-28 pb-16">
            @foreach ( $Calons as $i => $calon )
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="h-80 overflow-hidden">
                    <img class="rounded-lg " src='{{ asset("images/$img[$i]") }}' alt="" />
                </div>
                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ketua Calon : {{ $calon['KETUA_CALON'] }}</h5>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Wakil Calon : {{ $calon['WAKIL_CALON'] }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Visi : {{ $calon['VISI_CALON'] }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Misi : {{ $calon['MISI_CALON'] }}</p>
                    <button data-modal-target="popup-modal{{ $i }}" data-modal-toggle="popup-modal{{ $i }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        VOTE
                        <svg class="rtl:rotate-180 w-3 h-3 text-white mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                    </button>
                </div>
            </div>

            
            <div id="popup-modal{{ $i }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full ">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 bg-gradient-to-b from-[#454490] to-[#366EB2]">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-xl font-normal text-white">Anda Yakin Memilih Calon Ini ?</h3>
                            <button data-modal-hide="popup-modal{{ $i }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">Batal</button>
                            <a href="/pilih?calon={{ $calon['ID_CALON'] }}&user={{ Auth::guard('web')->user()->NISN }}" data-modal-hide="popup-modal{{ $i }}" type="button" class=" font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Yakin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    
            @endforeach
        </main>
        
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-white">Logout</button>
        </form>
    @endsection
</body>
</html>
