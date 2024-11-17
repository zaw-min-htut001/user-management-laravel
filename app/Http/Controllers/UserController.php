<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreFormRequest;
use App\Http\Requests\UserUpdateFormRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        if (!$user->hasPermission('user_read')) {
            abort(403, 'You do not have permission to view users.');
        }

        if ($request->ajax()) {
            $data = User::with('role');
            return Datatables::of($data)
                    ->editColumn('role' , function($each){
                        return $each->role->name;
                    })
                    ->editColumn('is_active' , function($each){
                        return $each->is_active === 1 ? 'Active' : 'Not Active';
                    })
                    ->addColumn('Actions', function ($each) {
                        $show_icon = '<a href="'. route('user.show' , $each->id ) .'" class="text-blue-600 bg-amber-100 p-1 rounded-lg me-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg></a>';
                        $edit_icon = '<a href="'. route('user.edit' , $each->id ) .'" class="text-amber-500 bg-amber-100 p-1 rounded-lg me-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg></a>';
                        $delete_icon= '<a id="deleteItem" data-id="'.$each->id.'" class="cursor-pointer text-red-700 bg-amber-100 p-1 rounded-lg me-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg></a>';

                        return '<div class="flex justify-center">'. "$show_icon" . "$edit_icon" . "$delete_icon" . '</div>';
                    })
                    ->filterColumn('role', function ($query, $keyword) {
                        $query->whereHas('role', function ($query) use ($keyword) {
                            $query->where('name', 'like', "%{$keyword}%");
                        });
                    })
                    ->rawColumns(['Actions' , 'role'])
                    ->make(true);
        }

        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        if (!$user->hasPermission('user_create')) {
            abort(403, 'You do not have permission to create users.');
        }

        $roles = Role::all('id' , 'name');

        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreFormRequest $request)
    {
        $user = auth()->user();

        if (!$user->hasPermission('user_create')) {
            abort(403, 'You do not have permission to create users.');
        }

        $validatedData = $request->validated();

        $validatedData['is_active'] = $request->is_active === 'on' ? 1 : 0;

        User::create($validatedData);

        return redirect()->route('user.index')->with('created', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();

        if (!$user->hasPermission('user_read')) {
            abort(403, 'You do not have permission to view users.');
        }

        $user = User::findOrFail($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();

        if (!$user->hasPermission('user_update')) {
            abort(403, 'You do not have permission to edit users.');
        }

        $roles = Role::all('id' , 'name');

        $user = User::findOrFail($id);

        return view('user.edit', compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateFormRequest $request, string $id)
    {
        $user = auth()->user();

        if (!$user->hasPermission('user_update')) {
            abort(403, 'You do not have permission to edit users.');
        }

        $validatedData = $request->validated();

        $validatedData['is_active'] = $request->is_active === 'on' ? 1 : 0;

        $user = User::findOrFail($id);

        $user->update($validatedData);

        return redirect()->route('user.index')->with('updated', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();

        if (!$user->hasPermission('user_update')) {
            abort(403, 'You do not have permission to delete users.');
        }

        $deleted = User::findOrFail($id)->delete();

        if($deleted){
            $response['success'] = 1;
        }
        return response()->json($response);
    }
}
