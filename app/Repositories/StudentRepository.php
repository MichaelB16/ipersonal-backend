<?php

namespace App\Repositories;

use App\Contracts\Repositories\StudentRepositoryInterface;
use App\Models\Diet;
use App\Models\Student;
use App\Models\Training;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function __construct(protected Student $student, protected Training $training, protected Diet $diet)
    {
        if (get_user_id()) {
            $student = $student->byUser()->first() ?? $student;
        }

        parent::__construct($student);
    }

    public function getAll(string $search = '')
    {
        return $this->student
            ->with([
                'training',
                'diet',
                'evaluations_actual',
                'evaluations_months'
            ])
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(limit_pagination());
    }

    public function getSummary()
    {
        return [
            'total_students' => $this->student->count(),
            'total_trainings' => $this->training->count(),
            'total_diets' => $this->diet->count(),
            'total_price' => $this->student->sum('price')
        ];
    }

    public function getByEmail($email)
    {
        return $this->student->where(['email' => $email])->first();
    }

    public function updateWithoutScope(int $id, array $data)
    {
        return $this->student->where(['id' => $id])->update($data);
    }
}
