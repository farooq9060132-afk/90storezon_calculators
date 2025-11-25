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
            ['id' => '01', 'name' => 'Loan EMI Calculator', 'category' => 'finance', 'description' => 'Calculate your monthly loan payments'],
            ['id' => '04', 'name' => 'Mortgage Calculator', 'category' => 'finance', 'description' => 'Estimate your monthly mortgage payments'],
            ['id' => '05', 'name' => 'Compound Interest Calculator', 'category' => 'finance', 'description' => 'Calculate compound interest on investments'],
            ['id' => '11', 'name' => 'Investment Calculator', 'category' => 'finance', 'description' => 'Plan your investment growth'],
            ['id' => '10', 'name' => 'Retirement Planner', 'category' => 'finance', 'description' => 'Plan for your retirement'],
            ['id' => '09', 'name' => 'Tax Calculator', 'category' => 'finance', 'description' => 'Calculate taxes on income'],
            ['id' => '13', 'name' => 'Budget Planner', 'category' => 'finance', 'description' => 'Create and manage your budget'],
            ['id' => '12', 'name' => 'Salary Calculator', 'category' => 'finance', 'description' => 'Calculate take-home salary'],
            ['id' => '03', 'name' => 'Currency Converter', 'category' => 'finance', 'description' => 'Convert between currencies'],
            ['id' => '36', 'name' => 'Fuel Cost Calculator', 'category' => 'finance', 'description' => 'Calculate fuel costs for trips'],
            
            // Health & Fitness Calculators
            ['id' => '02', 'name' => 'BMI Calculator', 'category' => 'health', 'description' => 'Calculate your Body Mass Index'],
            ['id' => '06', 'name' => 'Calorie Calculator', 'category' => 'health', 'description' => 'Calculate daily calorie needs'],
            ['id' => '14', 'name' => 'Body Fat Calculator', 'category' => 'health', 'description' => 'Estimate body fat percentage'],
            ['id' => '17', 'name' => 'Macro Calculator', 'category' => 'health', 'description' => 'Calculate macronutrient needs'],
            ['id' => '16', 'name' => 'Water Intake Calculator', 'category' => 'health', 'description' => 'Determine daily water needs'],
            ['id' => '15', 'name' => 'Pregnancy Calculator', 'category' => 'health', 'description' => 'Track pregnancy milestones'],
            ['id' => '18', 'name' => 'Heart Rate Calculator', 'category' => 'health', 'description' => 'Determine target heart rate zones'],
            ['id' => '19', 'name' => 'Medication Calculator', 'category' => 'health', 'description' => 'Calculate medication dosages'],
            ['id' => '34', 'name' => 'Tip Calculator', 'category' => 'tools', 'description' => 'Calculate appropriate tips'],
            ['id' => '35', 'name' => 'Discount Calculator', 'category' => 'tools', 'description' => 'Calculate savings from discounts'],
            
            // Math & Education Calculators
            ['id' => '21', 'name' => 'Percentage Calculator', 'category' => 'math', 'description' => 'Calculate percentages easily'],
            ['id' => '20', 'name' => 'GPA Calculator', 'category' => 'math', 'description' => 'Calculate grade point average'],
            ['id' => '22', 'name' => 'Age Calculator', 'category' => 'math', 'description' => 'Calculate age in years, months, days'],
            ['id' => '24', 'name' => 'Scientific Calculator', 'category' => 'math', 'description' => 'Advanced scientific calculations'],
            ['id' => '25', 'name' => 'Grade Calculator', 'category' => 'math', 'description' => 'Calculate grades and averages'],
            ['id' => '26', 'name' => 'Study Planner', 'category' => 'math', 'description' => 'Plan your study schedule'],
            ['id' => '37', 'name' => 'Time Duration Calculator', 'category' => 'math', 'description' => 'Calculate time between dates/times'],
            ['id' => '38', 'name' => 'Age Difference Calculator', 'category' => 'math', 'description' => 'Calculate age difference between people'],
            ['id' => '39', 'name' => 'Date Calculator', 'category' => 'math', 'description' => 'Add/subtract days from dates'],
            
            // Utilities & Converters
            ['id' => '07', 'name' => 'QR Code Generator', 'category' => 'tools', 'description' => 'Generate QR codes for URLs/text'],
            ['id' => '08', 'name' => 'Password Generator', 'category' => 'tools', 'description' => 'Generate secure passwords'],
            ['id' => '23', 'name' => 'Unit Converter', 'category' => 'tools', 'description' => 'Convert between different units'],
            ['id' => '27', 'name' => 'Password Strength Checker', 'category' => 'tools', 'description' => 'Check password security strength'],
            ['id' => '28', 'name' => 'File Size Converter', 'category' => 'tools', 'description' => 'Convert between file size units'],
            ['id' => '29', 'name' => 'Color Code Converter', 'category' => 'tools', 'description' => 'Convert between color formats'],
            ['id' => '30', 'name' => 'Time Zone Converter', 'category' => 'tools', 'description' => 'Convert between time zones'],
            ['id' => '31', 'name' => 'Data Storage Calculator', 'category' => 'tools', 'description' => 'Calculate data storage needs'],
            ['id' => '40', 'name' => 'Base64 Converter', 'category' => 'tools', 'description' => 'Encode/decode Base64 strings'],
            ['id' => '41', 'name' => 'JSON Formatter', 'category' => 'tools', 'description' => 'Format and validate JSON'],
            ['id' => '42', 'name' => 'Regex Tester', 'category' => 'tools', 'description' => 'Test regular expressions'],
            ['id' => '43', 'name' => 'Code Beautifier', 'category' => 'tools', 'description' => 'Format and beautify code'],
            ['id' => '44', 'name' => 'MD5 Generator', 'category' => 'tools', 'description' => 'Generate MD5 hashes'],
            ['id' => '45', 'name' => 'URL Encoder/Decoder', 'category' => 'tools', 'description' => 'Encode/decode URLs'],
            ['id' => '46', 'name' => 'Character Counter', 'category' => 'tools', 'description' => 'Count characters, words, and lines'],
            ['id' => '47', 'name' => 'Lorem Ipsum Generator', 'category' => 'tools', 'description' => 'Generate placeholder text'],
            ['id' => '48', 'name' => 'CSV to JSON Converter', 'category' => 'tools', 'description' => 'Convert CSV data to JSON format'],
            ['id' => '32', 'name' => 'Website Load Time Calculator', 'category' => 'tools', 'description' => 'Estimate website loading times'],
            
            // Programming Tools
            ['id' => '33', 'name' => 'API Calculator', 'category' => 'programming', 'description' => 'Calculate API response times'],
            
            // Other
            ['id' => '49', 'name' => 'Carbon Footprint Calculator', 'category' => 'other', 'description' => 'Calculate your carbon footprint'],
            ['id' => '50', 'name' => 'YouTube Earnings Calculator', 'category' => 'other', 'description' => 'Estimate YouTube earnings']
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
            $folder_name = strtolower($calculator['id'] . '-' . str_replace(' ', '-', $calculator['name']));
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