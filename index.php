<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center mt-3">CRUD PHP with Ajax Jquery</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4>All User From Database</h4>
            </div>
            <div class="col-lg-6">
                <button class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#addUser">
                    <i class="fas fa-user-plus fa-lg"></i> &nbsp; &nbsp;
                    Add New User
                </button>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive mt-5" id="showUser">

            </div>
        </div>
    </div>

    <!-- Add New Modal -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="form-data" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">First Name</label>
                            <input type="text" name="first_name" class=" form-control" id="exampleInputEmail1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Last Name</label>
                            <input type="text" name="last_name" class=" form-control" id="exampleInputEmail1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class=" form-control" id="exampleInputEmail1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" id="exampleInputEmail1" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="insert" id="insert">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-data" method="POST">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">First Name</label>
                            <input type="text" name="first_name" class=" form-control" id="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Last Name</label>
                            <input type="text" name="last_name" class=" form-control" id="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class=" form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update" id="update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            // $("table").DataTable();

            showAllUsers();

            function showAllUsers() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(response) {
                        $('#showUser').html(response);
                        $('#table').DataTable({
                            order: [0, 'DESC']
                        });
                    }
                });
            }

            // Insert Ajax Request
            $('#insert').click(function(e) {
                if ($('#form-data')[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=insert",
                        success: function(response) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Insert User Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#addUser').hide();
                            $('.modal-backdrop').hide();
                            $('#form-data')[0].reset();
                            showAllUsers();
                        }
                    });
                }
            })

            // Edit User
            $("body").on('click', '.editBtn', function(e) {
                edit_id = $(this).attr('id');
                console.log(edit_id);
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        id: edit_id
                    },
                    success: function(response) {
                        data = JSON.parse(response);
                        console.log(data['id']);
                        $('#id').val(data['id']);
                        $('#first_name').val(data['first_name']);
                        $('#last_name').val(data['last_name']);
                        $('#email').val(data['email']);
                        $('#phone').val(data['phone']);
                    }
                });
            });

            // Update User
            $('#update').click(function(e) {
                if ($('#edit-form-data')[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize() + "&action=update",
                        success: function(response) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Update User Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#editUser').hide();
                            $('.modal-backdrop').hide();
                            $('#edit-form-data')[0].reset();
                            showAllUsers();
                        }
                    });
                }
            })

            // Delete User
            $('body').on('click', '.deleteBtn', function(e) {
                e.preventDefault();
                const tr = $(this).closest('tr');
                delete_id = $(this).attr('id')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "action.php",
                            type: 'POST',
                            data: {
                                delete_id: delete_id
                            },
                            success: function(response) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Delete User Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                showAllUsers();
                            }
                        });
                    }
                })
            })
        })
    </script>
</body>

</html>