@extends('layouts.guest')
@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="hero  min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse">
          <div class="text-center lg:text-center ml-60">
            <h1 class="text-5xl font-bold">Login now!</h1>
            <p class="py-6">
              Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
              quasi. In deleniti eaque aut repudiandae et a id nisi.
            </p>
          </div>
          <div class="card bg-white w-full max-w-sm shrink-0 shadow-2xl">
            <div class="card-body">  
              <form method="POST" action="{{ route('login') }}">
                  @csrf
          
                  {{-- Email Address --}}
                  <div>
                      <x-input-label for="email" :value="__('Email')" />
                      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
          
                  {{-- Password --}}
                  <div class="mt-4">
                      <x-input-label for="password" :value="__('Password')" />
          
                      <x-text-input id="password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />
          
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
          
                  {{-- Remember Me --}}
                  <div class="block mt-4">
                      <label for="remember_me" class="inline-flex items-center">
                          <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                          <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                      </label>
                  </div>
                  
                  {{-- Continue as Guest --}}
                    <div class="mt-6 text-center">
                        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-600 text-sm">
                            <i class="fa-solid fa-user-secret mr-1"></i> Continue as Guest
                        </a>
                    </div>
                  
                  {{-- Forgot Password --}}
                  <div class="flex items-center justify-end mt-4">
                      @if (Route::has('password.request'))
                          <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                              {{ __('Forgot your password?') }}
                          </a>
                      @endif
                    </div>
    
                    {{-- Login Button --}}
                      <x-primary-button class="ms-3">
                          {{ __('Log in') }}
                      </x-primary-button>
                  </div>
              </form>
            </div>
        </div>      
        </div>
    </div>
@endsection
