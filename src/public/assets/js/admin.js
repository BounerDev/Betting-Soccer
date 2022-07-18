function add_schedule()
{
    $("#schedule_id").val("");
    $("#player_name").val("");
    $("#youtube_path").val("");
    $("#date").val("");
    $('.imagePreview').css("background-image","url('')");
    $(".modal-title").html("Add Schedule");
    $("#schedule_modal").modal('show');
}

function edit_schedule(sid)
{
    $.ajax({
        url: "/index.php/admin/detail",
        type: "POST",
        data: "schedule_id=" + sid,
        success: function(res) {
            var result = JSON.parse(res);
            $("#schedule_id").val(result.id);
            $("#player_name").val(result.pname);
            $("#youtube_path").val(result.youtube_path);
            $("#date").val(result.date);

            $("#imagePreview1").attr("src", result.image1);
            $("#imagePreview2").attr("src", result.image2);
            $("#imagePreview3").attr("src", result.image3);
            $("#imagePreview4").attr("src", result.image4);
            $("#imagePreview5").attr("src", result.image5);
            $("#imageResultPreview").attr("src", result.image_result);

            $(".modal-title").html("Edit Schedule");
            $("#schedule_modal").modal('show');
        },
        error: function(res) {
            alert("Server Error");
        }
    });

}

function delete_schedule(sid)
{   
    if (confirm("Do you want to delete really?") == true) {

        $.ajax({
            url: "/index.php/admin/delete",
            type: "POST",
            data: "schedule_id=" + sid,
            success: function(res) {
                if (res == "success") {
                    alert("Delete a schedule successfully!");
                    location.replace('/index.php/admin');
                } else if (res == "duplicate") {
                    alert("Schedule is already existed!");
                    return;
                }
            },
            error: function(res) {
                alert("Server Error");
            }
        });

    } else {
        return;
    }
    
}

function select_search_item(search_item) 
{
    $("#player_name").val(search_item);
    $(".search-item-list").html("");
    $(".search-list").css('display', 'none');
}

$(document).ready(function() {

    $('#schedule_table').DataTable();
    $('#datetimepicker3').datetimepicker({
        viewMode: 'days',
        format: 'YYYY-MM-DD'
    });

    $("#player_name").keyup(function(event) {

        if ($("#player_name").val() == "") {
            $(".search-item-list").html("");
            $(".search-list").css('display', 'none');
            return;
        }
        
        if ((event.keyCode >= 65 && event.keyCode <= 90) || event.keyCode == 8 || event.keyCode == 13) {
            $.ajax({
                url: "https://eurogols.eu/api/search/" + $("#player_name").val(),
                type: "GET",
                success: function(res) {
                    var html = "";
                    for(var i = 0; i < res.length; i ++)
                    {
                        html += '<li class="list-group-item search-item" onclick="select_search_item(\'' + res[i].name + '\')">' + res[i].name + '</li>';
                    }
                    $(".search-item-list").html("");
                    $(".search-item-list").html(html);
                    
                    if (res.length > 4)
                        $(".search-list").css('height', 160);
                    else
                        $(".search-list").css('height', 40 * res.length);

                    $(".search-list").css('display', '');
                },
                error: function(res) {
                    console.log(res);
                }
            });
        }
    });

    $('.uploadFile').on("change", function() {

        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function(){ // set image data as background of div
                uploadFile.closest(".imgUp").find('.imagePreview').attr("src", this.result);
                // uploadFile.closest(".imgUp").find('.img-value').val(this.result);
            }
        }
    });

    $('#btn_save').click(function() {

        if ($("#date").val() == "") {
            alert("Enter date!");
            return;
        }

        if ($("#player_name").val() == "") {
            alert("Enter player name!");
            return;
        }

        if ($("#youtube_path").val() == "") {
            alert("Enter youtube url!");
            return;
        }

        $("#schedule_form").ajaxSubmit({
            url: "/index.php/admin/save",
            type: "POST",
            success: function(res) {
                if (res == "success") {
                    if ($("#schedule_id").val() == "") {
                        alert("Add a schedule successfully!");
                    } else {
                        alert("Update a schedule successfully!");
                    }
                    location.replace("/index.php/admin");
                } else if (res == "duplicate") {
                    alert("Same date schedule is already existed.");
                }
            },
            error: function(res) {
                alert("Server Error!");
            }
        });
    });
});
