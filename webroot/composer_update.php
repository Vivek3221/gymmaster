<?php
/**
 * Composer Web Runner
 * Allows running composer commands via web browser when SSH/terminal access is unavailable.
 */

// Disable output buffering to stream results in real-time
if (ob_get_level()) {
    ob_end_clean();
}
ob_implicit_flush(true);
header('Content-Type: text/plain; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Set high limits
set_time_limit(900); // 15 minutes
ini_set('memory_limit', '1024M');

$rootDir = dirname(__DIR__);
chdir($rootDir);

echo "Working directory: " . getcwd() . "\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "PHP Binary: " . (defined('PHP_BINARY') ? PHP_BINARY : 'php') . "\n";

// Helper function to execute and stream command output
function runCommand($cmd) {
    echo "\nExecuting: $cmd\n";
    echo str_repeat('-', 80) . "\n";
    
    $descriptorSpec = [
        0 => ["pipe", "r"], // stdin
        1 => ["pipe", "w"], // stdout
        2 => ["pipe", "w"]  // stderr
    ];
    
    $process = proc_open($cmd, $descriptorSpec, $pipes);
    
    if (is_resource($process)) {
        fclose($pipes[0]); // Don't need stdin
        
        // Read stdout and stderr in real-time
        while (!feof($pipes[1]) || !feof($pipes[2])) {
            $out = fgets($pipes[1]);
            if ($out !== false) {
                echo $out;
                flush();
            }
            $err = fgets($pipes[2]);
            if ($err !== false) {
                echo "ERR: " . $err;
                flush();
            }
        }
        
        fclose($pipes[1]);
        fclose($pipes[2]);
        
        $returnValue = proc_close($process);
        echo str_repeat('-', 80) . "\n";
        echo "Command returned: $returnValue\n";
        return $returnValue === 0;
    } else {
        echo "Failed to start process.\n";
        return false;
    }
}

// 1. Check if shell execution is available
if (!function_exists('proc_open')) {
    die("Error: proc_open() function is disabled in php.ini. Cannot run shell commands.\n");
}

// 2. Determine PHP command name
$phpPath = defined('PHP_BINARY') && PHP_BINARY ? PHP_BINARY : 'php';

// 3. Test if global composer is available
echo "Checking if global composer is available...\n";
$hasGlobalComposer = false;
$descriptorSpec = [1 => ["pipe", "w"], 2 => ["pipe", "w"]];
$process = proc_open("composer --version", $descriptorSpec, $pipes);
if (is_resource($process)) {
    $out = stream_get_contents($pipes[1]);
    $err = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $code = proc_close($process);
    if ($code === 0) {
        $hasGlobalComposer = true;
        echo "Found global composer: " . trim($out) . "\n";
    }
}

$composerCmd = 'composer';

if (!$hasGlobalComposer) {
    echo "Global composer not found. Checking for composer.phar in root...\n";
    if (!file_exists('composer.phar')) {
        echo "Downloading composer.phar...\n";
        $installerUrl = 'https://getcomposer.org/installer';
        $installerCode = file_get_contents($installerUrl);
        if ($installerCode === false) {
            die("Error: Failed to fetch composer installer from $installerUrl\n");
        }
        file_put_contents('composer-setup.php', $installerCode);
        
        echo "Running composer setup...\n";
        $setupSuccess = runCommand("\"$phpPath\" composer-setup.php");
        unlink('composer-setup.php');
        
        if (!$setupSuccess || !file_exists('composer.phar')) {
            die("Error: Failed to download composer.phar\n");
        }
        echo "composer.phar downloaded successfully!\n";
    } else {
        echo "Found existing composer.phar in root.\n";
    }
    
    $composerCmd = "\"$phpPath\" composer.phar";
}

// 4. Run composer update
$command = $composerCmd . " update --no-interaction --optimize-autoloader";
echo "Starting composer update...\n";
$success = runCommand($command);

if ($success) {
    echo "\nComposer update completed successfully!\n";
} else {
    echo "\nComposer update failed.\n";
}
