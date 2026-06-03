<?php
/**
 * 访问统计脚本（按调用文件分组）
 * 自动根据调用文件生成对应的CSV表格
 * 字段：Page, IP, VisitCount, FirstVisit, LastVisit
 */

// 防止直接访问
if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    http_response_code(403);
    die('Forbidden');
}

// 👇👇👇 新增：设置你要忽略的 IP 列表 👇👇👇
$ignoreIps = [
    '113.236.*.*',      // ← 替换成你的真实公网 IP！
    '192.168.1.100',     // 本地开发用（可选）
    '::1',               // IPv6 本地回环（可选）
    '127.0.0.1'          // 本地测试（可选）
];
// 👆👆👆 别忘了改这里！ 👆👆👆

// 获取访客真实 IP
function getRealIP() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = array_map('trim', explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        return $ips[0];
    } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } else {
        return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }
}

// 检查IP是否匹配通配符
function isIpIgnored($ip, $ignoreIps) {
    foreach ($ignoreIps as $ignoreIp) {
        // 如果是通配符IP（如 113.236.*.*）
        if (strpos($ignoreIp, '*') !== false) {
            $pattern = str_replace(['.', '*'], ['\.', '\d+'], $ignoreIp);
            $pattern = '/^' . str_replace('\*', '\.\*', $pattern) . '$/';
            if (preg_match($pattern, $ip)) {
                return true;
            }
        }
        // 精确匹配
        elseif ($ip === $ignoreIp) {
            return true;
        }
    }
    return false;
}

$ip = getRealIP();

// 👇👇👇 如果是自己的 IP，直接退出，不记录 👇👇👇
if (isIpIgnored($ip, $ignoreIps)) {
    return; // 安静退出，不写日志
}
// 👆👆👆 就这一行，搞定！ 👆👆👆

// 获取调用文件的路径信息
$currentScript = $_SERVER['SCRIPT_NAME'] ?? $_SERVER['PHP_SELF'] ?? '/unknown';
$page = $currentScript;

// 从调用脚本的路径生成CSV文件名
// 例如：/index.php -> visit_stats_index.csv
//       /genshin/index.php -> visit_stats_genshin.csv
//       /sky/index.php -> visit_stats_sky.csv
function generateCsvFilename($scriptPath) {
    $path = dirname($scriptPath);
    $filename = basename($scriptPath, '.php');
    
    // 如果是根目录的index.php，直接命名为visit_stats_index.csv
    if ($path === '/' && $filename === 'index') {
        return 'visit_stats_index.csv';
    }
    
    // 如果不是根目录，取目录名作为标识
    if ($path !== '/') {
        $dirName = trim($path, '/');
        // 如果有多层目录，只取第一层
        $parts = explode('/', $dirName);
        $folder = $parts[0];
        return 'visit_stats_' . $folder . '.csv';
    }
    
    // 其他情况用脚本名
    return 'visit_stats_' . $filename . '.csv';
}

// 生成对应的CSV文件名
$csvFilename = generateCsvFilename($currentScript);
$csvFile = __DIR__ . '/' . $csvFilename;

$now = date('Y-m-d H:i:s');

// 初始化数据数组（键为 "page|ip"，值为统计信息）
$stats = [];

// 如果 CSV 文件存在，读取现有数据
if (file_exists($csvFile)) {
    $handle = fopen($csvFile, 'r');
    if ($handle) {
        // 跳过标题行
        fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 5) continue;
            [$csvPage, $csvIP, $count, $first, $last] = $row;
            $key = $csvPage . '|' . $csvIP;
            $stats[$key] = [
                'page' => $csvPage,
                'ip' => $csvIP,
                'count' => (int)$count,
                'first' => $first,
                'last' => $last
            ];
        }
        fclose($handle);
    }
}

// 当前访问的唯一键
$key = $page . '|' . $ip;

if (isset($stats[$key])) {
    // 已存在：次数+1，更新最后访问时间
    $stats[$key]['count']++;
    $stats[$key]['last'] = $now;
} else {
    // 新记录
    $stats[$key] = [
        'page' => $page,
        'ip' => $ip,
        'count' => 1,
        'first' => $now,
        'last' => $now
    ];
}

// 写回 CSV 文件（带标题）
$handle = fopen($csvFile, 'w');
if ($handle) {
    // 写入表头
    fputcsv($handle, ['Page', 'IP', 'VisitCount', 'FirstVisit', 'LastVisit']);
    // 写入所有记录
    foreach ($stats as $record) {
        fputcsv($handle, [
            $record['page'],
            $record['ip'],
            $record['count'],
            $record['first'],
            $record['last']
        ]);
    }
    fclose($handle);
}

// 可选：输出日志信息（调试用）
// error_log("访问统计已记录: 文件={$csvFilename}, IP={$ip}, 页面={$page}");
?>
