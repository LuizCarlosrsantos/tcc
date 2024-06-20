<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Curriculum;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hobby;
use App\Models\Language;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $curriculums = auth()->user()->hasRole('user') ? Curriculum::where('user_id', auth()->user()->id)->get()     : Curriculum::all();

        return view('curriculum.index', compact('curriculums'));
    }

    public function show($id)
    {
        $curriculum = Curriculum::findOrFail($id);

        return view('curriculum.show', compact('curriculum'));
    }

    public function create($id = null)
    {
        if (!auth()->user()->can('curriculum.create')) {
            abort(403);
        }

        if (auth()->user()->curriculum) {
            return redirect()->back()->withErrors(['message' => 'Usuário já possui um currículo cadastrado!']);
        }

        if (auth()->user()->hasRole('user')) {
            $users = collect();
            $users->push(auth()->user());
        } else {
            $users = User::all();
        }

        return view('curriculum.create', compact('users', 'id'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('curriculum.create')) {
            abort(403);
        }

        $data = $request->validate([
            'user' => 'required|exists:users,id',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'skill' => 'array',
            'skill.*' => 'string|nullable',
            'level' => 'array',
            'level.*' => 'string|nullable',
            'company' => 'array',
            'company.*' => 'string|nullable',
            'position' => 'array',
            'position.*' => 'string|nullable',
            'start_date' => 'array',
            'start_date.*' => 'date|nullable',
            'end_date' => 'array',
            'end_date.*' => 'date|nullable',
            'course' => 'array',
            'course.*' => 'string|nullable',
            'institution' => 'array',
            'institution.*' => 'string|nullable',
            'status' => 'array',
            'status.*' => 'integer|nullable',
            'certification' => 'array',
            'certification.*' => 'string|nullable',
            'date' => 'array',
            'date.*' => 'date|nullable',
            'language' => 'array',
            'language.*' => 'string|nullable',
            'hobby' => 'array',
            'hobby.*' => 'string|nullable',
        ]);

        $user = User::findOrFail($data['user']);

        if ($user->curriculum) {
            return redirect()->back()->with('error', 'Usuário já possui um currículo cadastrado!');
        }

        $curriculum = Curriculum::create([
            'user_id' => $data['user'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
        ]);

        if (!empty($data['skill'])) {
            foreach ($data['skill'] as $index => $skill) {
                if ($skill) {
                    Skill::create([
                        'curriculum_id' => $curriculum->id,
                        'name' => $skill,
                        'level' => $data['level'][$index] ?? null,
                    ]);
                }
            }
        }

        if (!empty($data['company'])) {
            foreach ($data['company'] as $index => $company) {
                if ($company) {
                    Experience::create([
                        'curriculum_id' => $curriculum->id,
                        'company' => $company,
                        'position' => $data['position'][$index] ?? null,
                        'start_date' => $data['start_date'][$index] ?? null,
                        'end_date' => $data['end_date'][$index] ?? null,
                    ]);
                }
            }
        }

        if (!empty($data['course'])) {
            foreach ($data['course'] as $index => $course) {
                if ($course) {
                    Education::create([
                        'curriculum_id' => $curriculum->id,
                        'course' => $course,
                        'institution' => $data['institution'][$index] ?? null,
                        'status' => $data['status'][$index] ?? null,
                        'start_date' => $data['start_date'][$index] ?? null,
                        'end_date' => $data['end_date'][$index] ?? null,
                    ]);
                }
            }
        }

        if (!empty($data['certification'])) {
            foreach ($data['certification'] as $index => $certification) {
                if ($certification) {
                    Certification::create([
                        'curriculum_id' => $curriculum->id,
                        'certification' => $certification,
                        'institution' => $data['institution'][$index] ?? null,
                        'date' => $data['date'][$index] ?? null,
                    ]);
                }
            }
        }

        if (!empty($data['language'])) {
            foreach ($data['language'] as $index => $language) {
                if ($language) {
                    Language::create([
                        'curriculum_id' => $curriculum->id,
                        'language' => $language,
                        'level' => $data['level'][$index] ?? null,
                    ]);
                }
            }
        }

        if (!empty($data['hobby'])) {
            foreach ($data['hobby'] as $index => $hobby) {
                if ($hobby) {
                    Hobby::create([
                        'curriculum_id' => $curriculum->id,
                        'hobby' => $hobby,
                    ]);
                }
            }
        }

        return redirect()->route('curriculum.index')->with('success', 'Currículo criado com sucesso!');
    }

    public function edit($id)
    {
        $curriculum = Curriculum::findOrFail($id);

        if (!auth()->user()->can('curriculum.edit', $curriculum)) {
            abort(403);
        }

        return view('curriculum.edit', compact('curriculum'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'skill' => 'array',
            'skill_id' => 'array',
            'skill.*' => 'string|nullable',
            'level' => 'array',
            'level.*' => 'string|nullable',
            'company' => 'array',
            'experience_id' => 'array',
            'company.*' => 'string|nullable',
            'position' => 'array',
            'position.*' => 'string|nullable',
            'start_date' => 'array',
            'start_date.*' => 'date|nullable',
            'end_date' => 'array',
            'end_date.*' => 'date|nullable',
            'course' => 'array',
            'education_id' => 'array',
            'course.*' => 'string|nullable',
            'institution' => 'array',
            'institution.*' => 'string|nullable',
            'status' => 'array',
            'status.*' => 'integer|nullable',
            'certification' => 'array',
            'certification_id' => 'array',
            'certification.*' => 'string|nullable',
            'date' => 'array',
            'date.*' => 'date|nullable',
            'language' => 'array',
            'language_id' => 'array',
            'language.*' => 'string|nullable',
            'hobby' => 'array',
            'hobby_id' => 'array',
            'hobby.*' => 'string|nullable',
        ]);

        $curriculum = Curriculum::findOrFail($id);

        if (!auth()->user()->can('curriculum.edit', $curriculum)) {
            abort(403);
        }

        $curriculum->update($data);

        if (!empty($data['skill'])) {
            foreach ($data['skill'] as $index => $skill) {
                if ($skill) {
                    Skill::updateOrCreate([
                        'id' => $data['skill_id'][$index],
                        'curriculum_id' => $id,
                    ], [
                        'name' => $skill,
                        'level' => $data['level'][$index] ?? null,
                    ]);
                }
            }

            $curriculum->skills()->whereNotIn('id', $data['skill_id'])->delete();
        } else {
            $curriculum->skills()->delete();
        }

        if (!empty($data['company'])) {
            foreach ($data['company'] as $index => $company) {
                if ($company) {
                    Experience::updateOrCreate([
                        'id' => $data['experience_id'][$index],
                        'curriculum_id' => $id,
                    ], [
                        'company' => $company,
                        'position' => $data['position'][$index] ?? null,
                        'start_date' => $data['start_date'][$index] ?? null,
                        'end_date' => $data['end_date'][$index] ?? null,
                    ]);
                }
            }

            $curriculum->experiences()->whereNotIn('id', $data['experience_id'])->delete();
        } else {
            $curriculum->experiences()->delete();
        }

        if (!empty($data['course'])) {
            foreach ($data['course'] as $index => $course) {
                if ($course) {
                    Education::updateOrCreate([
                        'id' => $data['education_id'][$index],
                        'curriculum_id' => $id,
                    ], [
                        'course' => $course,
                        'institution' => $data['institution'][$index] ?? null,
                        'status' => $data['status'][$index] ?? null,
                        'start_date' => $data['start_date'][$index] ?? null,
                        'end_date' => $data['end_date'][$index] ?? null,
                    ]);
                }
            }

            $curriculum->educations()->whereNotIn('id', $data['education_id'])->delete();
        } else {
            $curriculum->educations()->delete();
        }

        if (!empty($data['certification'])) {
            foreach ($data['certification'] as $index => $certification) {
                if ($certification) {
                    Certification::updateOrCreate([
                        'curriculum_id' => $id,
                        'id' => $data['certification_id'][$index],
                    ], [
                        'certification' => $certification,
                        'institution' => $data['institution'][$index] ?? null,
                        'date' => $data['date'][$index] ?? null,
                    ]);
                }
            }

            $curriculum->certifications()->whereNotIn('id', $data['certification_id'])->delete();
        } else {
            $curriculum->certifications()->delete();
        }

        if (!empty($data['language'])) {
            foreach ($data['language'] as $index => $language) {
                if ($language) {
                    Language::updateOrCreate([
                        'curriculum_id' => $id,
                        'id' => $data['language_id'][$index],
                    ], [
                        'language' => $language,
                        'level' => $data['level'][$index] ?? null,
                    ]);
                }
            }

            $curriculum->languages()->whereNotIn('id', $data['language_id'])->delete();
        } else {
            $curriculum->languages()->delete();
        }

        if (!empty($data['hobby'])) {
            foreach ($data['hobby'] as $index => $hobby) {
                if ($hobby) {
                    Hobby::updateOrCreate([
                        'curriculum_id' => $id,
                        'id' => $data['hobby_id'][$index],
                    ], [
                        'hobby' => $hobby,
                    ]);
                }
            }

            $curriculum->hobbies()->whereNotIn('id', $data['hobby_id'])->delete();
        } else {
            $curriculum->hobbies()->delete();
        }

        return redirect()->back()->with('success', 'Currículo atualizado com sucesso!');
    }
}
