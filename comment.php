<?php
set_time_limit(0);
include 'Instagram.class.php';
clear();
echo "
 *  𝗧𝗘𝗔𝗠 𝗗𝗘𝗩𝗜𝗟𝗕𝗢𝗧

 *  𝗜𝗡𝗦𝗧𝗔𝗚𝗥𝗔𝗠 𝗙𝗘𝗘𝗗 𝗖𝗼𝗺𝗺𝗲𝗻𝘁 𝗕𝗢𝗧

 *  𝗖𝗼𝗱𝗲𝗱 𝗯𝘆 : 𝗣𝗿𝗮𝗻𝗮𝘃

 *  𝗜𝗻𝘀𝘁𝗮𝗴𝗿𝗮𝗺 : 𝗻_𝗮_𝘂_𝘁_𝗶_𝗰_𝗮_𝗹_𝗯_𝗼_𝘆

 *  𝗥𝗘𝗖𝗢𝗠𝗠𝗘𝗡𝗗𝗘𝗗 : 𝗦𝗟𝗘𝗘𝗣 𝟱𝟬𝘀
  
    •••••••••••••••••••••••••••••••••••••••••
    
 * 𝗨𝘀𝗲 𝘁𝗼𝗼𝗹𝘀 𝗮𝘁 𝘆𝗼𝘂𝗿 𝗼𝘄𝗻 𝗿𝗶𝘀𝗸.

 * 𝙐𝙨𝙚 𝙩𝙝𝙞𝙨 𝙏𝙤𝙤𝙡 𝙛𝙤𝙧 𝙥𝙚𝙧𝙨𝙤𝙣𝙖𝙡 𝙪𝙨𝙚, 𝙣𝙤𝙩 𝙛𝙤𝙧 𝙨𝙖𝙡𝙚.

 * 𝗜 𝗮𝗺 𝗻𝗼𝘁 𝗿𝗲𝘀𝗽𝗼𝗻𝘀𝗶𝗯𝗹𝗲 𝗳𝗼𝗿 𝘆𝗼𝘂𝗿 𝗮𝗰𝗰𝗼𝘂𝗻𝘁 𝘂𝘀𝗶𝗻𝗴 𝘁𝗵𝗶𝘀 𝘁𝗼𝗼𝗹.

 * 𝗠𝗮𝗸𝗲 𝘀𝘂𝗿𝗲 𝘆𝗼𝘂𝗿 𝗮𝗰𝗰𝗼𝘂𝗻𝘁 𝗵𝗮𝘀 𝗯𝗲𝗲𝗻 𝘃𝗲𝗿𝗶𝗳𝗶𝗲𝗱 (𝗘𝗺𝗮𝗶𝗹 & 𝗧𝗲𝗹𝗽).

 * 𝗔𝗽𝗼𝗼 𝗻𝗴𝗮𝗻𝗲 𝗽𝗼𝘄𝗹𝗶𝗸𝗮𝗹𝗹𝗲 😻😻😻
 
";

## username and password geting
$username    = getUsername();
$password    = getPassword();

$login = login($username, $password);
if ($login['status'] == 'success') {
    echo '[*] Login as ' . $login['username'] . ' Success!' . PHP_EOL;
    $data_login = array(
        'username' => $login['username'],
        'csrftoken' => $login['csrftoken'],
        'sessionid' => $login['sessionid']

    );
    $comment = getComment();
    $sleep = rand(200,200) + getComment('[?]  Sleep in Seconds ( RECOMMENDED 25s )  : ');

       while (true) {
        $profile    = getHome($data_login);
        $data_array = json_decode($profile);
        $result     = $data_array->user->edge_web_feed_timeline;
        foreach ($result->edges as $items) {
            $id       = $items->node->id;
            $username = $items->node->owner->username;


            $like = comment($id, $data_login,$comment);
            if ($like['status'] == 'error') {
                echo '[+] Username: ' . $username . ' | Media_id: ' . $id . ' | Error Comment' . PHP_EOL;
                logout($data_login);
                $login = login($username, $password);
                if ($login['status'] == 'success') {
                    echo '[*] Login as ' . $login['username'] . ' Success!' . PHP_EOL;
                    $data_login = array(
                        'username' => $login['username'],
                        'csrftoken' => $login['csrftoken'],
                        'sessionid' => $login['sessionid']
                    );
                }else{

                    die("Something went wrong");

                }
            } else {
                echo '[+] Username: ' . $username . ' | Media_id: ' . $id . ' | Comment Success' . PHP_EOL;
            }
            break;
        }
        echo '[+] [' . date("H:i:s") . '] Sleep for ' . $sleep . ' seconds [+]' . PHP_EOL;
        sleep( $sleep);
        echo  '•••••••••••••••••••••••••••••••••••••••••' . PHP_EOL . PHP_EOL;
    }



}else

    echo json_encode($login);
