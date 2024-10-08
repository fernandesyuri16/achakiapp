<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * This trait is for authorizing requests.
     * It provides methods to determine if a user is authorized to perform a given action.
     */
    use AuthorizesRequests;

    /**
     * This trait is for validating requests.
     * It provides methods to validate incoming HTTP requests with a variety of powerful validation rules.
     */
    use ValidatesRequests;
}
