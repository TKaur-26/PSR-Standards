
<?php

require __DIR__ . '/vendor/autoload.php';

use App\Models\Student;
use App\Repositories\StudentRepository;
use App\Services\StudentService;
use App\Exceptions\StudentNotFoundException;
use InvalidArgumentException;

$repository = new StudentRepository();
$service = new StudentService($repository);

while (true) {
    echo "\n--- Student Management System ---\n";
    echo "1. Add Student\n";
    echo "2. View All Students\n";
    echo "3. Find Student\n";
    echo "4. Delete Student\n";
    echo "5. Exit\n";
    echo "Enter choice: ";

    $choice = trim(fgets(STDIN));

    try {
        switch ($choice) {
            case '1':
                echo "Enter ID: ";
                $id = filter_var(
                    trim(fgets(STDIN)),
                    FILTER_VALIDATE_INT
                );

                if ($id === false || $id <= 0) {
                    throw new InvalidArgumentException(
                        'ID must be a positive integer.'
                    );
                }

                echo "Enter name: ";
                $name = trim(fgets(STDIN));

                echo "Enter age: ";
                $age = filter_var(
                    trim(fgets(STDIN)),
                    FILTER_VALIDATE_INT
                );

                if ($age === false) {
                    throw new InvalidArgumentException(
                        'Age must be an integer.'
                    );
                }

                echo "Enter course: ";
                $course = trim(fgets(STDIN));

                $student = new Student(
                    $id,
                    $name,
                    $age,
                    $course
                );

                $service->addStudent($student);
                echo "Student added successfully!\n";
                break;

            case '2':
                $students = $service->getAllStudents();

                if (empty($students)) {
                    echo "No students found.\n";
                    break;
                }

                foreach ($students as $student) {
                    $student->display();
                    echo "--------------------\n";
                }
                break;

            case '3':
                echo "Enter student ID: ";
                $id = filter_var(
                    trim(fgets(STDIN)),
                    FILTER_VALIDATE_INT
                );

                if ($id === false) {
                    throw new InvalidArgumentException(
                        'ID must be an integer.'
                    );
                }

                $student = $service->findStudent($id);
                $student->display();
                break;

            case '4':
                echo "Enter student ID: ";
                $id = filter_var(
                    trim(fgets(STDIN)),
                    FILTER_VALIDATE_INT
                );

                if ($id === false) {
                    throw new InvalidArgumentException(
                        'ID must be an integer.'
                    );
                }

                $service->deleteStudent($id);
                echo "Student deleted successfully!\n";
                break;

            case '5':
                echo "Goodbye!\n";
                exit;

            default:
                echo "Invalid choice. Try again.\n";
        }
    } catch (StudentNotFoundException | InvalidArgumentException $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
