<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-xl font-bold mb-5">Users</h1>
                        </div>
                        <div>
                            <a href="{{ route('user.create') }}">
                                <button class="btn btn-neutral">
                                    Add New User
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="max-w-6xl p-4 mt-5 bg-base-300 rounded-md shadow-md mx-5">
                        <table id="example" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>User name</th>
                                    <th>Role</th>
                                    <th>Is Active</th>
                                    <th>Actions</th>
                                    <th>created_at</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>User name</th>
                                    <th>Role</th>
                                    <th>Is Active</th>
                                    <th>Actions</th>
                                    <th>created_at</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    $(function(){
        var table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            fixedHeader: true,
            mark: true,
            columnDefs: [
                { "orderable": false, "targets": [4, 5, 6] },
                {
                    target: 7,
                    visible: false
                }
            ],
            order: [[7, 'asec']],
            ajax: "{{ route('user.index') }}",
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'is_active',
                    name: 'is_active'
                },
                {
                    data: 'Actions',
                    name: 'Actions'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
            ]
        });
        // Check for session message
        @if (session('created'))
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('created') }}"
            });
        @endif

        @if (session('updated'))
        const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('updated') }}"
            });
        @endif

        // Delete record
        $('#example').on('click', '#deleteItem', function() {
            var user = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: `user/${user}`,
                        dataType: 'json',
                        success: function(res) {
                            if (res.success === 1) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "User has been deleted.",
                                    icon: "success"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        table.ajax.reload();
                                    }
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>
