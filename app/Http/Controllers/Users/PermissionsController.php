<?php

namespace App\Http\Controllers\Users;

use App\Entities\Users\Permission;
use App\Entities\Users\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Permissions\CreateRequest;
use App\Http\Requests\Users\Permissions\DeleteRequest;
use App\Http\Requests\Users\Permissions\UpdateRequest;
use Illuminate\Http\Request;

class PermissionsController extends Controller {

	public function index(Request $req)
	{
		$permission = null;
		$roles = [];
		if ($req->has('act') && in_array($req->get('act'), ['show','edit','del'])) {
			$permission = $this->requireById($req->get('id'));
		}

		if ($req->has('act') && $req->get('act') == 'add') {
			$roles = $this->getRolesList();
		}

		$permissions = Permission::whereType(1)->withCount('roles')->get();
		return view('users.permissions',compact('permissions','permission','roles'));
	}

	public function store(CreateRequest $req)
	{
		$permissionData = $req->except('_token');
		$permissionData['type'] = 1; // Permission Type

		$permission = Permission::create($permissionData);

		if (isset($permissionData['role']))
			$permission->roles()->attach($permissionData['role']);

		flash()->success(trans('permission.created'));
		return redirect()->route('permissions.index');
	}

	public function update(UpdateRequest $req, $permissionId)
	{
		$permission = $this->requireById($permissionId);
		$permission->update($req->except(['_method','_token']));
		flash()->success(trans('permission.updated'));
		return redirect()->back();
	}

	public function delete($permissionId)
	{
	    $permission = $this->requireById($permissionId);
		return view('permissions.delete', compact('permission'));
	}

	public function destroy(DeleteRequest $req, $permissionId)
	{
		if ($permissionId == $req->get('permission_id'))
		{
			$this->requireById($permissionId)->delete();
	        flash()->success(trans('permission.deleted'));
		}
		else
			flash()->error(trans('permission.undeleted'));

		return redirect()->route('permissions.index');
	}

	private function requireById($permissionId)
	{
		return Permission::findOrFail($permissionId);
	}

    public function getRolesList()
    {
        return Role::where('type', 0)->lists('label','id')->all();
    }

}
