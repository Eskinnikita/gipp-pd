<?php
// функции работы с логами
  function add_log($method, $result, $requestData, $httpCode, $pdo){
     $date = date('l jS \of F Y h:i:s A');
     $userAgent = $_SERVER['HTTP_USER_AGENT'];
     $uri = $_SERVER['REQUEST_URI'];
     $result = json_encode($result, JSON_UNESCAPED_UNICODE);
     $requestData = json_encode($requestData, JSON_UNESCAPED_UNICODE);
     $stmt = $pdo->prepare('INSERT INTO log(`method`,`uri`,`requestData`,`responseData`,`httpCode`,`userAgent`,`date`)
                                     VALUES (:method, :uri, :requestData, :responseData, :httpCode, :userAgent, :date)');
     $stmt->bindParam(':responseData', $result);
     $stmt->bindParam(':method', $method);
     $stmt->bindParam(':uri', $uri);
     $stmt->bindParam(':requestData', $requestData);
     $stmt->bindParam(':userAgent', $userAgent);
     $stmt->bindParam(':date', $date);
     $stmt->bindParam(':httpCode', $httpCode);
      try {
          $stmt -> execute();
      } catch (PDOException $e) {
          return array("message"=>$e);
      }
     return 1;
  }

 function get_logs($pdo){
     $stmt = $pdo -> prepare('SELECT * FROM log WHERE 1');
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return $stmt->fetchAll(PDO::FETCH_OBJ);
 }

 function get_log_by_id($id, $pdo){
      $stmt = $pdo -> prepare('SELECT * FROM log WHERE id=:id');
      $stmt -> bindParam(":id", $id);
      try {
          $stmt -> execute();
      } catch (PDOException $e) {
          return array("message"=>$e);
      }
      return $stmt -> fetchAll(PDO::FETCH_OBJ);
 }

 function logout($token, $pdo){
      $stmt = $pdo -> prepare('DELETE FROM auth WHERE token=:token');
      $stmt -> bindParam('token', $token);
      setcookie('token', '', time()-3600);

      try {
          $stmt -> execute();
      } catch (PDOException $e) {
          return array("message"=>$e);
      }
      return 1;
 }
 //Проверка пароля///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function check_pass($login, $pdo){
     $stmt = $pdo->prepare("SELECT pass FROM user WHERE `email` = :login");
     $stmt -> bindParam(':login', $login);
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return $stmt->fetchColumn();
 }
//Создание токена////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function create_token($login, $pdo){
    $token = md5(microtime().date('y,m,d'));
    $stmt = $pdo -> prepare("INSERT INTO auth(`userId`, `token`, `role`) VALUES ((SELECT id FROM user WHERE email=?), ?, (SELECT `role` FROM user WHERE `email`=?))");
    $stmt -> bindValue(1, $login);
    $stmt -> bindValue(2, $token);
    $stmt -> bindValue(3, $login);
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
//    setcookie('role', $role, time()+60*60*20*30);
    setcookie('token', $token, time()+60*60*24*30);
     return true;
 }
//Проверка токена////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function check_token($token, $pdo){
     $stmt = $pdo -> prepare("SELECT count(*) FROM auth WHERE `token` = :token");
     $stmt -> bindParam(':token', $token);
     $stmt -> execute();
     $result = $stmt->fetchColumn();
     if ($result){
        return 1;
     } else {
         return 0;
     }
 }
//Функция входа/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function check_login($login, $post_pass, $pdo){
     $pass = check_pass($login, $pdo);
     $hashPass = md5($post_pass.'chikunovrulez');
     if ($pass == $hashPass){
         create_token($_POST['login'], $pdo);
     }
 }
