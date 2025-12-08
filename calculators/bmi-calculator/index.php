<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator Online - Check Your Body Mass Index 2024</title>
    <meta name="description" content="Online BMI calculator tool. Check your body mass index instantly with our accurate calculator. Perfect for health conscious people. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../../header.php'; ?>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-heartbeat"></i> BMI Calculator</h1>
            <p>Calculate your Body Mass Index instantly</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-group">
                <label for="height"><i class="fas fa-ruler-vertical"></i> Height</label>
                <div class="height-input">
                    <input type="number" id="height" placeholder="Enter height" min="0">
                    <select id="heightUnit">
                        <option value="cm">cm</option>
                        <option value="feet">feet</option>
                        <option value="inches">inches</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label for="weight"><i class="fas fa-weight"></i> Weight</label>
                <div class="weight-input">
                    <input type="number" id="weight" placeholder="Enter weight" min="0">
                    <select id="weightUnit">
                        <option value="kg">kg</option>
                        <option value="pounds">pounds</option>
                    </select>
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateBMI()">
                <i class="fas fa-calculator"></i> Calculate BMI
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-chart-line"></i> BMI Results</h3>
                <div class="bmi-value" id="bmiValue">0</div>
                <div class="bmi-category" id="bmiCategory">Underweight</div>
                
                <div class="bmi-chart">
                    <div class="chart-item underweight">
                        <span>Underweight</span>
                        <span>&lt; 18.5</span>
                    </div>
                    <div class="chart-item normal">
                        <span>Normal</span>
                        <span>18.5 - 24.9</span>
                    </div>
                    <div class="chart-item overweight">
                        <span>Overweight</span>
                        <span>25 - 29.9</span>
                    </div>
                    <div class="chart-item obese">
                        <span>Obese</span>
                        <span>≥ 30</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Ads Slot -->
        <div class="ad-slot bottom-ad">
            [AD_BOTTOM_BANNER]
        </div>
    </div>

    <script src="script.js"></script>
    <?php include '../../footer.php'; ?>
</body>
</html>