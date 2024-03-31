<?php

require_once 'config.php';

try {
    if($_SERVER ['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['delete']) && !empty($_POST['delete'])) {
            $deleteTweet = $_POST['delete'];
            $request = $database->prepare (
                    'SELECT author_id FROM tweets WHERE `message` = :deleteTweet'
                );

                $request->execute ([
                    ':deleteTweet' => $deleteTweet
                ]);

                $authorId = $request ->fetchColumn ();
                
                    $data = [
                    'deleteTweet' => $_POST['delete']
                    ];
                    $delete = $database->prepare
                        ('DELETE FROM tweets WHERE `message` = :deleteTweet');
                        $delete->execute($data);

                        header('Location: index.php?user=' . $user);
                        exit();
                    
            }else {
                die ('FAIL');
            }
        }

    } catch (PDOException $e) {
    die('Erreur: ' . $e ->getMessage());    
}