<?php
// admin/calculators.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="admin-header">
        <h1>Calculator Management</h1>
        <p>Manage all calculators and their categories</p>
    </div>

    <div class="admin-actions">
        <button class="btn btn-primary" onclick="addCalculator()">Add New Calculator</button>
        <button class="btn btn-secondary">Export List</button>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Calculator Name</th>
                    <th>Folder</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>BMI Calculator</td>
                    <td>/calculators/bmi-calculator/</td>
                    <td>Health & Fitness</td>
                    <td><span class="status active">Active</span></td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editCalculator(1)">Edit</button>
                        <button class="btn-action delete" onclick="deleteCalculator(1)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Loan EMI Calculator</td>
                    <td>/calculators/loan-emi-calculator/</td>
                    <td>Financial</td>
                    <td><span class="status active">Active</span></td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editCalculator(2)">Edit</button>
                        <button class="btn-action delete" onclick="deleteCalculator(2)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Currency Converter</td>
                    <td>/calculators/currency-converter/</td>
                    <td>Financial</td>
                    <td><span class="status active">Active</span></td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editCalculator(3)">Edit</button>
                        <button class="btn-action delete" onclick="deleteCalculator(3)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Mortgage Calculator</td>
                    <td>/calculators/mortgage-calculator/</td>
                    <td>Financial</td>
                    <td><span class="status inactive">Inactive</span></td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editCalculator(4)">Edit</button>
                        <button class="btn-action delete" onclick="deleteCalculator(4)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Age Calculator</td>
                    <td>/calculators/age-calculator/</td>
                    <td>Other</td>
                    <td><span class="status active">Active</span></td>
                    <td class="actions">
                        <button class="btn-action edit" onclick="editCalculator(5)">Edit</button>
                        <button class="btn-action delete" onclick="deleteCalculator(5)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
.admin-actions {
    margin-bottom: 30px;
    display: flex;
    gap: 15px;
}

.table-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th {
    background: #f8f9fa;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: #333;
    border-bottom: 1px solid #e0e0e0;
}

.admin-table td {
    padding: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.admin-table tr:hover {
    background: #f8f9fa;
}

.status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.status.active {
    background: #d4edda;
    color: #155724;
}

.status.inactive {
    background: #f8d7da;
    color: #721c24;
}

.actions {
    display: flex;
    gap: 8px;
}

.btn-action {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-action.edit {
    background: #007bff;
    color: white;
}

.btn-action.edit:hover {
    background: #0056b3;
}

.btn-action.delete {
    background: #dc3545;
    color: white;
}

.btn-action.delete:hover {
    background: #c82333;
}

@media (max-width: 768px) {
    .table-container {
        overflow-x: auto;
    }
    
    .admin-table {
        min-width: 600px;
    }
    
    .admin-actions {
        flex-direction: column;
    }
}
</style>

<script>
function addCalculator() {
    alert('Add calculator functionality would go here');
}

function editCalculator(id) {
    alert('Edit calculator ' + id + ' functionality would go here');
}

function deleteCalculator(id) {
    if (confirm('Are you sure you want to delete this calculator?')) {
        alert('Delete calculator ' + id + ' functionality would go here');
    }
}
</script>

<?php include '../footer.php'; ?>