
<?php

namespace App\Interfaces;

use App\Models\Student;

interface StudentRepositoryInterface
{
    public function add(Student $student): void;

    public function getAll(): array;

    public function findById(int $id): ?Student;

    public function deleteById(int $id): bool;
}
