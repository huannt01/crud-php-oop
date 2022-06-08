<?php

require_once "db.php";

$db = new Database();

if (isset($_POST['action']) && $_POST['action'] == 'view') {
    $output = '';
    $data = $db->read();
    if ($db->totalRowCount() > 0) {
        // $id = $db->totalRowCount();

        $output .= '
            <table class="table table-hover table-striped" id="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
        ';
        $id = 1;
        foreach ($data as $row) {
            $output .= '
                <tr>
                    <th scope="row">' . $id++ . '</th>
                    <td>' . $row['first_name'] . '</td>
                    <td>' . $row['last_name'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['phone'] . '</td>
                    <td>
                        <a href="" id="' . $row['id'] . '" class="text-primary mx-2 editBtn" title="Edit" data-bs-toggle="modal" data-bs-target="#editUser">
                            <i class="fas fa-edit fa-lg"></i>
                        </a>
                        <a href="" id="' . $row['id'] . '" class="text-danger deleteBtn" title="Delete">
                            <i class="fas fa-trash-alt fa-lg"></i>
                        </a>
                    </td>
                </tr>
            ';
        }

        $output .= '</tbody> </table>';
        echo $output;
    } else {
        echo "<h3 class='text-center text-secondary mt-5'>:No any user present in the database!</h3>";
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'insert') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $db->insert($first_name, $last_name, $email, $phone);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $row = $db->getUserById($id);
    echo json_encode($row);
}

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $db->update($id, $first_name, $last_name, $email, $phone);
}

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $db->delete($id);
}
