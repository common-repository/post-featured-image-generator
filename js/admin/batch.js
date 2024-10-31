var offset = 0;
var limit = 10;
var aborted = false;

jQuery(document).ready(function() {
    jQuery("#fig-batch-progressbar").progressbar({
        value: 0,
        change: function() {
            var perc = jQuery("#fig-batch-progressbar").progressbar("value")*100/jQuery("#fig-batch-progressbar").progressbar("option", "max");
            perc = perc.toFixed(2);
            jQuery('.label', '#fig-batch-progressbar').text(perc + "%");
        },
        complete: function() {
            jQuery('.label', '#fig-batch-progressbar').text("Complete!");
        }
    });
    
    jQuery('#batch-start').click(function() {
        jQuery('.log', '.fig-batch').html('');
        aborted = false;
        jQuery('.rules').hide();
        jQuery('#batch-stop').show();
        jQuery('.label', '#fig-batch-progressbar').text("0%");
        jQuery("#fig-batch-progressbar").progressbar("option", "max", 1);
        jQuery("#fig-batch-progressbar").progressbar("option", "value", 0);
        offset = 0;
        figBatch();
    });
    
    jQuery('#batch-stop').click(function() {
        jQuery(this).hide();
        jQuery('.rules').show();
        aborted = true;
    });
    
});

function figBatch() {
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        dataType: 'json',
        data: {
            action: 'fig_batch', 
            offset: offset, 
            limit: limit,
            rule: jQuery('#batch-rule').val()
        },
        success: function(response) {
            if (aborted) return;
            if (typeof response.error != "undefined") {
                jQuery('.log', '.fig-batch').append('<div class="error"><p>'+response.error+'</p></div>');
                return;
            }
            jQuery("#fig-batch-progressbar").progressbar("option", "max", response.total);
            jQuery("#fig-batch-progressbar").progressbar("option", "value", response.parsed);
            offset += limit;
            if (offset<response.total)  {                
                figBatch();
            } else {
                jQuery('#batch-stop').hide();
                jQuery('.rules').show();
            }
            jQuery('.log', '.fig-batch').html('');
            jQuery('.log', '.fig-batch').append('<div>Total: '+response.total+'</div>');
            jQuery('.log', '.fig-batch').append('<div>Processed: '+response.parsed+'</div>');
        }
    });    
}


