$(document).ready(function()
{
        $('.lf_menu li ul').css('display','none');
        $('.lf_menu li.act>ul').css('display','block');

	var delta_h1 = $('.left_col').height();
	var delta_h2 = $('.right_col').height();

	if (delta_h1 > delta_h2)
	{
		$('.rt_kord').height(delta_h1-$('.banners_bottom').outerHeight(true));
	}

	h_rt = $('.rt_kord').height();
	$(window).resize(function ()
        {
                var h1 = $('.rt_kord_cont').height();
                var h2 = $('.rt_kord').height();
                if (h1 >= h2)
                {
                        $('.rt_kord').height(h1);
                }
                else
                {
                        $('.rt_kord').height(h_rt);
                }
        });

	$('ul.lf_menu li div.menu_1').click(function()
	{
		if (!$(this).parent('li').hasClass('act'))
		{
			$(this).parent('li').find('>ul').slideDown(500);
		}
		else
		{
			$(this).parent('li').find('ul').slideUp(500);
                        $(this).parent('li').find('ul li').removeClass('act');
		}
		$(this).parent('li').toggleClass('act');
	});



        $('ul.lf_menu li div.menu_1_1').click(function()
        {
                if (!$(this).parent('li').hasClass('act'))
                {
                        $(this).parent('li').find('>ul').slideDown(500);
                }
                else
                {
                        $(this).parent('li').find('ul').slideUp(500);
                        $(this).parent('li').find('ul li').removeClass('act');

                }
                $(this).parent('li').toggleClass('act');

		
        });



	/* tooltip for characteristics */
	$('div.characts div.link').mouseover(function(){
		$(this).addClass('link_hover');
		$('div#tooltip_characts div.cnc').html('');
		var html = $(this).parent('div.characts').find('div.txt').html();
		$('div#tooltip_characts div.cnc').html(html);
		$('div#tooltip_characts').css({display: 'none'}).css({display: 'block'});
	}).mousemove(function(e){
		$('div#tooltip_characts').css({left:e.pageX-21+'px', top:e.pageY-$('#tooltip_characts').height()-10+'px'});
	}).mouseout(function(){
		$(this).removeClass('link_hover');
		$('div#tooltip_characts').css({display: 'none'});
	});

	$('.btn').hover(
	function()
	{
		$(this).addClass('btn_hover');
	},
	function()
	{
		$(this).removeClass('btn_hover');
	}
	);

	$("#carusel").jcarousel({});
	$("#carusel").css({visibility: 'visible'});

	$(".list_items_big .photo img").each(function()
	{
		dh = ($(this).parents('.photo').height() - $(this).height());
		if (dh > 1) $(this).css('top', dh/2);
	});

	$(".list_items .photo img").each(function()
	{
		dh = ($(this).parents('.photo').height() - $(this).height());
		if (dh > 1) $(this).css('top', dh/2);
	});

	$(".tbl_item_full .photo img").each(function()
	{
		dh = ($(this).parents('.photo').height() - $(this).height());
		if (dh > 1) $(this).css('top', dh/2);
	});

	/* tab link */
	$('.map_link_pos').hover(
	function()
	{
		$(this).find('.map_show').show();
		$(this).find('.map_link').addClass('map_link_hover');
	},
	function()
	{
		$(this).find('.map_show').hide();
		$(this).find('.map_link').removeClass('map_link_hover');
	}
	);

	/* Tabs */
	$('.change_content .show_layer:first').show();
	$('.change_content .tabs li:first').addClass('act');
	$('.change_content .tabs li').click(function(){
		$(this).siblings().removeClass('act').end().addClass('act');
		$('.change_content .show_layer').hide().eq($('.change_content .tabs li').index(this)).show();
	});

});
