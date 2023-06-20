<?php

namespace App\Http\Controllers;

use App\Traits\CrudOperations;
use App\Models\Session;

class SessionController extends Controller
{
    use CrudOperations;

    protected function getModelInstance()
    {
        // Return an instance of the model associated with this controller
        return new Session();
    }

    protected function getModelName()
    {
        // Return the name of the model associated with this controller
        return 'Session';
    }

    // The rest of your controller code...
}
