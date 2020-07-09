<?php
    if (isset($_COOKIE['token'])) {
        if (check_token($_COOKIE['token'], $pdo)) {

            if ($method === "GET" && isset($formData['id'])) {
                $news = get_news_by_id($formData['id'], $pdo);
                $result = array();
                if (isset($news['message'])){
                    sendResponse($method, $formData, '',404, $news['message'], $pdo);
                } else {
                    foreach ($news as $key => $value) {
                        $result[$key] = $value;
                    }
                    unset ($result['queryString']);
                    sendResponse($method, $formData, $result, 200, '', $pdo);
                }
            } elseif ($method === "GET" && !isset($formData['id'])) {
                $news = get_news($formData['listNumber'], $formData['rubricUri'], $formData['tags'], $pdo);
                $result = array();
                if (isset($news['message'])){
                    sendResponse($method, $formData, '',404, $news['message'], $pdo);
                } else {
                    foreach ($news as $key => $value) {
                        $result[$key] = $value;
                    }
                    unset ($result['queryString']);
                    sendResponse($method, $formData, $result, 200, '', $pdo);
                }
            } elseif ($method === "POST") {
                $news = add_news($formData, $pdo);
                if (isset($news['message'])){
                    sendResponse($method, $formData, '',404, $news['message'], $pdo);
                } else {
                    sendResponse($method, $formData, $news,200, '', $pdo);
                }
            } elseif ($method === "PUT") {
                $news = update_news($_GET['id'], $formData, $pdo);
                if (isset($news['message'])){
                    sendResponse($method, $formData, '',404, $news['message'], $pdo);
                } else {
                    sendResponse($method, $formData, $news,200, '', $pdo);
                }
            } elseif ($method === "DELETE") {
                $news = delete_news($_GET['id'], $pdo);
                if (isset($news['message'])){
                    sendResponse($method, $formData, '',404, $news['message'], $pdo);
                } else {
                    sendResponse($method, $formData, $news,200, '', $pdo);
                }
            } else sendResponse($method, $formData, '', 400, "Bad request", $pdo);
        } else {
            sendResponse($method, $formData, '', 400, "Wrong token", $pdo);
        }
    }
    else sendResponse($method, $formData, '', 401, "Unauthorized", $pdo);
