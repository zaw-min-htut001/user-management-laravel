<x-app-layout>
    <h1 class="text-3xl font-medium mt-3 mx-5">Edit User</h1>

    <div class="flex items-center justify-center mb-5">
        <div class="p-4 mt-5 bg-base-300 rounded-md shadow-md mx-5 max-w-5xl w-full">
            <form id="edit-form" action="{{ route('user.update', $user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-5">
                    <div class="">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input value="{{ $user->name }}" id="name" name="name" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="username">User Name</label>
                            <input value="{{ $user->username }}" id="username" name="username" type="text" placeholder="Type here username" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input value="{{ $user->email }}" id="email" name="email" type="email" placeholder="Type here email" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input value="{{ $user->phone }}" id="phone" name="phone" type="number" placeholder="Type here phone" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="role_id">Roles</label>
                            <select name="role_id" id="role_id" class="input input-bordered w-full max-w-xl block">
                                @foreach ($roles as $role)
                                    <option @if ($user->role_id === $role->id ) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="input input-bordered w-full max-w-xl block">
                                    <option @if ($user->gender === 'male') selected @endif value="male">Male</option>
                                    <option @if ($user->gender === 'female') selected @endif value="female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input value="{{ $user->address }}" id="address" name="address" type="text" placeholder="Type here address" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-9">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" placeholder="Type here password" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="me-3">Is Active</label>
                            <input {{ $user->is_active === 1 ? 'checked' : '' }}  id="is_active" name='is_active' type="checkbox" class="checkbox" />
                        </div>
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
{!! JsValidator::formRequest('App\Http\Requests\UserUpdateFormRequest', '#edit-form'); !!}