/* CRUD для USER*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 function add_user($userData, $pdo){
     $pass = md5($userData['pass'].'chikunovrulez');
     $stmt = $pdo->prepare("INSERT user SET 
                            fName=:fName,
                            mName=:mName,
                            lName=:lName,
                            pass=:pass,
                            email=:email,
                            role=:role");
     $stmt->bindParam(':fName', $userData['fName']);
     $stmt->bindParam(':mName', $userData['mName']);
     $stmt->bindParam(':lName', $userData['lName']);
     $stmt->bindParam(':pass', $pass);
     $stmt->bindParam(':email', $userData['email']);
     $stmt->bindParam(':role', $userData['role']);
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return true;
 }

 function get_user_by_id($id, $pdo){
     $stmt = $pdo->prepare("SELECT * FROM user WHERE id=:id");
     $stmt->bindParam(':id', $id);
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return $stmt->fetch(PDO::FETCH_LAZY);
 }

 function update_user($id, $userData, $pdo){
     if (isset($userData['pass'])){
         $userData['pass'] = md5($userData['pass'].'chikunovrulez');
     }
     $userValues = array("mName", "fName", "lName", "photo", "email", "pass", "role");

     $queryString = prepare_query_string_for_update($userValues, $userData);
     if ($queryString=='error'){
         return array('message'=>"unknown parameters");
     }
     $queryString = "UPDATE user SET $queryString WHERE id=:id";
     $stmt = $pdo->prepare($queryString);
     foreach ($userData as $key=>$value){
         if (in_array($key, $userValues)){
            $stmt->bindParam(":$key", $value);
         }
     }
     $stmt->bindParam(':id', $id);
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return 1;
 }

function prepare_query_string_for_update($columns, $formData){
    $query = array();
    foreach ($formData as $key=>$value){
        if (in_array($key, $columns)){
            array_push($query, "$key=:$key");
        }
    }
    if (count($query)>1){
        $queryString = join(', ', $query);
    } elseif (count($query)==1){
        $queryString = $query[0];
    } else {
        return  'error';
    }
    return $queryString;
}

 function delete_user($id, $pdo){
     $stmt = $pdo->prepare("DELETE FROM user WHERE id=:id");
     $stmt->bindParam(':id', $id);
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return 1;
 }

 //CRUD для статей//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function add_news($newsData, $pdo){
     $date = date('m.d.y G:i');
     $queryString = "INSERT news SET title=:title, description=:description, text=:text, date=:date, idAuthor=:idAuthor, isDraft=:isDraft, rubricUri=:rubricUri, tags=:tags";
     $stmt = $pdo->prepare($queryString);
     $stmt->bindParam(':title', $newsData['title']);
     $stmt->bindParam(':description', $newsData['description']);
     $stmt->bindParam(':text', $newsData['text']);
     $stmt->bindParam(':date', $date);
     $stmt->bindParam(':idAuthor', $newsData['idAuthor']);
     $stmt->bindParam(':isDraft', $newsData['isDraft']);
     $stmt->bindParam(':rubricUri', $newsData['rubricUri']);
     $stmt->bindParam(':tags', $newsData['tags']);
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return 1;
 }

 function get_news_by_id($id, $pdo){
     $stmt = $pdo -> prepare("SELECT * FROM news WHERE id=:id");
     $stmt -> bindParam(':id', $id);
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return $stmt->fetch(PDO::FETCH_LAZY);
 }

 function prepare_news_query_string($queryString, $rubric, $tag, $pdo){
     if (!empty($rubric)) {
         if ($rubric != '') {
             $queryString = join('WHERE rubricUri=:rubricUri', $queryString);
             $stmt = $pdo->prepare($queryString);
             $stmt -> bindParam(':rubricUri', $rubric);
         } elseif ($tag!=''){
             $queryString = join('WHERE tags  LIKE :tag', $queryString);
             $stmt = $pdo->prepare($queryString);
             $stmt -> bindParam(':tag', $tag);
         } else {
             $queryString = join('', $queryString);
             $stmt = $pdo -> prepare($queryString);
         }
     }
     return $stmt;
 }

 function get_news($n, $rubric, $tag, $pdo){
     $queryString[0] = "SELECT * FROM news ";
     if ($n == 1) {
         $queryString[1] = " LIMIT 20";
         $stmt = prepare_news_query_string($queryString, $rubric, $tag, $pdo);
     } elseif ($n>1){
         $n = ($n-1)*20;
         $queryString[1] = " LIMIT $n, 20";
         $stmt = prepare_news_query_string($queryString, $rubric, $tag, $pdo);
     } else return array("message"=>"Wrong number of page");
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return $stmt -> fetchAll(PDO::FETCH_OBJ);
 }

 function update_news($id, $newsData, $pdo){
     $newsColumn = array("title", "description", "text", "isDraft");
     $updateDate = date('m.d.y G:i');
     $queryString = prepare_query_string_for_update($newsColumn, $newsData);

     $queryString = "UPDATE news SET $queryString, updateDate=:updateDate WHERE id=:id";
     $stmt = $pdo->prepare($queryString);
     foreach ($newsData as $key=>$value){
         if (in_array($key, $newsColumn)){
             $stmt->bindParam(":$key", $value);
         }
     }
     $stmt->bindParam(':id', $id);
     $stmt->bindParam(':updateDate', $updateDate);
     try {
         $stmt -> execute();
     } catch (PDOException $e) {
         return array("message"=>$e);
     }
     return 1;

 }

 function delete_news($id, $pdo){
     $stmt = $pdo->prepare("DELETE FROM news WHERE id=?");
     try {
         $stmt -> execute($id);
     } catch (PDOException $e) {
         return array("message"=>$e);
     }     return 1;
 }
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
