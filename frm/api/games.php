<?php
    $curl = curl_init();
    $params = array('api_key' => 'moby_Ivjf8fphPEz3gLn9DVIcRsvNYgE');
    $params['limit'] = '5';
    $params['format'] = $format;
    $params['title'] = $title;
    curl_setopt($curl, CURLOPT_URL, 'https://games.eduardojaramillo.click/v1/games?'.http_build_query($params));
    header('Content-Type: application/json; charset=utf-8');
    print_r(curl_exec($curl));

    //$file = fopen('cache/'.$values.'.json', 'w');


    curl_close($curl);