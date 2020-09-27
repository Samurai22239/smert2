// ваш секретный ключ
$secret = '6NepjAsGBBABBN7_Qy9yfzShcKmc70X2kXQyX1WO';
// однократное включение файла autoload.php (клиентская библиотека reCAPTCHA PHP)
require_once (dirname(__FILE__).'/recaptcha/autoload.php');
// если в массиве $_POST существует ключ g-recaptcha-response, то...
if (isset($_POST['g-recaptcha-response'])) {
  // создать экземпляр службы recaptcha, используя секретный ключ
  $recaptcha = new \ReCaptcha\ReCaptcha($secret);
  // получить результат проверки кода recaptcha
  $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
  // если результат положительный, то...
  if ($resp->isSuccess()){
    // действия, если код captcha прошёл проверку
    //...
  } else {
    // иначе передать ошибку
    $errors = $resp->getErrorCodes();
    $data['error-captcha']=$errors;
    $data['msg']='Код капчи не прошёл проверку на сервере';
    $data['result']='error';
  }

} else {
  //ошибка, не существует ассоциативный массив $_POST["send-message"]
  $data['result']='error';
}