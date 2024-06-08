@extends('app')

@section('content')
<main class="flex justify-center py-20">
  <div class="flex h-[85vh] w-[90vw] drop-shadow-lg rounded-xl overflow-hidden bg-white">
    <div class="h-full w-[55%] bg-cover" style="background-image: url('{{ asset('images/logo Evote 2.png') }}')">
      <div class="w-full h-full bg-[#2b3296] bg-opacity-70 text-white flex flex-col justify-evenly items-center">
        <p class="text-3xl w-[80%] leading-normal">"Mulailah Pengalaman Demokratis di Sekolah Anda"</p>
      </div>
    </div>
    <div class="h-full w-[45%]">
        <div id="default-styled-tab-content">
            <div class="rounded-lg bg-gray-50" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
                <p class="text-3xl text-center">Masuk</p>
                <form method="POST" action="{{ route('admin.login.submit') }}" class="max-w-sm mx-auto mt-10 flex flex-col">
                    @csrf
                    <div class="mb-5">
                        @error('error')
                            <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                              <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                              </svg>
                              <span class="sr-only">Info</span>
                              <div class="ms-3 text-sm font-medium">
                                {{ $message }}
                              </div>
                              <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                              </button>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="ID_ADMIN" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Admin {{ Auth::guard('admin')->id() }}</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="ID_ADMIN" name="ID_ADMIN" value="{{ old('ID_ADMIN') }}">
                        @error('ID_ADMIN')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="PASSWORD_ADMIN" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" class="input" id="PASSWORD_ADMIN" name="PASSWORD_ADMIN">
                        @error('PASSWORD_ADMIN')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection