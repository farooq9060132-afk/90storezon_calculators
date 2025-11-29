# PowerShell script to remove country-specific files from calculator folders

Write-Host "Starting removal of country-specific files from calculator folders..."

# Get all calculator directories
$calculatorsDir = "c:\Users\SiliCon\Downloads\90storezon_90_calculators\calculators"
$calculatorDirs = Get-ChildItem -Path $calculatorsDir -Directory | Where-Object { $_.Name -match '^\d{2}-' }

# Country-specific file patterns to remove
$countryPatterns = @("*australia*.php", "*bangladesh*.php", "*canada*.php", "*india*.php", "*pakistan*.php", "*uae*.php", "*uk*.php", "*usa*.php", "*saudi_arabia*.php", "*singapore*.php", "*south_africa*.php", "*malaysia*.php")

foreach ($dir in $calculatorDirs) {
    Write-Host "Processing folder: $($dir.Name)"
    
    foreach ($pattern in $countryPatterns) {
        $files = Get-ChildItem -Path $dir.FullName -Filter $pattern -ErrorAction SilentlyContinue
        
        foreach ($file in $files) {
            try {
                Remove-Item -Path $file.FullName -Force
                Write-Host "  Removed: $($file.Name)"
            } catch {
                Write-Host "  Failed to remove: $($file.Name)"
            }
        }
    }
}

Write-Host "Completed removal of country-specific files from all calculator folders."