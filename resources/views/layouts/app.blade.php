<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- dataTable Style --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.bootstrap5.css">

    {{-- dataTable Script --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="navbar bg-base-100 sticky top-0 z-10">
            <div class="flex-1">
                <a href="/dashboard" class="btn btn-ghost text-xl">User Management system</a>
            </div>
            <div class="flex-none gap-2">
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img alt="{{ Auth::user()->name }}" class='w-10 h-10 rounded-full' src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" />
                        </div>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li>
                            <a href="{{ route('profile.edit')}}" class="justify-between">
                                Profile
                            </a>
                        </li>
                        <li><form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit">Logout</button>
                        </form></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <main>
            <div class="flex">
                <div class="border-slate-200 border-r-2 shadow-lg" x-data="{ currentRoute: window.location.pathname }">
                    <div class="h-screen">
                      {{-- <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label> --}}
                      <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                        <!-- Sidebar content here -->
                        <li><a :class="currentRoute === '/user' ? 'bg-base-300' : ''" href="{{ route('user.index')}}">User management</a></li>
                        <li><a :class="currentRoute === '/role' ? 'bg-base-300' : ''" href="{{ route('role.index')}}">Role management</a></li>
                      </ul>
                    </div>
                </div>
                <div class="w-full justify-center ">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<style>
    .invalid-feedback {
        color: crimson;
    }

    .is-invalid {
        border-color: crimson;
    }

    .is-valid {
        border-color: rgb(0, 75, 0);
    }
</style>
</html>
