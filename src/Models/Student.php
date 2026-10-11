
<?php

namespace App\Models;

class Student
{
    private int $id;
    private string $name;
    private int $age;
    private string $course;

    public function __construct(
        int $id,
        string $name,
        int $age,
        string $course
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->course = $course;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getCourse(): string
    {
        return $this->course;
    }

    public function display(): void
    {
        echo "ID: {$this->id}\n";
        echo "Name: {$this->name}\n";
        echo "Age: {$this->age}\n";
        echo "Course: {$this->course}\n";
    }
}
