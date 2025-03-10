<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends BaseRepository
{
    public function __construct(protected Student $student)
    {
        $student = optional(auth()->user())->id ? $student->byUser() : $student;

        parent::__construct($student);
    }

    public function findByEmail($email)
    {
        return $this->model->where(['email' => $email])->first();
    }

    public function updateWithoutScope(int $id, array $data)
    {
        return $this->model->where(['id' => $id])->update($data);
    }
}
