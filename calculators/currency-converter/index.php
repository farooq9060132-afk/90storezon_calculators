<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter Online - Live Exchange Rates 2024</title>
    <meta name="description" content="Online currency converter with live exchange rates. Convert 150+ currencies instantly. No signup required! Accurate real-time foreign exchange calculator.">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-globe-americas"></i> Currency Converter</h1>
            <p>Convert 150+ currencies with live exchange rates</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-group">
                <label for="amount"><i class="fas fa-money-bill-wave"></i> Amount</label>
                <input type="number" id="amount" placeholder="Enter amount" min="0" step="0.01">
            </div>

            <div class="currency-row">
                <div class="input-group">
                    <label for="fromCurrency"><i class="fas fa-arrow-right"></i> From Currency</label>
                    <select id="fromCurrency">
                        <option value="USD">USD - US Dollar</option>
                        <option value="EUR">EUR - Euro</option>
                        <option value="GBP">GBP - British Pound</option>
                        <option value="JPY">JPY - Japanese Yen</option>
                        <option value="CAD">CAD - Canadian Dollar</option>
                        <option value="AUD">AUD - Australian Dollar</option>
                        <option value="CHF">CHF - Swiss Franc</option>
                        <option value="CNY">CNY - Chinese Yuan</option>
                        <option value="INR">INR - Indian Rupee</option>
                        <option value="PKR">PKR - Pakistani Rupee</option>
                    </select>
                </div>

                <div class="swap-button">
                    <button onclick="swapCurrencies()"><i class="fas fa-exchange-alt"></i></button>
                </div>

                <div class="input-group">
                    <label for="toCurrency"><i class="fas fa-arrow-left"></i> To Currency</label>
                    <select id="toCurrency">
                        <option value="EUR">EUR - Euro</option>
                        <option value="USD">USD - US Dollar</option>
                        <option value="GBP">GBP - British Pound</option>
                        <option value="JPY">JPY - Japanese Yen</option>
                        <option value="CAD">CAD - Canadian Dollar</option>
                        <option value="AUD">AUD - Australian Dollar</option>
                        <option value="CHF">CHF - Swiss Franc</option>
                        <option value="CNY">CNY - Chinese Yuan</option>
                        <option value="INR">INR - Indian Rupee</option>
                        <option value="PKR">PKR - Pakistani Rupee</option>
                    </select>
                </div>
            </div>

            <button class="calculate-btn" onclick="convertCurrency()">
                <i class="fas fa-sync-alt"></i> Convert Currency
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-chart-line"></i> Conversion Result</h3>
                <div class="conversion-result">
                    <div class="from-amount" id="fromAmount">0 USD</div>
                    <div class="equals">=</div>
                    <div class="to-amount" id="toAmount">0 EUR</div>
                </div>
                <div class="exchange-rate" id="exchangeRate">
                    Exchange Rate: 1 USD = 0 EUR
                </div>
                
                <div class="popular-currencies">
                    <h4>Popular Conversions</h4>
                    <div class="currency-grid" id="popularConversions">
                        <!-- Popular currencies will be loaded here -->
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
</body>
</html>