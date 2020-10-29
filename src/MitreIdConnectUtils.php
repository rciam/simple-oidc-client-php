<?php

function getMetadata($issuer) {
    $url = $issuer . "/.well-known/openid-configuration/";
    return json_decode(http($url));;
}

function getCurlRefresh($clientId, $clientSecret = null, $scopes = null, $refreshToken, $tokenEndpoint) {
    $command =  "curl -X POST '${tokenEndpoint}' "
        . (!empty($clientSecret) ? "-u '${clientId}':'${clientSecret}' " : "")
        . "-d 'grant_type=refresh_token"
        . "&refresh_token=${refreshToken}"
        . (empty($clientSecret) ? "&client_id=${clientId}" : "")
        . ($scopes ? "&scope=" . implode("%20", $scopes) . "' " : "' ")
        . "| python -m json.tool;";

    return $command;
}

function getCurlUserInfo($accessToken, $userInfoEndpoint) {
    $command = "curl ${userInfoEndpoint} "
        . "-H 'Authorization: Bearer ${accessToken}' "
        . "-H 'Content-type: application/json' "
        . "| python -m json.tool;";

    return $command;
}

function getCurlIntrospect($clientId, $clientSecret, $accessToken, $introspectionEndpoint) {
    $command = "curl ${introspectionEndpoint} "
        . (!empty($clientSecret) ? "-u '${clientId}':'${clientSecret}' " : "")
        . "-H 'Content-Type: application/x-www-form-urlencoded' "
        . "-d 'token=${accessToken}' "
        . (empty($clientSecret) ? "-d 'client_id=${clientId}' " : "")
        . "| python -m json.tool;";

    return $command;
}

function getActiveRefreshTokens($accessToken, $issuer) {
    $url = $issuer . "api/tokens/refresh";
    $headers = [
        "Authorization: Bearer " . $accessToken,
    ];

    return json_decode(http($url, null, $headers));
}

function getRefreshTokenTable($client_id, $accessToken, $issuer) {
    $activeRefreshTokens = getActiveRefreshTokens($accessToken, $issuer);
    $index = 1;
    $table = "";

    foreach ($activeRefreshTokens as $refreshToken) {
        if ($client_id == $refreshToken->clientId) {
            $table = $table
                . "<tr>"
                . "<th scope=\"row\">${index}</th>"
                . "<td>"
                . "    <div class=\"token-value\">"
                . "        <input style=\"width:100%\" type=\"text\" readonly=\"\" style=\"cursor: text;\" class=\"token-full\" value=\"" . $refreshToken->value . "\">"
                . "    </div>"
                . "    <div>"
                . "        <span>Expire: " . date("Y/m/d", strtotime($refreshToken->expiration)) . "</span>"
                . "    </div>"
                . "</td>"
                . "<td>"
                . "    <button style=\"cursor: pointer; display: inline-block;\" class=\"btn btn-copy btn-primary\"><i class=\"icon-file\"></i> Copy</button>"
                . "    <form id=\"revokeRefreshToken\" style=\"display: inline-block;\"action=\"refreshtoken.php\" method=\"POST\">"
                . "        <input type=\"hidden\" name=\"action\" value=\"revoke\" />"
                . "        <input type=\"hidden\" name=\"token\" value=\"" . $refreshToken->value . "\" />"
                . "        <input class=\"btn btn-danger\" type=\"submit\" value=\"Revoke\" />"
                . "    </form>"
                . "</td>"
                . "</tr>";
            
            $index++;
        }
    }

    return $table;
}

function http($url, $post_body = null, $headers = [])
{
    // create a new cURL resource handle
    $ch = curl_init();

    // Determine whether this is a GET or POST
    if ($post_body != null) {
        // Alows to keep the POST method even after redirect
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);

        // Default content type is form encoded
        $content_type = 'application/x-www-form-urlencoded';

        // Determine if this is a JSON payload and add the appropriate content type
        if (is_object(json_decode($post_body))) {
            $content_type = 'application/json';
        }

        // Add POST-specific headers
        $headers[] = "Content-Type: {$content_type}";
        $headers[] = 'Content-Length: ' . strlen($post_body);
    }

    // If we set some heaers include them
    if (count($headers) > 0) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, $url);

    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // Allows to follow redirect
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Download the given URL, and return output
    $output = curl_exec($ch);

    // HTTP Response code from server may be required from subclass
    // $info = curl_getinfo($ch);
    // $responseCode = $info['http_code'];

    // Close the cURL resource, and free system resources
    curl_close($ch);

    return $output;
}