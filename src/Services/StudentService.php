
<?php

namespace App\Services;

use App\Exceptions\StudentNotFoundException;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use InvalidArgumentException;

class StudentService
{
    private StudentRepositoryInterface $repository;

    public function __construct(
        StudentRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function addStudent(Student $student): void
    {
        if (trim($student->getName()) === '') {
            throw new InvalidArgumentException(
                'Student name cannot be empty.'
            );
        }

        if ($student->getAge() <= 0) {
            throw new InvalidArgumentException(
                'Student age must be positive.'
            );
        }

        $this->repository->add($student);
    }

    public function getAllStudents(): array
    {
        return $this->repository->getAll();
    }

    public function findStudent(int $id): Student
    {
        $student = $this->repository->findById($id);

        if ($student === null) {
            throw new StudentNotFoundException(
                "Student with ID {$id} was not found."
            );
        }

        return $student;
    }

    public function deleteStudent(int $id): void
    {
        if (!$this->repository->deleteById($id)) {
            throw new StudentNotFoundException(
                "Student with ID {$id} was not found."
            );
        }
    }
}
