function share() {
    const area = document.querySelector('#share_box');
    area.select();
    document.execCommand('copy');
    alert("Copied for clipboard!");
  }
  

$(document).ready(function() {

    if (window.localStorage.getItem('game_result') == "") 
        location.replace("/");

    if (window.localStorage.getItem('game_date') != $("#today").val())
        location.replace("/");

    var game_history_cnt = JSON.parse(window.localStorage.getItem('game_history')).length;
    var html = "<br>";

    for(var i = 0; i < 5; i ++)
    {
        if (i ==  game_history_cnt - 1 && game_history_cnt != 5)
            html += "✅";
        else if (i <= game_history_cnt - 1)
            html += "❌";
        else
            html += "⚫";
    }

    $("#share_box").append(html);
});