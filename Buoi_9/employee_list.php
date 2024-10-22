<?php
require_once 'libs/employee.php';
require_once 'libs/departments.php';
require_once 'libs/employeeroles.php';
require_once 'index.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách nhân viên</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .add-button {
            margin: 15px 0;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .load-button {
            margin: 15px 0;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: #007bff 1px solid;;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
    <script>
        $(document).ready(function() {
            function fetchEmployees() {
                $.ajax({
                    url: 'upload_employees.php', // Update to the correct path for fetching employee data
                    method: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#employeeTable tbody').empty(); // Clear existing table data
                        $('#loading').show(); // Show loading message
                    },
                    success: function(data) {
                        $('#loading').hide(); // Hide loading message
                        if (data.error) {
                            $('.error').text(data.error);
                            return;
                        }

                        if (data.length > 0) {
                            $.each(data, function(index, item) {
                                $('#employeeTable tbody').append(
                                    `<tr>
                                        <td>${item.first_name}</td>
                                        <td>${item.last_name}</td>
                                        <td>${item.role_name}</td>
                                        <td>${item.department_name}</td>
                                        <td>
                                            <form method="post" action="employee_delete.php" style="display:inline;">
                                                <input onclick="window.location='employee_edit.php?id=${item.employee_id}';" type="button" value="Sửa"/>
                                                <input type="hidden" name="id" value="${item.employee_id}"/>
                                                <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                                            </form>
                                        </td>
                                    </tr>`
                                );
                            });
                        } else {
                            $('#employeeTable tbody').append('<tr><td colspan="5" style="text-align:center;">Không có nhân viên nào.</td></tr>');
                        }
                    },
                    error: function() {
                        $('#loading').hide();
                        $('.error').text('Lỗi khi tải danh sách nhân viên.');
                    }
                });
            }

            $('#loadEmployees').on('click', function() {
                fetchEmployees();
            });
        });
    </script>
</head>
<body>
    <h1>Danh sách nhân viên</h1>
    <a href="employee_add.php" class="add-button">Thêm nhân viên</a>
    <button id="loadEmployees" class="load-button">Tải danh sách nhân viên</button>
    <div class="error"></div>
    <div id="loading" style="display:none;">Đang tải danh sách nhân viên...</div>
    <br>
    <table id="employeeTable" width="100%" border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Role</th>
                <th>Departments</th>
                <th>Chọn thao tác</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</body>
</html>
