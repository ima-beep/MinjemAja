<?php
$path = __DIR__ . '/../storage/framework/views/6e50b602ec3db9ef68338c267ad352aa.php';
$lines = file($path);
$ln = 28; // 1-based
if (!isset($lines[$ln-1])) { echo "No such line\n"; exit(1); }
$line = $lines[$ln-1];
echo "LINE $ln: ";
for ($i=0; $i<strlen($line); $i++) {
    $c = $line[$i];
    $o = ord($c);
    if ($o >= 32 && $o <= 126) echo $c; else echo sprintf("\\x%02X", $o);
}
echo PHP_EOL;
foreach (str_split($line) as $i => $c) {
    printf("%02d: 0x%02X %s\n", $i, ord($c), preg_replace('/[[:^print:]]/', '.', $c));
}
