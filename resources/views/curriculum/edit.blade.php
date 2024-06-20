@extends('layouts.app', [
    'title' => 'Currículo',
    'breadCrumb' => [
        ['text' => 'Currículos', 'route' => 'curriculum.index'],
        ['text' => $curriculum->user->name],
    ]
])

@section('content')
    <form class="d-flex" action="{{ route('curriculum.update', $curriculum->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-sm-4">
            <div class="form-group">
                <select class="form-control" name="user" id="user">
                    <option value="{{ $curriculum->user->id }}">{{ $curriculum->user->name }}</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone"
                       value="{{ $curriculum->phone }}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="CEP"
                       value="{{ $curriculum->zip_code }}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="address" name="address" placeholder="Endereço"
                       value="{{ $curriculum->address }}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" list="dataListStates" name="state" id="state"
                       onchange="updateStates()" placeholder="Estado" value="{{ $curriculum->state }}">
                <datalist id="dataListStates">
                    <x-states/>
                </datalist>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" list="dataListCitys" name="city" id="city" placeholder="Cidade"
                       value="{{ $curriculum->city }}">
                <datalist id="dataListCitys"></datalist>
            </div>
            <button class="btn btn-outline-primary w-100">Atualizar</button>
        </div>
        <div class="col-sm-8">
            <div class="row gap-3">
                <div class="col-sm-12" id="skills">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Habilidades</h3>
                            <button class="btn btn-outline-primary" id="btnAddSkill">Adicionar</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if($curriculum->skills->isNotEmpty())
                                    @foreach($curriculum->skills as $skill)
                                        <div class="form-group row">
                                            <input type="hidden" name="skill_id[]" value="{{ $skill->id }}">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="skill" name="skill[]"
                                                       placeholder="Habilidades" value="{{ $skill->name }}">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="level" name="level[]"
                                                       placeholder="Nível" value="{{ $skill->level }}">
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-outline-danger w-100 btnRemoveSkill"><i
                                                        data-feather="trash"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" id="experiences">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Experiências</h3>
                            <button class="btn btn-outline-primary" id="btnAddExperience">Adicionar</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if($curriculum->experiences->isNotEmpty())
                                    @foreach($curriculum->experiences as $experience)
                                        <div class="form-group mb-5">
                                            <div class="row">
                                                <input type="hidden" name="experience_id[]" value="{{ $experience->id }}">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="company" name="company[]"
                                                           placeholder="Empresa" value="{{ $experience->company }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="position" name="position[]"
                                                           placeholder="Posição" value="{{ $experience->position }}">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control" id="start_date" name="start_date[]"
                                                           placeholder="Data inicial" value="{{ $experience->start_date }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control" id="end_date" name="end_date[]"
                                                           placeholder="Data final" value="{{ $experience->end_date }}">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-outline-danger w-100 btnRemoveExperience"><i
                                                            data-feather="trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" id="educations">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Educação</h3>
                            <button class="btn btn-outline-primary" id="btnAddEducations">Adicionar</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if($curriculum->educations->isNotEmpty())
                                    @foreach($curriculum->educations as $education)
                                        <div class="form-group mb-5">
                                            <input type="hidden" name="education_id[]" value="{{ $education->id }}">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="course" name="course[]"
                                                           placeholder="Curso" value="{{ $education->course }}">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="institution" name="institution[]"
                                                           placeholder="Instituição" value="{{ $education->institution }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control" id="status" name="status[]">
                                                        <option value="1" {{ $education->status == 1 ? 'selected' : '' }}>
                                                            Cursando
                                                        </option>
                                                        <option value="2" {{ $education->status == 2 ? 'selected' : '' }}>
                                                            Concluído
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control" id="start_date" name="start_date[]"
                                                           placeholder="Data inicial" value="{{ $education->start_date }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control" id="end_date" name="end_date[]"
                                                           placeholder="Data final" value="{{ $education->end_date }}">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-outline-danger w-100 btnRemoveEducations"><i
                                                            data-feather="trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" id="certifications">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Certificados</h3>
                            <button class="btn btn-outline-primary" id="btnAddCertifications">Adicionar</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if($curriculum->certifications->isNotEmpty())
                                    @foreach($curriculum->certifications as $certification)
                                        <div class="form-group mb-5">
                                            <div class="row">
                                                <input type="hidden" name="certification_id[]" value="{{ $certification->id }}">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="certification" name="certification[]"
                                                           placeholder="Certificação" value="{{ $certification->certification }}">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="institution" name="institution[]"
                                                           placeholder="Instituição" value="{{ $certification->institution }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control" id="date" name="date[]"
                                                           placeholder="Data" value="{{ $certification->date }}">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-outline-danger w-100 btnRemoveCertifications"><i
                                                            data-feather="trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" id="languages">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Idiomas</h3>
                            <button class="btn btn-outline-primary" id="btnAddLanguages">Adicionar</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if($curriculum->languages->isNotEmpty())
                                    @foreach($curriculum->languages as $language)
                                        <div class="form-group mb-5">
                                            <div class="row">
                                                <input type="hidden" name="language_id[]" value="{{ $language->id }}">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="language" name="language[]"
                                                           placeholder="Idioma" value="{{ $language->language }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="level" name="level[]"
                                                           placeholder="Nível" value="{{ $language->level }}">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-outline-danger w-100 btnRemoveLanguages"><i
                                                            data-feather="trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" id="hobbys">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Lazer</h3>
                            <button class="btn btn-outline-primary" id="btnAddHobbys">Adicionar</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if($curriculum->hobbies->isNotEmpty())
                                    @foreach($curriculum->hobbies as $hobby)
                                        <div class="form-group mb-5">
                                            <div class="row">
                                                <input type="hidden" name="hobby_id[]" value="{{ $hobby->id }}">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="hobby" name="hobby[]"
                                                           placeholder="Lazer" value="{{ $hobby->hobby }}">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-outline-danger w-100 btnRemoveHobbys"><i
                                                            data-feather="trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12"></div>
            </div>
        </div>
    </form>

    @push('js')
        <script>
            const loader = $("#loader");

            $(document).ready(function () {
                $('#btnAddSkill').click(function (e) {
                    e.preventDefault();

                    $('#skills').find('.card-body').append(
                        "<div class='form-group row'>" +
                        "<input type='hidden' name='skill_id[]' value=''>" +
                        "<div class='col-sm-6'><input type='text' class='form-control' id='skill' name='skill[]' placeholder='Habilidades'> </div>" +
                        "<div class='col-sm-4'><input type='text' class='form-control' id='level' name='level[]' placeholder='Nível'> </div>" +
                        "<div class='col-sm-2'><button class='btn btn-outline-danger w-100 btnRemoveSkill'><i data-feather='trash'></i></button></div>" +
                        "</div>"
                    );

                    feather.replace();

                    $('.btnRemoveSkill').click(function (e) {
                        e.preventDefault();
                        $(this).closest('.form-group').remove();
                    });
                });

                $('.btnRemoveSkill').click(function (e) {
                    e.preventDefault();
                    $(this).closest('.form-group').remove();
                });

                $('#btnAddExperience').click(function (e) {
                    e.preventDefault();

                    $('#experiences').find('.card-body').append(
                        "<div class='form-group mb-5'>" +
                        "<div class='row'>" +
                        "<input type='hidden' name='experience_id[]' value=''>" +
                        "<div class='col-sm-6'><input type='text' class='form-control' id='company' name='company[]' placeholder='Empresa'> </div>" +
                        "<div class='col-sm-6'><input type='text' class='form-control' id='position' name='position[]' placeholder='Posição'> </div>" +
                        "</div>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-sm-6'><input type='date' class='form-control' id='start_date' name='start_date[]' placeholder='Data inicial'> </div>" +
                        "<div class='col-sm-6'><input type='date' class='form-control' id='end_date' name='end_date[]' placeholder='Data final'> </div>" +
                        "</div>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-sm-12'><button class='btn btn-outline-danger w-100 btnRemoveExperience'><i data-feather='trash'></i></button></div>" +
                        "</div>" +
                        "</div>"
                    );

                    feather.replace();

                    $('.btnRemoveExperience').click(function (e) {
                        e.preventDefault();
                        $(this).closest('.form-group').remove();
                    });
                });

                $('.btnRemoveExperience').click(function (e) {
                    e.preventDefault();
                    $(this).closest('.form-group').remove();
                });

                $('#btnAddEducations').click(function (e) {
                    e.preventDefault();

                    $('#educations').find('.card-body').append(
                        "<div class='form-group mb-5'>" +
                        "<div class='row'>" +
                        "<input type='hidden' name='education_id[]' value=''>" +
                        "<div class='col-sm-12'><input type='text' class='form-control' id='course' name='course[]' placeholder='Curso'> </div>" +
                        "</div>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-sm-6'><input type='text' class='form-control' id='institution' name='institution[]' placeholder='Instituição'> </div>" +
                        "<div class='col-sm-6'>" +
                        "<select class='form-control' id='status' name='status[]'> " +
                        "<option value='1'>Cursando</option>" +
                        "<option value='2'>Concluído</option>" +
                        "</select>" +
                        "</div>" +
                        "</div>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-sm-6'><input type='date' class='form-control' id='start_date' name='start_date[]' placeholder='Data inicial'> </div>" +
                        "<div class='col-sm-6'><input type='date' class='form-control' id='end_date' name='end_date[]' placeholder='Data final'> </div> " +
                        "</div>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-sm-12'><button class='btn btn-outline-danger w-100 btnRemoveEducations'><i data-feather='trash'></i></button></div>" +
                        "</div>" +
                        "</div>" +
                        "</div>"
                    );

                    feather.replace();

                    $('.btnRemoveEducations').click(function (e) {
                        e.preventDefault();
                        $(this).closest('.form-group').remove();
                    });
                });

                $('.btnRemoveEducations').click(function (e) {
                    e.preventDefault();
                    $(this).closest('.form-group').remove();
                });

                $('#btnAddCertifications').click(function (e) {
                    e.preventDefault();

                    $('#certifications').find('.card-body').append(
                        "<div class='form-group mb-5'>" +
                        "<div class='row'>" +
                        "<input type='hidden' name='certification_id[]' value=''>" +
                        "<div class='col-sm-12'><input type='text' class='form-control' id='certification' name='certification[]' placeholder='Certificação'> </div>" +
                        "</div>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-sm-6'><input type='text' class='form-control' id='institution' name='institution[]' placeholder='Instituição'> </div>" +
                        "<div class='col-sm-6'><input type='date' class='form-control' id='date' name='date[]' placeholder='Data'> </div>" +
                        "</div>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-sm-12'><button class='btn btn-outline-danger w-100 btnRemoveCertifications'><i data-feather='trash'></i></button></div>" +
                        "</div>" +
                        "</div>"
                    );

                    feather.replace();

                    $('.btnRemoveCertifications').click(function (e) {
                        e.preventDefault();
                        $(this).closest('.form-group').remove();
                    });
                });

                $('.btnRemoveCertifications').click(function (e) {
                    e.preventDefault();
                    $(this).closest('.form-group').remove();
                });

                $('#btnAddLanguages').click(function (e) {
                    e.preventDefault();

                    $('#languages').find('.card-body').append(
                        "<div class='form-group mb-5'>" +
                        "<div class='row'>" +
                        "<input type='hidden' name='language_id[]' value=''>" +
                        "<div class='col-sm-6'><input type='text' class='form-control' id='language' name='language[]' placeholder='Idioma'> </div>" +
                        "<div class='col-sm-6'><input type='text' class='form-control' id='level' name='level[]' placeholder='Nível'> </div>" +
                        "</div>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-sm-12'><button class='btn btn-outline-danger w-100 btnRemoveLanguages'><i data-feather='trash'></i></button></div>" +
                        "</div>" +
                        "</div>"
                    );

                    feather.replace();

                    $('.btnRemoveLanguages').click(function (e) {
                        e.preventDefault();
                        $(this).closest('.form-group').remove();
                    });
                });

                $('.btnRemoveLanguages').click(function (e) {
                    e.preventDefault();
                    $(this).closest('.form-group').remove();
                });

                $('#btnAddHobbys').click(function (e) {
                    e.preventDefault();

                    $('#hobbys').find('.card-body').append(
                        "<div class='form-group mb-5'>" +
                        "<div class='row'>" +
                        "<input type='hidden' name='hobby_id[]' value=''>" +
                        "<div class='col-sm-12'><input type='text' class='form-control' id='hobby' name='hobby[]' placeholder='Lazer'> </div>" +
                        "</div>" +
                        "<div class='row mt-2'>" +
                        "<div class='col-sm-12'><button class='btn btn-outline-danger w-100 btnRemoveHobbys'><i data-feather='trash'></i></button></div>" +
                        "</div>" +
                        "</div>"
                    );

                    feather.replace();

                    $('.btnRemoveHobbys').click(function (e) {
                        e.preventDefault();
                        $(this).closest('.form-group').remove();
                    });
                });

                $('.btnRemoveHobbys').click(function (e) {
                    e.preventDefault();
                    $(this).closest('.form-group').remove();
                });

                $('#phone').mask('(00) 0 0000-0000');

                $('#zip_code').mask('00000-000');

                $('#zip_code').on('blur', buscaCEP);
            });

            function buscaCEP() {
                var cep = $("#zip_code").val();

                loader.show();

                $.ajax({
                    url: `https://viacep.com.br/ws/${cep}/json/`,
                    method: 'GET',
                    success: function (response) {
                        $("#address").val(response.logradouro);
                        $('#state').val(response.uf);
                        $('#city').val(response.localidade);
                    },
                    error: function (error) {
                        console.error('Erro ao consultar CEP:', error);
                    },
                    complete: function () {
                        loader.hide();
                    }
                });
            }

            function updateStates() {
                const stateSelect = $("#state").val();
                const dataListCitys = $("#dataListCitys");

                loader.show();

                $.ajax({
                    url: `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${stateSelect}/municipios`,
                    method: 'GET',
                    success: function (response) {
                        dataListCitys.empty();
                        response.forEach(function (city) {
                            dataListCitys.append(`<option value="${city.nome}">${city.nome}</option>`);
                        });
                    },
                    error: function (error) {
                        console.error('Erro ao obter cidades:', error);
                    },
                    complete: function () {
                        loader.hide();
                    }
                });
            }
        </script>
    @endpush
@endsection
