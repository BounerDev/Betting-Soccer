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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="/public/assets/css/admin.css">
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
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Schedule List
                                <button class="btn btn-success btn-sm" style="float: right; margin-top: -5px;" onclick="add_schedule();">New</button>
                            </div>
                            <div class="panel-body">
                                <table id="schedule_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Player Name</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $index = 1;
                                            foreach($schedule_list as $schedule)
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $index; ?></td>
                                            <td><?php echo $schedule['date']; ?></td>
                                            <td><?php echo $schedule['pname']; ?></td>
                                            <td><?php echo $schedule['create_date']; ?></td>
                                            <td><?php echo $schedule['update_date']; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" onclick="edit_schedule(<?php echo $schedule['sid']; ?>);">Edit</button>
                                                <button class="btn btn-danger btn-sm" onclick="delete_schedule(<?php echo $schedule['sid']; ?>);">Delete</button>
                                            </td>
                                        </tr>
                                        <?php
                                                $index ++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="schedule_modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Schedule</h4>
                </div>
                <div class="modal-body">
                    <form id="schedule_form" action="/index.php/admin/save" enctype="multipart/form-data">
                        <input type="hidden" id="schedule_id" name="schedule_id" value="">
                        <div class="form-group">
                            <label for="datetimepicker3">Select date</label>
                            <div class='input-group date' id='datetimepicker3'>
                                <input type='text' id="date" name="date" class="form-control" placeholder="Enter date"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label for="player_name">Player Name</label>
                            <input type="text" class="form-control" id="player_name" name="player_name" placeholder="Enter player name">
                        </div>
                        <div class="search-list" style="display:none; overflow-y: scroll; border: solid 1px #e4e4e4;">
                            <ul class="list-group search-item-list" style="text-align: left;">
                            </ul>
                        </div>
                        <label class="form-label" for="customFile" style="margin-top: 15px;">Images</label>
                        <div class="form-group">
                            <div class="col-sm-4 imgUp">
                                <img src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg" class="imagePreview" id="imagePreview1" />
                                <label class="btn btn-upload btn-primary">
                                    Upload (Image 1)<input type="file" class="uploadFile img" id="image1" name="image1_input" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                </label>
                            </div>
                            <div class="col-sm-4 imgUp">
                                <img src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg" class="imagePreview" id="imagePreview2" />
                                <label class="btn btn-upload btn-primary">
                                    Upload (Image 2)<input type="file" class="uploadFile img" id="image2" name="image2_input" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                </label>
                            </div>
                            <div class="col-sm-4 imgUp">
                                <img src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg" class="imagePreview" id="imagePreview3" />
                                <label class="btn btn-upload btn-primary">
                                    Upload (Image 3)<input type="file" class="uploadFile img" id="image3" name="image3_input" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                </label>
                            </div>
                            <div class="col-sm-4 imgUp">
                                <img src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg" class="imagePreview" id="imagePreview4" />
                                <label class="btn btn-upload btn-primary">
                                    Upload (Image 4)<input type="file" class="uploadFile img" id="image4" name="image4_input" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                </label>
                            </div>
                            <div class="col-sm-4 imgUp">
                                <img src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg" class="imagePreview" id="imagePreview5" />
                                <label class="btn btn-upload btn-primary">
                                    Upload (Image 5)<input type="file" class="uploadFile img" id="image5" name="image5_input" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                </label>
                            </div>
                            <div class="col-sm-4 imgUp">
                                <img src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg" class="imagePreview" id="imageResultPreview" />
                                <label class="btn btn-upload btn-danger">
                                    Upload (Winning)<input type="file" class="uploadFile img" id="image_result" name="image_result_input" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="youtube_path">Youtube Url</label>
                            <input type="text" class="form-control" id="youtube_path" name="youtube_path" placeholder="Enter Youtube url">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btn_save">Save</button>
                </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://malsup.github.io/jquery.form.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/public/assets/js/admin.js"></script>
    </body>
</html>
