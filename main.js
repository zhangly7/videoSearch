$(document).ready(function(){

    $(".re").mouseenter(function(){      // Show details for the item
        var vID = $(this).attr("vID");  // get vID value from "this" in results
        $.post("result-details.php", {vID:vID},
            function(result){
                var json = $.parseJSON(result);
                var detailHTML =   "<p><span><strong>"+json["title"]+"</strong></span></p><br>"+
                    "<p><span><strong>Genre: </strong>"+json["genre"]+"</span></p>"+
                    "<p><span><strong>Keywords: </strong>"+json["kw"] +"</span></p>"+
                    "<p><span><strong>Duration: </strong>"+json["dur"] +"</span></p>"+
                    "<p><span><strong>Color: </strong>"+json["color"] +"</span></p>"+
                    "<p><span><strong>Sound: </strong>"+json["sound"] +"</span></p>"+
                    "<p><span><strong>Sponsor: </strong>"+json["sponsor"] +"</span></p>";
                $(".details").html(detailHTML);
            });
    });

    $(".re").mouseleave(function() {      //details disappear when mouse leave
        $(".details").text("");
    });


    $(window).scroll(function(){        // make box D move with scrolling
        $(".details").css({"margin-top": ($(window).scrollTop())  + 16 + "px",
            "margin-left":($(window).scrollLeft()) + 35 +"px"});
    });


    $("input").keyup(function() {       // Keyup function was used to submit current input in box
        $.ajax({
            type:"POST",
            url: "actions.php?action=suggestion",
            data:{
                typing:$("input").val()
            },
            dataType:"JSON",
            success: function (result) {
                if (result !== 2 && result.length > 0) {
                    suggHTML = "<p style='color: cornflowerblue'><strong>Suggestions:</strong></p>";
                    $.each(result, function(key,value) {
                        suggHTML += "<p style='font-size: 13px'>"+value+"</p>";
                    })
                    $(".suggestion").html(suggHTML);
                } else {
                    $(".suggestion").html("");  // make it blank when nothing in search box
                }
            }
        });
    });

});