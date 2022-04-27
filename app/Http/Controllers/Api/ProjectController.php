<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProjectRepositoryInterface;

class ProjectController extends Controller
{
    private ProjectRepositoryInterface $projectRepositoryInterface;

    public function __construct(ProjectRepositoryInterface $projectRepositoryInterface)
    {
        $this->projectRepositoryInterface = $projectRepositoryInterface;
    }

    public function index()
    {
        return  $this->projectRepositoryInterface->getAllProjects();
    }

    public function store(Request $request)
    {
        return $this->projectRepositoryInterface->createProject($request);
    }

    public function show(int $id)
    {
        return $this->projectRepositoryInterface->getSingleProject($id);
    }

    public function update(Request $request, int $id)
    {
        return $this->projectRepositoryInterface->updateProject($request, $id);
    }

    public function destroy(int $id)
    {
        return $this->projectRepositoryInterface->deleteProject($id);
    }
}
