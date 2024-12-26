<?php
    $curl = curl_init();
    $params = array('api_key' => 'moby_Ivjf8fphPEz3gLn9DVIcRsvNYgE');
    $params['format'] = 'brief';
    $params['limit'] = '5';
    curl_setopt($curl, CURLOPT_URL, 'https://games.eduardojaramillo.click/v1/games?'.http_build_query($params));
    print_r(curl_exec($curl));