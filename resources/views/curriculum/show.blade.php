@extends('layouts.app', [
    'title' => 'Currículo',
    'btnText' => 'Cadastrar currículo',
    'btnRoute' => 'curriculum.create',
    'breadCrumb' => [
        ['text' => 'Currículos', 'route' => 'curriculum.index'],
        ['text' => 'Detalhes']
    ]
])

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $curriculum->user->name }}</h3>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $curriculum->user->email }}</p>
                    <p class="mb-0">{{ $curriculum->phone }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <ul class="d-flex flex-column gap-3 list-unstyled">
                <!-- Skills -->
                @php($skills = json_decode($curriculum->skills, true))
                @if($skills)
                    <li>
                        <div class="card">
                            <div class="card-header">
                                <h3>Skills</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach($skills as $skill)
                                        <li>{{ $skill['skill'] }} - {{ $skill['level'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @endif

                <!-- Experiences -->
                @php($experiences = json_decode($curriculum->experience, true))
                @if($experiences)
                    <li>
                        <div class="card">
                            <div class="card-header">
                                <h3>Experiences</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach($experiences as $experience)
                                        <li class="mb-3">
                                            <h4>{{ $experience['company'] }}</h4>
                                            <p class="mb-0">{{ $experience['position'] }}</p>
                                            <p class="mb-0">{{ $experience['start_date'] }}
                                                - {{ $experience['end_date'] }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @endif

                <!-- Education -->
                @php($educations = json_decode($curriculum->education, true))
                @if($educations)
                    <li>
                        <div class="card">
                            <div class="card-header">
                                <h3>Education</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach($educations as $education)
                                        <li class="mb-3">
                                            <h4>{{ $education['course'] }}</h4>
                                            <p class="mb-0">{{ $education['institution'] }}</p>
                                            <p class="mb-0">{{ $education['status'] }}</p>
                                            <p class="mb-0">{{ $education['start_date'] }}
                                                - {{ $education['end_date'] }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @endif

                <!-- Certifications -->
                @php($certifications = json_decode($curriculum->certifications, true))
                @if($certifications)
                    <li>
                        <div class="card">
                            <div class="card-header">
                                <h3>Certifications</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach($certifications as $certification)
                                        <li class="mb-3">
                                            <h4>{{ $certification['certification'] }}</h4>
                                            <p class="mb-0">{{ $certification['institution'] }}</p>
                                            <p class="mb-0">{{ $certification['date'] }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @endif

                <!-- Languages -->
                @php($languages = json_decode($curriculum->languages, true))
                @if($languages)
                    <li>
                        <div class="card">
                            <div class="card-header">
                                <h3>Languages</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach($languages as $language)
                                        <li class="mb-3">
                                            <h4>{{ $language['language'] }}</h4>
                                            <p class="mb-0">{{ $language['level'] }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @endif

                <!-- Hobbys -->
                @php($hobbys = json_decode($curriculum->hobbys, true))
                @if($hobbys)
                    <li>
                        <div class="card">
                            <div class="card-header">
                                <h3>Hobbys</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach($hobbys as $hobby)
                                        <li>{{ $hobby }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

    </div>
@endsection
