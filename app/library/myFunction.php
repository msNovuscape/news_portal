<?php


namespace App\library;


class myFunction
{

    public static function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public static function setEmail()
    {
        $mail=Settings::getEmails();

        if($mail->protocal == 'smtp'){
            $config = array(
                'driver' => $mail->protocal,
                'host' => $mail->host_name,
                'port' => $mail->smtp_port,
                'from' => array('address' => $mail->parameter, 'name' => Settings::getSettings()->name),
                'encryption' => $mail->encription,
                'username' => $mail->username,
                'password' => $mail->password,
            );
            \Config::set('mail',$config);
        } elseif ($mail->protocal == 'mail') {
            $config = array(
                'driver' => $mail->protocal,

            );
            \Config::set('mail',$config);
        } elseif ($mail->protocal == 'mailgun') {
            $config = array(
                'driver' => $mail->protocal,


            );
            \Config::set('mail',$config);
            $mailgun = array('domain' => $mail->host_name,  'secret' => $mail->encription, );
            $services = array('mailgun' => $mailgun, );
            \Config::set('services', $services);
        }
        elseif ($mail->protocal == 'mandrill') {
            $config = array(
                'driver' => $mail->protocal,

            );
            \Config::set('mail',$config);
            $mailgun = array('secret' => $mail->encription, );
            $services = array('mandrill' => $mailgun, );
            \Config::set('services', $services);
        }
    }

    public static function removeSpace($value)
    {
        $string = str_replace(' ', '-', $value); // Replaces all spaces with hyphens.
        return $string; // Removes special chars.
    }
    public static function getWeather()
    {
        $cityid = 1283240;
        $app_id = '40023acdd74e45e4114e32f20da757ad';
        $url = 'http://api.openweathermap.org/data/2.5/forecast?id='.$cityid.'&appid='.$app_id;

        $curl_connection =  curl_init($url);

        //set options
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

        //perform our request
        $result = curl_exec($curl_connection);
        curl_close($curl_connection);
        $data = json_decode($result);
        return $data;
    }

}
