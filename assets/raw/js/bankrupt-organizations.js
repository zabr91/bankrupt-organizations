/**
 * bankrupt-organizations JavaScript asset.
 *
 * @author Ivan Zabroda <ivanzabroda62@gmail.com>
 * @package bankrupt-organizations
 * @version 1.0.0
 */

jQuery('#popupfilter').on("click",function(e){
    jQuery('body').addClass('overflow');
    jQuery('.filter_podobrat form').addClass('open');

});

jQuery('.filter_podobrat form .close').on("click",function(e){
    jQuery('body').removeClass('overflow');
    jQuery('.mobile_menu .tab').removeClass('open');
    jQuery('.filter_podobrat form').removeClass('open');
    jQuery('#bar_mobile').removeClass('open');
});

jQuery('.filter_podobrat .column4 .select select[name=ifns]').prop('disabled',true);

jQuery('.filter_podobrat .column4 .select select[name=city]').on("change",function(e){
    jQuery('.filter_podobrat .column4 .select select[name=ifns]').prop('disabled',false);
    var nm_city = jQuery(this).val();

    jQuery(function($){
        $.ajax({
            type: "GET",
            url: window.wp_data.ajax_url,
            data: {
                action : 'get_ifns',
                city: nm_city
            },
            success: function (response) {
                const data = JSON.parse(response);
                jQuery('.filter_podobrat .column4 .select select[name=ifns]').empty();

                for(let i = 0; i <  data.length; i++){
                    jQuery('.filter_podobrat .column4 .select select[name=ifns]').append($('<option/>', {
                         text : data[i]
                    }));
                }

                console.log('AJAX response : ',data);
            }
        });
    });


});