# PowerShell script to rename calculator folders with numbered prefixes

# Define the mapping based on calculator_list.json
$calculatorMapping = @{
    "01" = @{ "name" = "Loan EMI Calculator"; "folder" = "loan-emi-calculator" }
    "02" = @{ "name" = "BMI Calculator"; "folder" = "bmi-calculator" }
    "03" = @{ "name" = "Currency Converter"; "folder" = "currency-converter" }
    "04" = @{ "name" = "Mortgage Calculator"; "folder" = "mortgage-calculator" }
    "05" = @{ "name" = "Compound Interest Calculator"; "folder" = "compound-interest-calculator" }
    "06" = @{ "name" = "Calorie Calculator"; "folder" = "calorie-calculator" }
    "07" = @{ "name" = "QR Code Generator"; "folder" = "qr-code-generator" }
    "08" = @{ "name" = "Password Generator"; "folder" = "password-generator" }
    "09" = @{ "name" = "Tax Calculator"; "folder" = "tax-calculator" }
    "10" = @{ "name" = "Retirement Planner"; "folder" = "retirement-planner" }
    "11" = @{ "name" = "Investment Calculator"; "folder" = "investment-calculator" }
    "12" = @{ "name" = "Salary Calculator"; "folder" = "salary-calculator" }
    "13" = @{ "name" = "Budget Planner"; "folder" = "budget-planner" }
    "14" = @{ "name" = "Body Fat Calculator"; "folder" = "body-fat-calculator" }
    "15" = @{ "name" = "Pregnancy Calculator"; "folder" = "pregnancy-calculator" }
    "16" = @{ "name" = "Water Intake Calculator"; "folder" = "water-intake-calculator" }
    "17" = @{ "name" = "Macro Calculator"; "folder" = "macro-calculator" }
    "18" = @{ "name" = "Heart Rate Calculator"; "folder" = "heart-rate-calculator" }
    "19" = @{ "name" = "Medication Calculator"; "folder" = "medication-calculator" }
    "20" = @{ "name" = "GPA Calculator"; "folder" = "gpa-calculator" }
    "21" = @{ "name" = "Percentage Calculator"; "folder" = "percentage-calculator" }
    "22" = @{ "name" = "Age Calculator"; "folder" = "age-calculator" }
    "23" = @{ "name" = "Unit Converter"; "folder" = "unit-converter" }
    "24" = @{ "name" = "Scientific Calculator"; "folder" = "scientific-calculator" }
    "25" = @{ "name" = "Grade Calculator"; "folder" = "grade-calculator" }
    "26" = @{ "name" = "Study Planner"; "folder" = "study-planner" }
    "27" = @{ "name" = "Password Strength Checker"; "folder" = "password-strength-checker" }
    "28" = @{ "name" = "File Size Converter"; "folder" = "file-size-converter" }
    "29" = @{ "name" = "Color Code Converter"; "folder" = "color-code-converter" }
    "30" = @{ "name" = "Time Zone Converter"; "folder" = "time-zone-converter" }
    "31" = @{ "name" = "Data Storage Calculator"; "folder" = "data-storage-calculator" }
    "32" = @{ "name" = "Website Load Time Calculator"; "folder" = "website-load-time-calculator" }
    "33" = @{ "name" = "API Calculator"; "folder" = "api-calculator" }
    "34" = @{ "name" = "Tip Calculator"; "folder" = "tip-calculator" }
    "35" = @{ "name" = "Discount Calculator"; "folder" = "discount-calculator" }
    "36" = @{ "name" = "Fuel Cost Calculator"; "folder" = "fuel-cost-calculator" }
    "37" = @{ "name" = "Time Duration Calculator"; "folder" = "time-duration-calculator" }
    "38" = @{ "name" = "Age Difference Calculator"; "folder" = "age-difference-calculator" }
    "39" = @{ "name" = "Date Calculator"; "folder" = "date-calculator" }
    "40" = @{ "name" = "Base64 Converter"; "folder" = "base64-converter" }
    "41" = @{ "name" = "JSON Formatter"; "folder" = "json-formatter" }
    "42" = @{ "name" = "Regex Tester"; "folder" = "regex-tester" }
    "43" = @{ "name" = "Code Beautifier"; "folder" = "code-beautifier" }
    "44" = @{ "name" = "MD5 Generator"; "folder" = "md5-generator" }
    "45" = @{ "name" = "URL Encoder"; "folder" = "url-encoder" }
    "46" = @{ "name" = "Character Counter"; "folder" = "character-counter" }
    "47" = @{ "name" = "Lorem Ipsum Generator"; "folder" = "lorem-ipsum-generator" }
    "48" = @{ "name" = "CSV to JSON Converter"; "folder" = "csv-to-json-converter" }
    "49" = @{ "name" = "Carbon Footprint Calculator"; "folder" = "carbon-footprint-calculator" }
    "50" = @{ "name" = "YouTube Earnings Calculator"; "folder" = "youtube-earnings-calculator" }
}

Write-Host "Starting calculator folder renaming process..."

$calculatorsDir = "c:\Users\SiliCon\Downloads\90storezon_90_calculators\calculators"

foreach ($entry in $calculatorMapping.GetEnumerator()) {
    $number = $entry.Key
    $info = $entry.Value
    $oldFolderName = $info.folder
    $newFolderName = "$number-$oldFolderName"
    
    $oldFolderPath = Join-Path $calculatorsDir $oldFolderName
    $newFolderPath = Join-Path $calculatorsDir $newFolderName
    
    # Check if the old folder exists
    if (Test-Path $oldFolderPath -PathType Container) {
        # Check if the new folder doesn't already exist
        if (-not (Test-Path $newFolderPath -PathType Container)) {
            # Rename the folder
            try {
                Rename-Item -Path $oldFolderPath -NewName $newFolderName
                Write-Host "Renamed: $oldFolderName -> $newFolderName"
            } catch {
                Write-Host "Failed to rename: $oldFolderName"
            }
        } else {
            Write-Host "New folder already exists: $newFolderName"
        }
    } else {
        Write-Host "Old folder doesn't exist: $oldFolderName"
        # Check if it's already named correctly
        if (Test-Path $newFolderPath -PathType Container) {
            Write-Host "Already correctly named: $newFolderName"
        }
    }
}

Write-Host "Calculator folder renaming process completed."