@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="row">
                <div class="col-md-8 p-4 sm:p-8 shadow">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="col-md-4 p-4 sm:p-8 shadow">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow">
                <div class="max-w-xl">
                    @include('profile.partials.user-purchases-details', ['purchases' => $purchases])
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow mt-4">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

@endsection
