@extends('layouts.app', [
    'title' => 'Usuários',
    'btnText' => 'Cadastrar usuário',
    'btnRoute' => 'users.create',
    'breadCrumb' => [
        ['text' => 'Usuários'],
    ]
])

@section('content')
    <div class="row mb-4">
        <div class="col-12 d-flex gap-3">
            <button class="btn btn-primary btn-switch" data-row="user" disabled>Usuários</button>
            <button class="btn btn-primary btn-switch" data-row="rh">RH</button>
            <button class="btn btn-primary btn-switch" data-row="admin">Administradores</button>
        </div>
    </div>
    <div class="row" id="row-user">
        @php
            $usersUser = $users->filter(function($user) {
                return $user->hasRole('user');
            });
        @endphp
        @foreach($usersUser as $user)
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-truncate">{{ $user->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $user->email }}</p>
                        <a href="{{ route('users.edit', $user->id) }}">
                            <button class="btn btn-outline-primary w-100">Visualizar</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row" id="row-rh" style="display: none;">
        @php
            $usersRH = $users->filter(function($user) {
                return $user->hasRole('RH');
            });
        @endphp
        @foreach($usersRH as $user)
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-truncate">{{ $user->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $user->email }}</p>
                        <a href="{{ route('users.edit', $user->id) }}">
                            <button class="btn btn-outline-primary w-100">Visualizar</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row" id="row-admin" style="display: none;">
        @php
            $usersAdmin = $users->filter(function($user) {
                return $user->hasRole('admin');
            });
        @endphp
        @foreach($usersAdmin as $user)
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-truncate">{{ $user->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $user->email }}</p>
                        <a href="{{ route('users.edit', $user->id) }}">
                            <button class="btn btn-outline-primary w-100">Visualizar</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @push('js')
        <script>
            $(document).ready(function () {
                $('.btn-switch').click(function () {
                    $('.btn-switch').attr('disabled', false);
                    $(this).attr('disabled', true);

                    $('#row-user').hide();
                    $('#row-rh').hide();
                    $('#row-admin').hide();

                    row = $(this).data('row');
                    $('#row-' + row).show();
                });
            });
        </script>
    @endpush
@endsection
