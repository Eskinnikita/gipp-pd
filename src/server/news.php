<?php
    if (isset($_COOKIE['token'])) {
        if (check_token($_COOKIE['token'], $pdo)) {

            if ($method === "GET" && isset($formData['id'])) {
                $news = get_news_by_id($formData['id'], $pdo);
                $result = array();
                foreach ($news as $key => $value) {
                    $result[$key] = $value;
                }
                unset ($result['queryString']);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            } elseif ($method === "GET" && !isset($formData['id'])) {
                $news = get_news($formData['listNumber'], $formData['rubricUri'], $formData['tags'], $pdo);
                foreach ($news as $key => $value) {
                    $result[$key] = $value;
                }
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            } elseif ($method === "POST") {
                add_news($formData, $pdo);
            } elseif ($method === "PUT") {
                update_news($_GET['id'], $formData, $pdo);
                echo " u'r update news with id " . $_GET['id'];
            } elseif ($method === "DELETE") {
                delete_news($_GET['id'], $pdo);
                echo " u'r delete news with id " . $_GET['id'];
            } else sendResponse($method, $formData, '', 400, "Bad request", $pdo);
        } else {
            sendResponse($method, $formData, '', 400, "Wrong token", $pdo);
        }
    }
    else sendResponse($method, $formData, '', 401, "Unauthorized", $pdo);
