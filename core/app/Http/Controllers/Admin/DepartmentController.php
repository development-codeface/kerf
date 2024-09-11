<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Location;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $pageTitle = 'All Departments';
        $departments   = Department::searchable(['name'])->orderBy('name')->paginate(getPaginate());
        return view('admin.department.index', compact('pageTitle', 'departments'));
    }

    public function store(Request $request, $id = 0)
    {
        $imageValidation = $id ? 'nullable' : 'required';

        $request->validate([
            'name'       => 'required|max:40|unique:departments,id,'.$id,
            'details'    => 'required|max:255',
            'image'      => ["$imageValidation", new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($id) {
            $department           = Department::findOrFail($id);
            $notification       = 'Department updated successfully';
        } else {
            $department           = new Department();
            $notification       = 'Department added successfully';
        }

        if ($request->hasFile('image')) {
            try {
                $department->image = fileUploader($request->image, getFilePath('department'), getFileSize('department'), @$department->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload category image'];
                return back()->withNotify($notify);
            }
        }

        $department->name    = $request->name;
        $department->details = $request->details;
        $department->save();
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function location()
    {
        $pageTitle = 'All Locations';
        $locations   = Location::searchable(['name'])->orderBy('name')->paginate(getPaginate());
        return view('admin.location.index', compact('pageTitle', 'locations'));
    }

    public function locationStore(Request $request, $id = 0)
    {
        $request->validate([
            'name'       => 'required|unique:locations|max:40'
        ]);

        if ($id) {
            $location           = Location::findOrFail($id);
            $notification       = 'Location updated successfully';
        } else {
            $location           = new Location();
            $notification       = 'Location added successfully';
        }

        $location->name    = $request->name;
        $location->save();
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }
}
