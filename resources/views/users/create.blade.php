@extends('layouts.app', [
    'title' => 'Usuários',
    'breadCrumb' => [
        ['text' => 'Usuários', 'route' => 'users.index'],
        ['text' => 'Cadastrar'],
    ]
])

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="row mb-4">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nome"
                           value="">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"
                           value="">
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
                        <option value="user">Usuário</option>
                        <option value="rh">RH</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <p id="message-password" style="color: red; display: none;">As senhas estão diferentes</p>
                <button class="btn btn-outline-primary w-100" id="btn-atualizar">Cadastrar</button>
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
