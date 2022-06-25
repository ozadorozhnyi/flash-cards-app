<?php 

$action = 'start';
if(isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
    case 'start':
        require_once APP_VIEWS_PATH.'/start.php';
        break;

    case 'init':
        $words = json_decode(file_get_contents(WORDS_FILE_PATH), true);
        shuffle($words);
        if (count($words)) {
            for ($i = 0; $i < count($words); $i++) { 
                if($i == $_POST['word_count']) {
                    break;
                }
                $_SESSION['game']['learning'][] = $words[$i];
            }

            header('Location: /index.php?action=learning');
            exit;
        } else {
            die('Не вдалося отримати масив із словами');
        }
        
    case 'learning':
        $wordLeft = count($_SESSION['game']['learning']);
        if ($wordLeft) {
            $nextWord = array_shift($_SESSION['game']['learning']);
            $_SESSION['game']['learned'][] = $nextWord;
            require_once APP_VIEWS_PATH.'/learning.php';
            break;
        } else {
            unset($_SESSION['game']['learning']);
            header('Location: /index.php?action=answering');
            exit;
        }

    case 'answering':
        
        if (isset($_POST['btnNextAnswer'])) {
            $user_translate = $_POST['user_translate']; // переклад користувача
            $key = $_POST['key'];                       // слово для якого користувач пише переклад
            $_SESSION['game']['answering'][$key]['user_translate'] = $user_translate;
        }

        $wordAnsweredLeft = count($_SESSION['game']['learned']);
        if ($wordAnsweredLeft) {
            $nextWord = array_shift($_SESSION['game']['learned']);
            $_SESSION['game']['answering'][$nextWord['ua']] = [
                'en' => $nextWord['en'],
                'ua' => $nextWord['ua'],
            ];
            require_once APP_VIEWS_PATH.'/answering.php';
            break;
        } else {
            unset($_SESSION['game']['learning']);
            header('Location: /index.php?action=score');
            exit;
        }
        
    case 'score':
        $scrore = [];
        foreach($_SESSION['game']['answering'] as $card) {
            $word_en = strtolower( $card['en']);
            $user_translate_word = strtolower( $card['user_translate']);
            $scrore[] = [
                'en' => $word_en,
                'ua' => $card['ua'],
                'user_translated' => $user_translate_word,
                'is_correct' => (($word_en == $user_translate_word)? 'correct':'incorrect'),
            ];
        }

        unset($_SESSION['game']['answering']);
        require_once APP_VIEWS_PATH.'/score.php';
        break;
}
