<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            src: url({{ asset('fonts/Roboto-regular.ttf') }});
        }
        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            src: url({{ asset('fonts/Roboto-regular.ttf') }});
        }
        body {
            font-family: 'Roboto';
        }

    </style>
</head>
<body style="font-family:Roboto">
        @foreach($giftCampaigns as $giftCampaign) 
            
            <h1>{{ $giftCampaign->name}}</h1>
            
            <ul>
            @foreach($giftCampaign->subscribers as $users)
                <li><h3>{{ $users->name }}</h3></li>
                <li>{{ $users->address }}</li>
            @endforeach
            </ul>
        
        @endforeach    
</body>
</html>