# PowerShell script to remove unwanted files from all calculator folders

Write-Host "Starting removal of unwanted files from calculator folders..."

# Get all calculator directories
$calculatorsDir = "c:\Users\SiliCon\Downloads\90storezon_90_calculators\calculators"
$calculatorDirs = Get-ChildItem -Path $calculatorsDir -Directory | Where-Object { $_.Name -match '^\d{2}-' }

# Files to remove
$filesToRemove = @("google-ads.txt", "seo-config.txt")

foreach ($dir in $calculatorDirs) {
    Write-Host "Processing folder: $($dir.Name)"
    
    foreach ($file in $filesToRemove) {
        $filePath = Join-Path $dir.FullName $file
        
        if (Test-Path $filePath) {
            try {
                Remove-Item -Path $filePath -Force
                Write-Host "  Removed: $file"
            } catch {
                Write-Host "  Failed to remove: $file"
            }
        } else {
            Write-Host "  File not found: $file"
        }
    }
}

Write-Host "Completed removal of unwanted files from all calculator folders."