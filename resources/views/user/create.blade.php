<x-app-layout>
    <h1 class="text-3xl font-medium mt-3 mx-5">Add User</h1>

    <div class="flex items-center justify-center mb-5">
        <div class="p-4 mt-5 bg-base-300 rounded-md shadow-md mx-5 max-w-5xl w-full">
            <form id="create-form" action="{{ route('user.store')}}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-5">
                    <div class="">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="username">User Name</label>
                            <input id="username" name="username" type="text" placeholder="Type here username" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" placeholder="Type here email" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input id="phone" name="phone" type="number" placeholder="Type here phone" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="role_id">Roles</label>
                            <select name="role_id" id="role_id" class="input input-bordered w-full max-w-xl block">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="input input-bordered w-full max-w-xl block">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input id="address" name="address" type="text" placeholder="Type here address" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-9">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" placeholder="Type here password" class="input input-bordered w-full max-w-xl block" />
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="me-3">Is Active</label>
                            <input id="is_active" name='is_active' type="checkbox" class="checkbox" />
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
{!! JsValidator::formRequest('App\Http\Requests\UserStoreFormRequest', '#create-form'); !!}
