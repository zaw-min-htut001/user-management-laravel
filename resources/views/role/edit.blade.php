<x-app-layout>
    <h1 class="text-3xl font-medium mt-3 mx-5">Edit Role</h1>

    <div class="flex items-center justify-center mb-5">
        <div class="p-4 mt-5 bg-base-300 rounded-md shadow-md mx-5 max-w-xl w-full">
            <form id="edit-form" action="{{ route('role.update', $role->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="">
                    <div class="mb-3">
                        <label for="name">Role Name</label>
                        <input value="{{ $role->name }}" id="name" name="name" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl block" />
                    </div>

                    <div class="overflow-x-auto mb-5">
                        <table class="table">
                          <!-- head -->
                          <thead>
                            <tr>
                              <th>Feature Name</th>
                              <th>Create</th>
                              <th>View</th>
                              <th>Edit</th>
                              <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- row 1 -->
                            @foreach ($features as $feature)
                            <tr>
                                <th>{{ $feature->name}}</th>

                                @foreach ($feature->permissions as $permission)
                                <td>
                                    <label>
                                        <input
                                            {{-- Check if the role has this permission --}}
                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}
                                            name="permission_id[]"
                                            value="{{$permission->id}}"
                                            type="checkbox" class="checkbox" />
                                    </label>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
            </div>

                <div class="mb-3 flex justify-end">
                    <button type="submit" class="btn btn-neutral btn-md w-32">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<!-- Laravel Javascript Validation -->
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\RoleUpdateFormRequest', '#edit-form'); !!}
