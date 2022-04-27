<?php

namespace App\Repositories\Contracts;

interface ProjectRepositoryInterface
{
    public function createProject($request);

    public function getAllProjects();

    public function getSingleProject($id);

    public function updateProject($request, $id);

    public function deleteProject($id);
}

