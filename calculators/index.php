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
        // Define calculator data with categories
        $calculators = [
            // Financial Calculators
            ['name' => 'Loan EMI Calculator', 'category' => 'finance', 'description' => 'Calculate your monthly loan payments'],
            ['name' => 'Mortgage Calculator', 'category' => 'finance', 'description' => 'Estimate your monthly mortgage payments'],
            ['name' => 'Compound Interest Calculator', 'category' => 'finance', 'description' => 'Calculate compound interest on investments'],
            ['name' => 'Investment Calculator', 'category' => 'finance', 'description' => 'Plan your investment growth'],
            ['name' => 'Retirement Planner', 'category' => 'finance', 'description' => 'Plan for your retirement'],
            ['name' => 'Tax Calculator', 'category' => 'finance', 'description' => 'Calculate taxes on income'],
            ['name' => 'Budget Planner', 'category' => 'finance', 'description' => 'Create and manage your budget'],
            ['name' => 'Salary Calculator', 'category' => 'finance', 'description' => 'Calculate take-home salary'],
            ['name' => 'Currency Converter', 'category' => 'finance', 'description' => 'Convert between currencies'],
            ['name' => 'Fuel Cost Calculator', 'category' => 'finance', 'description' => 'Calculate fuel costs for trips'],
            
            // Health & Fitness Calculators
            ['name' => 'BMI Calculator', 'category' => 'health', 'description' => 'Calculate your Body Mass Index'],
            ['name' => 'Calorie Calculator', 'category' => 'health', 'description' => 'Calculate daily calorie needs'],
            ['name' => 'Body Fat Calculator', 'category' => 'health', 'description' => 'Estimate body fat percentage'],
            ['name' => 'Macro Calculator', 'category' => 'health', 'description' => 'Calculate macronutrient needs'],
            ['name' => 'Water Intake Calculator', 'category' => 'health', 'description' => 'Determine daily water needs'],
            ['name' => 'Pregnancy Calculator', 'category' => 'health', 'description' => 'Track pregnancy milestones'],
            ['name' => 'Heart Rate Calculator', 'category' => 'health', 'description' => 'Determine target heart rate zones'],
            ['name' => 'Medication Calculator', 'category' => 'health', 'description' => 'Calculate medication dosages'],
            ['name' => 'Tip Calculator', 'category' => 'tools', 'description' => 'Calculate appropriate tips'],
            ['name' => 'Discount Calculator', 'category' => 'tools', 'description' => 'Calculate savings from discounts'],
            
            // Math & Education Calculators
            ['name' => 'Percentage Calculator', 'category' => 'math', 'description' => 'Calculate percentages easily'],
            ['name' => 'GPA Calculator', 'category' => 'math', 'description' => 'Calculate grade point average'],
            ['name' => 'Age Calculator', 'category' => 'math', 'description' => 'Calculate age in years, months, days'],
            ['name' => 'Scientific Calculator', 'category' => 'math', 'description' => 'Advanced scientific calculations'],
            ['name' => 'Grade Calculator', 'category' => 'math', 'description' => 'Calculate grades and averages'],
            ['name' => 'Study Planner', 'category' => 'math', 'description' => 'Plan your study schedule'],
            ['name' => 'Time Duration Calculator', 'category' => 'math', 'description' => 'Calculate time between dates/times'],
            ['name' => 'Age Difference Calculator', 'category' => 'math', 'description' => 'Calculate age difference between people'],
            ['name' => 'Date Calculator', 'category' => 'math', 'description' => 'Add/subtract days from dates'],
            
            // Utilities & Converters
            ['name' => 'QR Code Generator', 'category' => 'tools', 'description' => 'Generate QR codes for URLs/text'],
            ['name' => 'Password Generator', 'category' => 'tools', 'description' => 'Generate secure passwords'],
            ['name' => 'Unit Converter', 'category' => 'tools', 'description' => 'Convert between different units'],
            ['name' => 'Password Strength Checker', 'category' => 'tools', 'description' => 'Check password security strength'],
            ['name' => 'File Size Converter', 'category' => 'tools', 'description' => 'Convert between file size units'],
            ['name' => 'Color Code Converter', 'category' => 'tools', 'description' => 'Convert between color formats'],
            ['name' => 'Time Zone Converter', 'category' => 'tools', 'description' => 'Convert between time zones'],
            ['name' => 'Data Storage Calculator', 'category' => 'tools', 'description' => 'Calculate data storage needs'],
            ['name' => 'Base64 Converter', 'category' => 'tools', 'description' => 'Encode/decode Base64 strings'],
            ['name' => 'JSON Formatter', 'category' => 'tools', 'description' => 'Format and validate JSON'],
            ['name' => 'Regex Tester', 'category' => 'tools', 'description' => 'Test regular expressions'],
            ['name' => 'Code Beautifier', 'category' => 'tools', 'description' => 'Format and beautify code'],
            ['name' => 'MD5 Generator', 'category' => 'tools', 'description' => 'Generate MD5 hashes'],
            ['name' => 'URL Encoder/Decoder', 'category' => 'tools', 'description' => 'Encode/decode URLs'],
            ['name' => 'Character Counter', 'category' => 'tools', 'description' => 'Count characters, words, and lines'],
            ['name' => 'Lorem Ipsum Generator', 'category' => 'tools', 'description' => 'Generate placeholder text'],
            ['name' => 'CSV to JSON Converter', 'category' => 'tools', 'description' => 'Convert CSV data to JSON format'],
            ['name' => 'Website Load Time Calculator', 'category' => 'tools', 'description' => 'Estimate website loading times'],
            
            // Programming Tools
            ['name' => 'API Calculator', 'category' => 'programming', 'description' => 'Calculate API response times'],
            
            // Other
            ['name' => 'Carbon Footprint Calculator', 'category' => 'other', 'description' => 'Calculate your carbon footprint'],
            ['name' => 'YouTube Earnings Calculator', 'category' => 'other', 'description' => 'Estimate YouTube earnings']
        ];

        // Filter calculators based on category
        $filteredCalculators = $calculators;
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $category = $_GET['category'];
            $filteredCalculators = array_filter($calculators, function($calc) use ($category) {
                return $calc['category'] == $category;
            });
        }

        // Display calculators
        foreach ($filteredCalculators as $calculator) {
            $folder_name = strtolower(str_replace(' ', '-', $calculator['name']));
            echo '<div class="calculator-card">';
            echo '<h3><a href="/calculators/' . $folder_name . '/">' . $calculator['name'] . '</a></h3>';
            echo '<p>' . $calculator['description'] . '</p>';
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