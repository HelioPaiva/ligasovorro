<?php

 header('Content-type: application/json');
/*
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

auth_time("1cfddcc478404aee4a1e2113b93257b9947684a616f396f416838626d365571394636593135474f6a687142656f68676b7853665977356370417631355169586171366f466e32656e5f6252634f4445564f476b5f4830456d35586e7576646c46664e4a5778773d3d3a303a68656c696f706169766131362e323031372e31");

function auth_time($glbId){
    //$curl = curl_init('https://api.cartolafc.globo.com/auth/time');
    $curl = curl_init('https://api.cartolafc.globo.com/auth/liga/sovorro');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-GLB-Token:'.$glbId));
    $jsonAuthTime = curl_exec($curl);
    $ArrayAuthTime = json_decode($jsonAuthTime);
    var_dump($ArrayAuthTime);
    //return $ArrayAuthTime;
}