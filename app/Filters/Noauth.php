<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn')) {

            if (session()->get('role') == "Admin") {
                return redirect()->to(base_url('dashboard'));
            } else if (session()->get('role') == "Agent") {
                return redirect()->to(base_url('agent-dashboard'));
            } else if (session()->get('role') == "Manager") {
                return redirect()->to(base_url('dashboard'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
