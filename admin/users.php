<?php
// admin/users.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="admin-header">
        <h1>User Management</h1>
        <p>Manage registered users and their permissions</p>
    </div>

    <div class="admin-actions">
        <button class="btn btn-primary" onclick="addUser()">Add New User</button>
        <button class="btn btn-secondary">Export Users</button>
        <div class="search-box">
            <input type="text" placeholder="Search users..." class="search-input">
            <button class="btn btn-primary">Search</button>
        </div>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>john.doe@email.com</td>
                    <td><span class="role admin">Admin</span></td>
                    <td><span class="status active">Active</span></td>
                    <td>2024-01-15 14:30</td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editUser(1)">Edit</button>
                        <button class="btn-action delete" onclick="deleteUser(1)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Jane Smith</td>
                    <td>jane.smith@email.com</td>
                    <td><span class="role user">User</span></td>
                    <td><span class="status active">Active</span></td>
                    <td>2024-01-14 09:15</td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editUser(2)">Edit</button>
                        <button class="btn-action delete" onclick="deleteUser(2)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Mike Johnson</td>
                    <td>mike.j@email.com</td>
                    <td><span class="role user">User</span></td>
                    <td><span class="status inactive">Inactive</span></td>
                    <td>2024-01-10 16:45</td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editUser(3)">Edit</button>
                        <button class="btn-action delete" onclick="deleteUser(3)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Sarah Wilson</td>
                    <td>sarah.wilson@email.com</td>
                    <td><span class="role moderator">Moderator</span></td>
                    <td><span class="status active">Active</span></td>
                    <td>2024-01-15 11:20</td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editUser(4)">Edit</button>
                        <button class="btn-action delete" onclick="deleteUser(4)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>David Brown</td>
                    <td>david.b@email.com</td>
                    <td><span class="role user">User</span></td>
                    <td><span class="status active">Active</span></td>
                    <td>2024-01-13 13:10</td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editUser(5)">Edit</button>
                        <button class="btn-action delete" onclick="deleteUser(5)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <button class="btn btn-secondary">Previous</button>
        <span class="page-info">Page 1 of 5</span>
        <button class="btn btn-secondary">Next</button>
    </div>
</div>

<style>
.search-box {
    display: flex;
    gap: 10px;
    margin-left: auto;
}

.search-input {
    padding: 10px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    font-size: 14px;
}

.role {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.role.admin {
    background: #007bff;
    color: white;
}

.role.moderator {
    background: #6c757d;
    color: white;
}

.role.user {
    background: #28a745;
    color: white;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

.page-info {
    color: #666;
    font-weight: 500;
}

@media (max-width: 768px) {
    .admin-actions {
        flex-direction: column;
    }
    
    .search-box {
        margin-left: 0;
        width: 100%;
    }
    
    .search-input {
        flex: 1;
    }
}
</style>

<script>
function addUser() {
    alert('Add user functionality would go here');
}

function editUser(id) {
    alert('Edit user ' + id + ' functionality would go here');
}

function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        alert('Delete user ' + id + ' functionality would go here');
    }
}
</script>

<?php include '../footer.php'; ?>