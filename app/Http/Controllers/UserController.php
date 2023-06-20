<?php

namespace App\Http\Controllers;

use App\Traits\CrudOperations;
use App\Models\User;

class UserController extends Controller
{
    use CrudOperations;

    protected function getModelInstance()
    {
        // Return an instance of the model associated with this controller
        return new User();
    }

    protected function getModelName()
    {
        // Return the name of the model associated with this controller
        return 'User';
    }

    // The rest of your controller code...
}
