@extends('layouts.app', [
    'title' => 'Usuários',
    'breadCrumb' => [
        ['text' => 'Usuários', 'route' => 'users.index'],
        ['text' => $user->name],
    ]
])

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-4">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nome"
                           value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"
                           value="{{ $user->email }}">
                </div>
                <div class="form-group d-flex align-items-center">
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Digite a senha"
                           value="">
                    <a class="show-password">Mostrar</a>
                </div>
                <div class="form-group d-flex align-items-center">
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                           placeholder="Digite novamente a senha"
                           value="">
                    <a class="show-password">Mostrar</a>
                </div>
                <div class="form-group d-flex align-items-center">
                    <select class="form-control" name="role" id="role">
                        <option value="user" @selected($user->hasRole('user'))>Usuário</option>
                        <option value="rh" @selected($user->hasRole('RH'))>RH</option>
                        <option value="admin" @selected($user->hasRole('admin'))>Administrador</option>
                    </select>
                </div>
                <p id="message-password" style="color: red; display: none;">As senhas estão diferentes</p>
                <button class="btn btn-outline-primary w-100" id="btn-atualizar">Atualizar</button>
            </div>
            <div class="col-sm-6">
                @if($user->curriculum)
                    <div class="card">
                        <div class="card-header">
                            <h3>Currículo</h3>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $user->curriculum->phone }}</p>
                            <p>{{ $user->curriculum->user->email }}</p>
                            <a href="{{ route('curriculum.edit', $user->curriculum->id) }}">
                                <button class="btn btn-outline-primary w-100">Visualizar</button>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Usuário sem currículo</p>
                                <a href="{{ route('curriculum.create', $user->id) }}"
                                   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Cadastrar</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>

    @push('js')
        <script>
            $(document).ready(function () {
                $(".show-password").on('click', function () {
                    var input = $(this).prev('input');
                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                    } else {
                        input.attr('type', 'password');
                    }
                });

                $("#password_confirm").on('blur', function () {
                    if ($(this).val() !== $("#password").val()) {
                        $("#message-password").show('speed');
                        $("#btn-atualizar").prop('disabled', true);
                    } else {
                        $("#message-password").hide('speed');
                        $("#btn-atualizar").prop('disabled', false);
                    }
                });
            });
        </script>
    @endpush
@endsection
