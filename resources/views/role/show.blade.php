<x-app-layout>
    <h1 class="text-3xl font-medium mt-3 mx-5">User details</h1>

    <div class="flex items-center justify-center mb-5">
        <div class="p-4 mt-5 bg-base-300 rounded-md shadow-md mx-5 max-w-5xl w-full">
            <div class="flex justify-center items-center">
                <div class="w-[100px] rounded-full">
                    <img alt="{{ $user->name }}" class='w-[200px] h-[200px] rounded-full' src="https://ui-avatars.com/api/name={{ $user->name }}?background=0D8ABC&color=fff/" />
                </div>
            </div>
                <div class="grid grid-cols-2 gap-5">
                    <div class="">
                        <div class="mb-3 flex text-lg">
                            Name : <h1 class="ms-3">{{ $user->name }}</h1>
                        </div>

                        <div class="mb-3 flex text-lg">
                            User Name : <h1 class="ms-3">{{ $user->username }}</h1>
                        </div>

                        <div class="mb-3 flex text-lg">
                            Email : <h1 class="ms-3">{{ $user->email }}</h1>
                        </div>

                        <div class="mb-3 flex text-lg">
                            Phone : <h1 class="ms-3">{{ $user->phone }}</h1>
                        </div>

                        <div class="mb-3 flex text-lg">
                            Role : <h1 class="ms-3">{{ $user->role->name }}</h1>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 flex text-lg">
                            Gender : <h1 class="ms-3"> {{ ucfirst($user->gender) }}</h1>
                        </div>

                        <div class="mb-3 flex text-lg">
                            Address : <h1 class="ms-3">{{ $user->address }}</h1>
                        </div>

                        <div class="mb-3 flex text-lg">
                            Is Active : <h1 class="ms-3">{{ $user->is_active ? 'Active' : 'Not Active' }}</h1>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>

