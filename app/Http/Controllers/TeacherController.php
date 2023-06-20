<?php

namespace App\Http\Controllers;

use App\Traits\CrudOperations;
use App\Models\Teacher;

class TeacherController extends Controller
{
    use CrudOperations;

    protected function getModelInstance()
    {
        // Return an instance of the model associated with this controller
        return new Teacher();
    }

    protected function getModelName()
    {
        // Return the name of the model associated with this controller
        return 'Teacher';
    }

    // The rest of your controller code...
}
