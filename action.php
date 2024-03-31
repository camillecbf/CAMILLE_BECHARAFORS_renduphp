<?php

require_once 'config.php';

try {
    if($_SERVER ['REQUEST_METHOD'] === 'POST') {

        if(isset($_POST['message']) && !empty($_POST['message'])) {
            $message = $_POST['message'];
            $userId = null;

            if(isset($_POST['user']) && !empty($_POST['user'])) {
                $user = $_POST ['user'];

                $request = $database->prepare (
                    'SELECT id FROM users WHERE pseudo = :pseudo'
                );
                $request->execute ([
                    'pseudo' => $user
                ]);

                $userId = $request ->fetchColumn ();

            }

            if ($userId) {

                $request = $database ->prepare (
                    'INSERT INTO tweets (message, author_id) VALUES (:message, :author_id)'
                );
                $request ->execute ([
                    'message' => $message,
                    'author_id' => $userId
                ]);
                header('Location: index.php?user=' . $user);

            } else {
                $request = $database ->prepare (
                    'INSERT INTO tweets (message) VALUES (:message)'
                );
                $request ->execute ([
                    'message' => $message,
                ]);
                header('Location: index.php');
   
            }
        } else {
            die ('MESSAGE IS REQUIRED');
        }

        exit();
    }

} catch (PDOException $e) {
    die("COULD NOT CONNECT TO THE DATABASE $dbname: " . $e ->getMessage());
};

