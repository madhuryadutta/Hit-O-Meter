#!/bin/bash

# Get today's date in YYYYMMDD format
datetoday=$(date +%Y%m%d)
echo -e "\033[1;34m📅 Today's date: $datetoday\033[0m"

# Function to show progress
progress() {
    local pid=$!
    local spin='|/-\'
    local i=0
    while kill -0 $pid 2>/dev/null; do
        i=$(( (i+1) %4 ))
        printf "\r⏳ $1... ${spin:$i:1}"
        sleep 0.1
    done
    printf "\r✅ $1... Done!          \n"
}

# Composer update with progress
(composer update) & progress "Running composer update"

# NPM update with progress
(npm update) & progress "Running npm update"

# Git commit with progress
(git add -A && git commit -s -m "chore(deps): upgrade dependencies on $datetoday") & progress "Creating git commit"

# Final message
echo -e "\033[1;32m✅ Dependency upgrade complete!\033[0m"
echo -e "\033[1;34m🚀 Please push your changes to Git.\033[0m"
