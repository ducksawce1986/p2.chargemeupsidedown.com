/*------------------------------------------------
JQuery Functions Distinguishing Between Band Types
------------------------------------------------*/

$(document).ready(function(){
  	$("#never_gigged").click(function(){
    	$("#acoustic, #cover_group, #indie_havens, #indie_labels, #major_labels, #rock_stars, #church, #great_scott, #club_passim, #lizard_lounge, #lansdowne_pub, #tt_the_bears, #middle_east_upstairs, #brighton_music_hall, #middle_east_downstairs, #paradise_rock_club, #sinclair, #house_of_blues, #wang_theater, #bank_of_america_pavilion, #td_banknorth_garden").toggle();
  	});
});    	

$(document).ready(function(){
    $("#acoustic").click(function(){
    	$("#never_gigged, #cover_group, #indie_havens, #indie_labels, #major_labels, #rock_stars, #obriens, #midway, #church, #great_scott, #lansdowne_pub, #tt_the_bears, #middle_east_upstairs, #brighton_music_hall, #middle_east_downstairs, #paradise_rock_club, #sinclair, #house_of_blues, #wang_theater, #bank_of_america_pavilion, #td_banknorth_garden").toggle();
    });
});

$(document).ready(function(){
    $("#cover_group").click(function(){
    	$("#never_gigged, #acoustic, #indie_havens, #indie_labels, #major_labels, #rock_stars, #great_scott, #club_passim, #tt_the_bears, #brighton_music_hall, #middle_east_downstairs, #paradise_rock_club, #sinclair, #house_of_blues, #wang_theater, #bank_of_america_pavilion, #td_banknorth_garden").toggle();
	});
});

$(document).ready(function(){
    $("#indie_havens").click(function(){
    	$("#never_gigged, #acoustic, #cover_group, #indie_labels, #major_labels, #rock_stars, #obriens, #midway, #club_passim, #lizard_lounge, #lansdowne_pub, #paradise_rock_club, #sinclair, #house_of_blues, #wang_theater, #bank_of_america_pavilion, #td_banknorth_garden").toggle();
    });
});

$(document).ready(function(){
    $("#indie_labels").click(function(){
    	$("#never_gigged, #acoustic, #cover_group, #indie_havens, #major_labels, #rock_stars, #obriens, #midway, #church, #great_scott, #club_passim, #lizard_lounge, #lansdowne_pub, #tt_the_bears, #middle_east_upstairs, #bank_of_america_pavilion, #td_banknorth_garden").toggle();
    });
});

$(document).ready(function(){
    $("#major_labels").click(function(){
    	$("#never_gigged, #acoustic, #cover_group, #indie_havens, #indie_labels, #rock_stars, #obriens, #midway, #church, #great_scott, #club_passim, #lizard_lounge, #lansdowne_pub, #tt_the_bears, #middle_east_upstairs, #brighton_music_hall, #middle_east_downstairs, #paradise_rock_club, #sinclair, #td_banknorth_garden").toggle();
    });
});

$(document).ready(function(){
    $("#rock_stars").click(function(){
    	$("#never_gigged, #acoustic, #cover_group, #indie_havens, #indie_labels, #major_labels, #obriens, #midway, #church, #great_scott, #club_passim, #lizard_lounge, #lansdowne_pub, #tt_the_bears, #middle_east_upstairs, #brighton_music_hall, #middle_east_downstairs, #paradise_rock_club, #sinclair, #house_of_blues, #wang_theater").toggle();
    });
});

-----------------------------

$(document).ready(function() {
    $("#indie_labels").click(function() {
        $("div").animate({right:'250px'});
    });
});


