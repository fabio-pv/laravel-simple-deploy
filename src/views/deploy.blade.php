<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Deploy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        @import url(http://fonts.googleapis.com/css?family=Roboto);

        body {
            margin: 0;
            font-family: Roboto, Arial, sans-serif;
        }

        .shadow-default {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .shadow-default-2 {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        }

        @media only screen and (max-width: 600px) {
            .super-content-main {
                padding: 0;
            }
        }

        @media only screen and (min-width: 600px) {
            .super-content-main {
                padding: 15%;
            }
        }

        .content-main {
            position: relative;
            width: 100%;
            background: #00BCD4;
            padding-bottom: 100px;
            border-radius: 20px;
            overflow: hidden;
        }

        .content-header {
            width: 100%;
            background: #673AB7;
            padding-top: 50px;
            text-align: center;
        }

        .content-information-main {
            position: relative;
            width: 100%;
            padding-top: 20px;
        }

        .content-information {
            position: relative;
            width: 80%;
            margin-left: 100px;
            margin-right: 100px;
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin: auto;
        }

        .content-information h6 {
            margin: 0 0 15px 0;
            font-size: 15px;
            color: #312727;
        }

        .content-information p {
            color: #312727;
            font-size: 10px;
            text-align: left;
            margin: 0;
        }

        .content-information .date-commit {
            color: #473b3b;
            font-size: 9px;
            text-align: left;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .title {
            text-align: center;
            margin: 0 0 5px 0;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        .circle-dashboard-content {
            width: 120px;
            height: 120px;
            border-style: solid;
            border-color: #00BCD4;
            border-radius: 50%;
        }

        .circle-dashboard-content hr {
            margin-left: 15px;
            margin-right: 15px;
            margin-top: 16px;
        }

        .circle-dashboard-content h5 {
            color: white;
            font-size: 18px;
            margin: 18px 0 0 0;
            font-weight: bold;
        }

        .circle-dashboard-content h6 {
            color: white;
            font-size: 15px;
            margin: 15px 0 0 0;
        }

        .link {
            text-align: center;
            margin: 0;
            color: #c9c9c9;
            text-decoration: none;
            font-size: 12px;
        }

        .second-time {
            font-size: 14px;
        }

    </style>
</head>
<body>
<div class="super-content-main">
    <div class="content-main">
        <div class="content-header">
            <h5 class="title">{{ $data['repository_name'] }}</h5>
            <a class="link" href="{{ $data['html_url'] }}">{{ $data['html_url'] }}</a>
            <br/><br/><br/>
            <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">
                        <div class="circle-dashboard-content">
                            <h5>{{ $data['branch'] }}</h5>
                            <hr/>
                            <h6>Branch</h6>
                        </div>
                    </td>
                    <td align="center">
                        <div class="circle-dashboard-content">
                            <h5>{{ $data['pusher_name'] }}</h5>
                            <hr/>
                            <h6>By</h6>
                        </div>
                    </td>
                </tr>
            </table>
            <br/>
            <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">
                        <div class="circle-dashboard-content">
                            <h5>{{ $data['time_total'] }}<span class="second-time">s</span></h5>
                            <hr/>
                            <h6>Duração</h6>
                        </div>
                    </td>
                    <td align="center">
                        <div class="circle-dashboard-content">
                            <h5>{{ count($data['commits']) }}</h5>
                            <hr/>
                            <h6>Commits</h6>
                        </div>
                    </td>
                </tr>
            </table>
            <br/>
            <br/>
        </div>
        <br/>
        <br/>
        <div class="content-information-main">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">
                        <div class="content-information shadow-default">
                            <h6>Git</h6>
                            @foreach($data['commits'] as $index => $commit)
                                <p>{{ $commit['message'] }}</p>
                                <p class="date-commit">{{ \Carbon\Carbon::parse($commit['timestamp'])->format('d/m/Y H:i:s') }}</p>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        @foreach($data['posts'] as $index => $post)
            <div class="content-information-main">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <div class="content-information shadow-default">
                                <h6>{{ $index }}</h6>
                                @foreach($post as $output)
                                    <p>{{ $output }}</p>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
</div>
<br/><br/>
</body>
</html>
