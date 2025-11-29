# PowerShell script to clean calculator folders and keep only essential files

Write-Host "Starting cleanup of calculator folders..."

# Get all calculator directories
$calculatorsDir = "c:\Users\SiliCon\Downloads\90storezon_90_calculators\calculators"
$calculatorDirs = Get-ChildItem -Path $calculatorsDir -Directory | Where-Object { $_.Name -match '^\d{2}-' }

# Essential files that should be kept
$essentialFiles = @("index.php", "calculator.php", "style.css", "script.js")

foreach ($dir in $calculatorDirs) {
    Write-Host "Processing folder: $($dir.Name)"
    
    # Get all files in the directory
    $allFiles = Get-ChildItem -Path $dir.FullName -File
    
    foreach ($file in $allFiles) {
        # Check if the file is essential
        $isEssential = $false
        foreach ($essential in $essentialFiles) {
            if ($file.Name -eq $essential) {
                $isEssential = $true
                break
            }
        }
        
        # Remove non-essential files
        if (-not $isEssential) {
            try {
                Remove-Item -Path $file.FullName -Force
                Write-Host "  Removed: $($file.Name)"
            } catch {
                Write-Host "  Failed to remove: $($file.Name)"
            }
        } else {
            Write-Host "  Kept: $($file.Name)"
        }
    }
}

Write-Host "Completed cleanup of all calculator folders."