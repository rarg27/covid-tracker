<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * Show the application's login form.
     *
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
}