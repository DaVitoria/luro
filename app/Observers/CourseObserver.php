<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Facades\Log;

class CourseObserver
{
    // Evento disparado após a criação de um curso
    public function created(Course $course)
    {
        Log::info('Curso criado:', [
            'id' => $course->id,
            'name' => $course->name,
            'created_at' => $course->created_at,
        ]);
    }

    // Evento disparado após a atualização de um curso
    public function updated(Course $course)
    {
        Log::info('Curso atualizado:', [
            'id' => $course->id,
            'updated_fields' => $course->getChanges(),
            'updated_at' => $course->updated_at,
        ]);
    }

    // Evento disparado após a exclusão de um curso
    public function deleted(Course $course)
    {
        Log::warning('Curso excluído:', [
            'id' => $course->id,
            'name' => $course->name,
        ]);
    }
}
