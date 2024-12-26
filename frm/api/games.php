<?php
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $params = array('api_key' => 'moby_Ivjf8fphPEz3gLn9DVIcRsvNYgE');
    $params['limit'] = '5';
    $params['format'] = $format;
    $params['title'] = $title;
    curl_setopt($curl, CURLOPT_URL, 'https://games.eduardojaramillo.click/v1/games?'.http_build_query($params));
    header('Content-Type: application/json; charset=utf-8');
    $json = curl_exec($curl);
    print_r($json);
    curl_close($curl);

    //http://localhost/?page=api&endpoint=games&format=brief&title=