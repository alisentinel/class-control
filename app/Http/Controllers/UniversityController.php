<?php

namespace App\Http\Controllers;

use App\Traits\CrudOperations;
use App\Models\University;

class UniversityController extends Controller
{
    use CrudOperations;

    protected function getModelInstance()
    {
        // Return an instance of the model associated with this controller
        return new University();
    }

    protected function getModelName()
    {
        // Return the name of the model associated with this controller
        return 'University';
    }

    // The rest of your controller code...
}
