<?php

namespace App\Repositories\Contracts;

interface OrganizationRepositoryInterface
{
    public function createOrganization($request);

    public function getAllOrganizations();

    public function getSingleOrganization($id);

    public function updateOrganization($request, $id);

    public function deleteOrganization($id);
}
