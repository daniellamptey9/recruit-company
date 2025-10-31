# Auto Git Commit and Push Script
# Monitors file changes and automatically commits and pushes to GitHub

Write-Host "Starting auto git commit and push..." -ForegroundColor Green
Write-Host "Press Ctrl+C to stop" -ForegroundColor Yellow

$lastCommit = Get-Date
$commitInterval = 30 # seconds - commit every 30 seconds if there are changes

while ($true) {
    $status = git status --porcelain
    
    if ($status) {
        $timeSinceLastCommit = (New-TimeSpan -Start $lastCommit -End (Get-Date)).TotalSeconds
        
        if ($timeSinceLastCommit -ge $commitInterval) {
            Write-Host "`nChanges detected. Committing and pushing..." -ForegroundColor Cyan
            
            # Stage all changes
            git add .
            
            # Get list of changed files for commit message
            $changedFiles = (git status --porcelain | ForEach-Object { $_.Split(" ", 2)[1] }) -join ", "
            $commitMessage = "Auto-commit: $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss') - $changedFiles"
            
            # Commit changes
            git commit -m $commitMessage
            
            # Push to remote
            git push origin HEAD
            
            $lastCommit = Get-Date
            Write-Host "Successfully committed and pushed!" -ForegroundColor Green
        }
    }
    
    Start-Sleep -Seconds 5
}

