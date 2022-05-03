@extends('layout.main-layout')
@section('content')

    <div id="app" class="chat-bg">
        <template>
            <div class="layout-wrapper d-lg-flex">

                <!-- Side Bar -->
                @include('navbar.menu')


                <!-- Inner Navbar -->
                <div id="inner-navbar" class="chat-leftsidebar">
                    <div class="tab-content">
                        @include('navbar.inner-profile')
                        @include('navbar.inner-channels')           
                    </div>
                </div>


                <!-- Main Body -->
                @include('body.chat-pane')
                @include('body.user-pane')
                @include('body.channel-pane')

            </div>

            <div id="loader">
                <div class="loading">Loading&#8230;</div>
            </div>


            <!-- Modal Body -->
            @include('modal.create-channel')
            @include('modal.edit-channel')
            @include('modal.channel-members')
        </template>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>


@endsection
