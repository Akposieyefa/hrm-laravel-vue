<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    private OrganizationRepositoryInterface $organizationRepositoryInterface ;

    public function __construct(OrganizationRepositoryInterface  $organizationRepositoryInterface )
    {
        $this->organizationRepositoryInterface = $organizationRepositoryInterface;
    }

    public function index()
    {
        return  $this->organizationRepositoryInterface ->getAllOrganizations();
    }

    public function store(Request $request)
    {
        return $this->organizationRepositoryInterface ->createOrganization($request);
    }

    public function show(int $id)
    {
        return $this->organizationRepositoryInterface ->getSingleOrganization($id);
    }

    public function update(Request $request, int $id)
    {
        return $this->organizationRepositoryInterface ->updateOrganization($request, $id);
    }

    public function destroy(int $id)
    {
        return $this->organizationRepositoryInterface ->deleteOrganization($id);
    }
}
