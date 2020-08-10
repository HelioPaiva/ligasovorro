<?php
require_once('config.php');
require_once(DBAPI);
/*
 header('Content-type: application/json');

    $email = "heliopaiva16@gmail.com"; // email da sua conta no cartola fc
    $password = "H&lio161181"; // senha da sua conta no cartola fc
    $serviceId = 4728;

    $url = 'https://login.globo.com/api/authentication';

    $jsonAuth = array(
      'captcha' => '',
      'payload' => array(
        'email' => $email,
        'password' => $password,
        'serviceId' => $serviceId
      )
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonAuth));
    $result = curl_exec($ch);

    if ($result === FALSE) {
      die(curl_error($ch));
    }
    curl_close($ch);

    $parseJson = json_decode($result, TRUE);
    var_dump($parseJson);

    if($parseJson['id'] == "Authenticated"){            
        $session = array('glbId' => $parseJson['glbId']);
        if($this->session->set_userdata($session)){
            return true;
        }
    }else{            
        redirect(base_url('fail'));
    }      
    

*/

    auth_time("16fb036f327d5eb17085104287885045b6e444a3772674a36304745754d6f376632795a4e734f63316947576874477572666f6965332d33654c694972684852417874426c4b3853363570304362317262483564413342457264385a4a716658657341506d39513d3d3a303a68656c696f706169766131362e323031372e31");

    function auth_time($glbId){
        $curl = curl_init('https://api.cartolafc.globo.com/auth/liga/sovorro');
       // $curl = curl_init('https://api.cartolafc.globo.com/auth/stats/historico');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-GLB-Token:'.$glbId));
        $jsonAuthTime = curl_exec($curl);
        $query = json_decode($jsonAuthTime,true);

        echo '<pre>';
        print_r($query);

        

        for ($i=0; $i < 36 ; $i++) {
            $sql = "insert into pontuacao(rodada,time,pontos) values (1,'".$query['times'][$i]['nome']."','".number_format($query['times'][$i]['pontos']['rodada'],2,'.',',')."')";
            echo $sql.'</br>';
            add($sql);
        }

        echo 'importando';
    }