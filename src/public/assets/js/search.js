var game_history = [];

function select_search_item(search_item) 
{
    $("#player_keyword").val(search_item);
    $(".search-item-list").html("");
    $(".search-list").css('display', 'none');
}

function guess_player()
{
    $.ajax({
        url: "/index.php/guess",
        data: {player_name : $("#player_keyword").val(), no : JSON.parse(window.localStorage.getItem('game_history')).length + 1} ,
        type: "POST",
        success: function(res) {
            
            var result = JSON.parse(res);

            var history_item = {
                no : JSON.parse(window.localStorage.getItem('game_history')).length + 1,
                value : $("#player_keyword").val()
            };
            game_history.push(history_item);
            window.localStorage.setItem('game_history', JSON.stringify(game_history));

            if (result.status == 'win') {
                
                window.localStorage.setItem('game_result', result.status);
                window.localStorage.setItem('game_date', result.date);

                location.replace('/index.php/result');

            } else if(result.status == 'failed') {
                
                $("#main_image").attr('src', result.image);

                var html = "";

                if ($("#player_keyword").val() != "")
                    html = '<li class="list-group-item guess-item1">❌ ' + $("#player_keyword").val() + '</li>';
                else
                    html = '<li class="list-group-item guess-item1">❌ Skipped</li>';

                $(".guess-item-list").append(html);
                
                $("#player_keyword").val("");

            } else if (result.status == 'lose') {

                window.localStorage.setItem('game_result', result.status);
                window.localStorage.setItem('game_date', result.date);

                location.replace('/index.php/result');
            }
        },
        error: function(res) {
            console.log(res);
        }
    });
}

$(document).ready(function() {

    if (window.localStorage.getItem('game_result') != "" && window.localStorage.getItem('game_date') == $("#today").val()) 
        location.replace("/index.php/result");

    window.localStorage.setItem('game_history', JSON.stringify(game_history));

    $("#player_keyword").keyup(function(event) {

        if ($("#player_keyword").val() == "") {
            $(".search-item-list").html("");
            $(".search-list").css('display', 'none');
            return;
        }
        
        if ((event.keyCode >= 65 && event.keyCode <= 90) || event.keyCode == 8 || event.keyCode == 13) {
            $.ajax({
                url: "https://eurogols.eu/api/search/" + $("#player_keyword").val(),
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

    $("#guess_btn").click(function() {

        if ($("#player_keyword").val() == "") {
            return;
        }

        guess_player();
    });

    $("#skip_btn").click(function() {

        guess_player();
    })
});