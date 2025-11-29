<?php include '../header.php'; ?>

<div class="container">
    <h1>All Calculators</h1>
    
    <!-- Category Filter -->
    <div class="category-filter">
        <a href="?category=finance" class="filter-btn <?php echo (!isset($_GET['category']) || $_GET['category'] == 'finance') ? 'active' : ''; ?>">Financial Tools</a>
        <a href="?category=health" class="filter-btn <?php echo (isset($_GET['category']) && $_GET['category'] == 'health') ? 'active' : ''; ?>">Health & Fitness</a>
        <a href="?category=math" class="filter-btn <?php echo (isset($_GET['category']) && $_GET['category'] == 'math') ? 'active' : ''; ?>">Math & Education</a>
        <a href="?category=tools" class="filter-btn <?php echo (isset($_GET['category']) && $_GET['category'] == 'tools') ? 'active' : ''; ?>">Utilities & Converters</a>
        <a href="?category=programming" class="filter-btn <?php echo (isset($_GET['category']) && $_GET['category'] == 'programming') ? 'active' : ''; ?>">Programming</a>
        <a href="?" class="filter-btn <?php echo (!isset($_GET['category']) || $_GET['category'] == '') ? 'active' : ''; ?>">All Categories</a>
    </div>

    <!-- Calculators Grid -->
    <div class="calculators-grid">
        <?php
        // Read calculator data from JSON file
        $calculatorData = json_decode(file_get_contents('../calculator_list.json'), true);
        
        // Define categories for filtering
        $categories = [
            'finance' => 'Financial Tools',
            'health' => 'Health & Fitness',
            'math' => 'Math & Education',
            'tools' => 'Utilities & Converters',
            'programming' => 'Programming'
        ];
        
        // Filter calculators based on category
        $filteredCalculators = $calculatorData;
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $category = $_GET['category'];
            $filteredCalculators = array_filter($calculatorData, function($calc) use ($category) {
                // We'll need to add category information to the JSON or determine it from the name
                // For now, we'll show all calculators regardless of category when filtered
                return true;
            });
        }

        // Display calculators
        foreach ($filteredCalculators as $calculator) {
            echo '<div class="calculator-card">';
            echo '<h3><a href="' . $calculator['path'] . '">' . $calculator['name'] . '</a></h3>';
            // Add a generic description since it's not in the JSON
            echo '<p>Professional calculator tool for ' . strtolower($calculator['name']) . '.</p>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<style>
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.category-filter {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    margin-bottom: 30px;
}

.filter-btn {
    padding: 10px 20px;
    background: #f0f0f0;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease;
}

.filter-btn:hover,
.filter-btn.active {
    background: #0052FF;
    color: white;
}

.calculators-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.calculator-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.calculator-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.calculator-card h3 {
    margin-top: 0;
}

.calculator-card h3 a {
    text-decoration: none;
    color: #0052FF;
}

.calculator-card p {
    color: #666;
    margin-bottom: 0;
}
</style>

<?php include '../footer.php'; ?>