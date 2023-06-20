<?php

namespace App\Http\Controllers;

use App\Traits\CrudOperations;
use App\Models\Course;

class CourseController extends Controller
{
    use CrudOperations;

    protected function getModelInstance()
    {
        // Return an instance of the model associated with this controller
        return new Course();
    }

    protected function getModelName()
    {
        // Return the name of the model associated with this controller
        return 'Course';
    }

    // The rest of your controller code...
}
