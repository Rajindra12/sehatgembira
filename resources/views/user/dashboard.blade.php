@extends('layouts.app')
@section('content')
<div class="py-12">
        <div class="hero-content flex-col lg:flex-row-reverse max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img
            src="https://img.freepik.com/free-photo/empty-stadium-day_1308-41390.jpg?t=st=1745814504~exp=1745818104~hmac=da553dfa60a4fa922a576912d118d89dae02fc8e4cb78ea1d070c7ca51965be5&w=1380"
            class="max-w-lg rounded-lg shadow-2xl"
            />
            <div class="">
            <h1 class="text-5xl font-bold">Box Office News!</h1>
            <p class="py-6">
                Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                quasi. In deleniti eaque aut repudiandae et a id nisi.
            </p>
            <button class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="stats stats-vertical lg:stats-horizontal shadow">
              <div class="stat">
                <div class="stat-title">Downloads</div>
                <div class="stat-value">31K</div>
                <div class="stat-desc">Jan 1st - Feb 1st</div>
              </div>
            
              <div class="stat">
                <div class="stat-title">New Users</div>
                <div class="stat-value">4,200</div>
                <div class="stat-desc">↗︎ 400 (22%)</div>
              </div>
            
              <div class="stat">
                <div class="stat-title">New Registers</div>
                <div class="stat-value">1,200</div>
                <div class="stat-desc">↘︎ 90 (14%)</div>
              </div>
            </div>
      </div>
    </div>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="p-6 text-gray-900">
                  {{ __("You're Logged In!") }}
                </div>
            </div>
        </div>
    </div> --}}
@endsection