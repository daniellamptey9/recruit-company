@echo off
REM Auto Git Commit and Push - Run this script to start auto-committing changes
echo Starting auto git commit and push...
echo Press Ctrl+C to stop
powershell.exe -ExecutionPolicy Bypass -File "%~dp0auto-git-push.ps1"

