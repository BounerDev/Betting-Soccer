<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FreeKick Site</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="/public/assets/css/search.css">
    </head>
    <body id="page-top">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>  About
                    </a>
                </div>
            </div>
        </nav>
        <section class="page-section">
            <div class="container">
                <div class="row justify-content-center" align="center">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">who scored this goal?</div>
                            <div class="panel-body">
                                <image id="main_image" src="<?php echo base_url($img_url); ?>" style="width: 100%; height: auto; margin-bottom: 10px;" />
                                <div class="input-group" style="">
                                    <input type="text" class="form-control" placeholder="Search player." id="player_keyword">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" id="guess_btn" style="margin-right: 10px;">Guess</button>
                                        <button class="btn btn-default" type="button" id="skip_btn"> Skip</button>
                                    </span>
                                </div>
                                <div class="search-list" style="display:none; overflow-y: scroll; border: solid 1px #e4e4e4;">
                                    <ul class="list-group search-item-list" style="text-align: left;">
                                    </ul>
                                </div>
                                <ul class="list-group guess-item-list" style="margin-top: 15px; text-align: left;">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </section>
        <input type="hidden" value="<?php echo date('Y-m-d'); ?>" id="today">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="/public/assets/js/search.js"></script>
    </body>
</html>
