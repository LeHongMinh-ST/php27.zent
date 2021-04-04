<?php
require_once 'connection.php';

$query = "select  * from categories";

$data = $conn->query($query);

$categories = [];

while ($row = $data->fetch_assoc()) {
    $categories[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap CRUD Data Table for Database with Modal Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="asset/style.css">
</head>
<body>
<div class="container">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-success btnAddCategory" id="#addNew"><i class="material-icons">&#xE147;</i><span>Thêm mới</span></a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i
                                    class="material-icons">&#xE15C;</i><span>Delete</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover" id="tableCategory">
                <thead>
                <tr>
                    <th width="20%">Tên danh mục</th>
                    <th>Ảnh</th>
                    <th>Danh mục cha</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody id="tbodtCategory">
                <?php foreach ($categories as $category) { ?>
                    <tr>
                        <td><?= $category['name'] ?></td>
                        <td><img src="<?= $category['thumbnail'] ?>" alt=""></td>
                        <td><?= $category['parent_id'] ?></td>
                        <td><?= $category['description'] ?></td>
                        <td><a href="#" class="view viewModal" data-id="<?= $category['id'] ?>" data-toggle="modal"><i
                                        class="material-icons" data-toggle="tooltip" title="View">&#xE8F4;</i></a>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                                                                                             data-toggle="tooltip"
                                                                                             title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                                                                                                 data-toggle="tooltip"
                                                                                                 title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="modalViewCategory" role="dialog">
    <div class="modal-dialog" style="max-width: 40%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Name: <span id="nameCategory"></span></h6>
                <h6>Danh mục cha: <span id="nameCategoryParent"></span></h6>
                <h6>Mô tả: <span id="descriptionCategory"></span></h6>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="modalAddCategory" role="dialog">
    <div class="modal-dialog" style="max-width: 40%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAddCategory">
                    <div class="form-group">
                        <label for="nameAddNew">Name</label>
                        <input type="text" class="form-control" id="nameAddNew" name="name" aria-describedby="emailHelp"
                               placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="descriptionAddNew">Description</label>
                        <textarea name="description" class="form-control" id="descriptionAddNew"
                                  placeholder="Enter description" cols="30" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveAddCategory">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    $(document).ready(function () {
        $('#tbodtCategory').on('click', 'viewModal',function (e) {
            e.preventDefault()
            let id = $(this).attr('data-id');

            $.ajax({
                url: '/php27.zent/codecamp04/process.php?id=' + id,
                type: 'get',
                success: (response) => {
                    response = JSON.parse(response);

                    if (response) {
                        $('#nameCategory').text(response.name);
                        $('#descriptionCategory').text(response.description);
                        if (response.parent_id == null) $('#nameCategoryParent').text('Không có danh mục cha')
                        else $('#nameCategoryParent').text(response.parent_id)
                        $('#modalViewCategory').modal('show');
                    }
                }
            })
        })

        $('.btnAddCategory').click((e) => {
            e.preventDefault();
            $('#modalAddCategory').modal('show');
        })

        $('.saveAddCategory').click((e) => {
            e.preventDefault();

            let data = $('#frmAddCategory').serialize();
            $.ajax({
                type: 'post',
                url: '/php27.zent/codecamp04/add_process.php',
                data: data,
                success: (response) => {
                    response = JSON.parse(response);

                    if (!response.error) {
                        toastr.success(response.message)

                        $('#tbodtCategory').empty()

                        $.each(response.data, (index, item) => {
                            $('#tbodtCategory').append('<tr><td>' + item.name + '</td>' +
                                '<td><img src="' + item.thumbnail + '" alt=""></td>' +
                                '<td>' + item.parent_id + '</td>' +
                                '<td>' + item.description + '</td>' +
                                '<td><a href="#" class="view viewModal" data-id="' + item.id + '" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="View">&#xE8F4;</i></a>' +
                                '<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>' +
                                '<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a></td></tr>'
                            )
                        })
                        $('#modalAddCategory').modal('hide');
                    } else {
                        toastr.error(response.message)
                    }

                }
            }, 'html')
        })
    })
</script>
</html>

