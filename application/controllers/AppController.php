<?php

/**
 * Main Application controller
 */
class AppController
{
    /**
     * Відображає стартову сторінку на якій користувач задає к-сть слів
     * які хоче повчити за один сеанс роботи з програмою
     */
    public function start()
    {
        require_once APP_VIEWS_PATH.'/start.php';
    }
    
    /**
     * Етап ініціалізації.
     * 
     *  1) зчитуємо набір слів з файла
     *  2) записуємо потрібну к-сть в сесію
     *  3) перенаправляємо коирстувача на сторінку вивчення слів
     *
     * @return void
     */
    public function init()
    {
        // @todo: винести в модель (або як мініму в окрему ф-цію)
        $words = json_decode(file_get_contents(WORDS_FILE_PATH), true);
        shuffle($words); // перемішуємо масив щоб не було повторень
        
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
            // @todo можна зробити окремий шаблон в якому відображати помилки
            $msg = 'Не вдалося отримати масив із словами';
            error_log($msg) && die($msg);
        }
    }
    
    /**
     * Етап вивчення слів користувачем.
     *
     * 1) взяти наступне слово з сесії
     * 2) записати його в інший масив (для наступного рівня)
     * 3) відобразити це слово на сторінці
     * 
     */
    public function learning()
    {
        $wordLeft = count($_SESSION['game']['learning']);
        if ($wordLeft) {
            $nextWord = array_shift($_SESSION['game']['learning']);
            $_SESSION['game']['learned'][] = $nextWord;
            require_once APP_VIEWS_PATH.'/learning.php';
        } else {
            // якщо слів для вивчення не залишилося, перенаправляємо користув
            // на наступий level
            unset($_SESSION['game']['learning']);
            header('Location: /index.php?action=answering');
            exit;
        }
    }
    
    /**
     * Етап написання користувачем перекладу для УЖЕ вивчених слів.
     *
     * @return void
     */
    public function answering()
    {
        // handler для натиснутої кнопки в html-формі
        if (isset($_POST['btnNextAnswer'])) {
            // отримали переклад користувача
            $user_translate = $_POST['user_translate'];
            
            // слово для якого користувач пише переклад
            // отримали слово українською, щоб викор. для наступного
            $key = $_POST['key'];

            // зберегли переклад для слова користувача в сесію
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
        } else {
            unset($_SESSION['game']['learning']);
            header('Location: /index.php?action=score');
            exit;
        }
    }
    
    /**
     * Відображення результатів користувача
     *
     * @return void
     */
    public function score() {
        $scrore = [];
        foreach($_SESSION['game']['answering'] as $card) {
            // спеціально привожу слова до нижнього рівня 
            // (бо лінивий і не хочу користув. вбуд. функцією)
            $word_en = strtolower( $card['en']);
            $user_translate_word = strtolower( $card['user_translate']);
            
            // формую фінальний масив для рендерингу його на шаблоні (view)
            $scrore[] = [
                'en' => $word_en,
                'ua' => $card['ua'],
                'user_translated' => $user_translate_word,
                'is_correct' => (($word_en == $user_translate_word)? 'correct':'incorrect'),
            ];
        }

        // очищаю сесію із відповідями користувача.
        unset($_SESSION['game']['answering']);
        
        require_once APP_VIEWS_PATH.'/score.php';
    }
}