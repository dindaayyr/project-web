<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Role-based access filter.
 * Usage in routes: ['filter' => 'role:agent,superadmin']
 */
class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Must be logged in first
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // If no specific roles required, just check login
        if (empty($arguments)) {
            return;
        }

        $userRole = session()->get('user_role');

        // Check if user's role is in the allowed list
        if (!in_array($userRole, $arguments)) {
            // Redirect based on their actual role
            $redirectMap = [
                'jamaah'     => '/user/dashboard',
                'agent'      => '/agent/dashboard',
                'finance'    => '/finance/dashboard',
                'superadmin' => '/superadmin/dashboard',
            ];

            $target = $redirectMap[$userRole] ?? '/';
            return redirect()->to($target)->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No after filter needed
    }
}
