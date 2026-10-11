
<?php

namespace App\Repositories;

use App\Exceptions\StudentNotFoundException;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use InvalidArgumentException;

class StudentRepository implements StudentRepositoryInterface
{
    private array $students = [];

    public function add(Student $student): void
    {
        $id = $student->getId();

        if (isset($this->students[$id])) {
            throw new InvalidArgumentException(
                "A student with ID {$id} already exists."
            );
        }

        $this->students[$id] = $student;
    }

    public function getAll(): array
    {
        return array_values($this->students);
    }

    public function findById(int $id): ?Student
    {
        if (!isset($this->students[$id])) {
            return null;
        }

        return $this->students[$id];
    }

    public function deleteById(int $id): bool
    {
        if (!isset($this->students[$id])) {
            return false;
        }

        unset($this->students[$id]);

        return true;
    }
}
