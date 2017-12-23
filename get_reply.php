<?php
include_once 'conn.php';

$topic = trim(urldecode($_GET['tp']));

function get_reply_id($topic, $mysqli) {
    $reply_id = 0;
    $sql = "SELECT reply_id from tb_topic where topic LIKE '%{$topic}%' LIMIT 1";
    if ($result = $mysqli->query($sql)) {
        while ($data = $result->fetch_array(MYSQLI_ASSOC)) {
            $reply_id = $data['reply_id'];
        }
    }
    $result->close();
    return $reply_id;
}

function get_reply($reply_id, $mysqli) {
    $reply_msg = array();
    $sql = "SELECT * FROM `tb_reply` WHERE `reply_id` = {$reply_id} LIMIT 1";
    if ($result = $mysqli->query($sql)) {
        while ($data = $result->fetch_assoc()) {
            $reply_msg = $data;
        }
    }
    $result->close();
    return $reply_msg;
}

$reply_id = get_reply_id($topic, $mysqli);
$reply_msg = get_reply($reply_id, $mysqli);

$mysqli->close();
print $reply_msg['message'];
exit;
?>