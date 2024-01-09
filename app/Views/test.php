<?php

// if post request is sent then  execute the code
if (isset($_GET['text'])) {
    // get the text from the form
    $text = $_GET['text'];
    // call the function
    textToSpeech($text);
}

function textToSpeech(string $text)
{
    $url = "https://api.elevenlabs.io/v1/text-to-speech/21m00Tcm4TlvDq8ikWAM?optimize_streaming_latency=1";
    $headers = [
        "Accept: audio/mpeg",
        "Content-Type: application/json",
        "xi-api-key: 10c482a0c044888c51683ba65de7014b"
    ];
    $data = [
        "text" => $text,
        "model_id" => "eleven_monolingual_v1",
        "voice_settings" => [
            "stability" => 0.5,
            "similarity_boost" => 0.5
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        file_put_contents('output.mp3', $response);
    }

    curl_close($ch);
}

?>

<form action="" method="get">
    <textarea name="text" id="" cols="30" rows="10"></textarea>
    <button type="submit">Submit</button>
</form>

<!--Download the audio-->
<a href="output.mp3" download>Download</a>

<audio controls>
    <source src="output.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

