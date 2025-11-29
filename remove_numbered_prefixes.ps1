# PowerShell script to remove numbered prefixes from calculator folders

Write-Host "Starting calculator folder renaming process to remove numbered prefixes..."

$calculatorsDir = "c:\Users\SiliCon\Downloads\90storezon_90_calculators\calculators"

# Get all directories that start with a number followed by a dash
$folders = Get-ChildItem -Path $calculatorsDir -Directory | Where-Object { $_.Name -match '^\d+-' }

foreach ($folder in $folders) {
    $oldFolderName = $folder.Name
    # Remove the numbered prefix (e.g., "01-" from "01-loan-emi-calculator")
    $newFolderName = $oldFolderName -replace '^\d+-', ''
    $oldFolderPath = $folder.FullName
    $newFolderPath = Join-Path $calculatorsDir $newFolderName
    
    # Check if the new folder doesn't already exist
    if (-not (Test-Path $newFolderPath -PathType Container)) {
        # Rename the folder
        try {
            Rename-Item -Path $oldFolderPath -NewName $newFolderName
            Write-Host "Renamed: $oldFolderName -> $newFolderName"
        } catch {
            Write-Host "Failed to rename: $oldFolderName"
            Write-Host "Error: $_"
        }
    } else {
        Write-Host "New folder already exists: $newFolderName"
    }
}

Write-Host "Calculator folder renaming process completed."