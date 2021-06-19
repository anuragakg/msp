
$(document).ready(function () {
   
    var random_other_costs_id = Date.now();

    $('#add_other_costs').click(function () {
        random_other_costs_id = Date.now();
        RenderOtherCosts(random_other_costs_id);

    });
    if(formData.getMfpOtherCosts && formData.getMfpOtherCosts!=null && formData.getMfpOtherCosts!=''){
        var getMfpOtherCosts = formData.getMfpOtherCosts;
        random_other_costs_id = 0;
        $.each(getMfpOtherCosts, function(key, itemdata) {
            ++random_other_costs_id;
            RenderOtherCosts(random_other_costs_id, itemdata);
        });
      
    }else{
        var mfp_coveragedata = formData.mfp_coverage;
        random_other_costs_id = 0;
        $.each(mfp_coveragedata, function(key, itemdata) {
            ++random_other_costs_id;
            RenderOtherCosts(random_other_costs_id, itemdata);
        });
    }

    function RenderOtherCosts(random_other_costs_id, itemdata) {
        var source = $("#other_costs_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_other_costs_id: random_other_costs_id,
            itemdata: itemdata,
        });
        $("#other_costs_container").append(rendered);
        $("#other_cost_"+random_other_costs_id).val(itemdata.other_cost);
        $("#remarks_"+random_other_costs_id).val(itemdata.remarks);    
        pr_other_costs_no_inc();
        //console.log(itemdata);
    }

    initDecimalNumeric();
});

function delete_other_costs(random_other_costs_id) {
    var count = $(".delete_items").length;
    if (count > 1) {
        $("#delete_items_" + random_other_costs_id).remove();
        pr_other_costs_no_inc();
    }

}


function pr_other_costs_no_inc() {
    var item_no = 0;
    $('.item_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });

    var count = $(".delete_items").length;
    $('.remove_items').show();
    if (count == 1) {
        $('.remove_items').hide();
    } else {
        $('.remove_items').first().hide();
    }

}

