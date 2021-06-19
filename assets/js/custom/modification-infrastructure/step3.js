
    var url_var = getUrlVars();
   $(document).ready(function() {  
        fetchHaatList();   
  });
  var haatmaster_data={}; 
  var form_id='';
    var form_data=''; 
    if(url_var['id']!=undefined){  
        form_id = url_var['id'];  
        $(document).ready(function() {
        form_data=fetchFormData(form_id); 
         $('#year_id').val(form_data.year_id);
         haatdata=form_data.totalfund;            
         warehouse_fund=form_data.warehouse_facilities;            
        modernized_id=0; 
        $.each(haatdata, function(key, itemdata) {
            ++modernized_id;
            RenderGeneralInformation(modernized_id, itemdata);
        });
         if ( !warehouse_fund!= null && warehouse_fund != '') { 
          total=0;
        $.each(warehouse_fund, function (key, warehouse) {  
                if (!isNaN(warehouse.estimated_fund)) {
                    total += parseFloat(warehouse.estimated_fund);
                }                            
            });  
        $("#total_fund_warehouse").val(total.toFixed(4)); 

        $.each(form_data.summary, function(key, data) {  
           $("#other_info").val(data.other_information); 
           $("#old_fund").val(data.old_fund_available); 
        });

           calculateAutoSum();
    }
      });
        $('#preview').show();
        $('#preview').on('click',function(){
        window.location = '../modification-infrastructure/view-infrastructure.php?id='+form_id
        });
         $('#previous').on('click',function(){
        window.location = '../modification-infrastructure/step2.php?id='+form_id
    });
    }

 function calculateAutoSum(){
    
    var sum = 0;
    $(".auto-sum").each(function(){
        sum += +$(this).val();
    });
    var total_require_fund=sum.toFixed(4);
    $("#total_fund").val(total_require_fund);

     var haat = 0;
    $(".etotal").each(function(){
        haat += +$(this).val();
    });
    $("#total").html(haat);
    $("#total_estimated_fund").val(haat);
 }  

 

fetchFormData=(form_id)=>{
    var url = conf.getInfrastructurePartOne.url(form_id);
        var method = conf.getInfrastructurePartOne.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
            data = response.data;            
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
        return data;
} 
   $("#formID").submit(function(e) {
            e.preventDefault();
        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addInfrastructureSummary.url;
            var method = conf.addInfrastructureSummary.method; 
            if (form_data != undefined && form_data != '') 
            {
                data.append('form_id', form_data.id );
            }
              if(form.submitter=='draft')
            {
                data.append('submit_type', 'draft');   
            }else{
                data.append('submit_type', 'submit');
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
            if(form.submitter=='draft')
            {
                 TRIFED.showMessage('success', 'Successfully Added.');
            }else{
                 TRIFED.showMessage('success', 'Successfully Submitted.');
            }
                  
                     if(form.submitter=='submit')
                    {
                        setTimeout(function() { window.location = '../modification-infrastructure/infrastructure-development-listing.php'}, 500);
                    }else{
                        setTimeout(function() { window.location = '../modification-infrastructure/step3.php?id='+form_id}, 500);
                    } 
                        } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    }); 
    
function RenderGeneralInformation(modernized_id, itemsdata) {
    var source = $("#modernized_fund_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      modernized_id: modernized_id,
      itemsdata: itemsdata
    }); 
    $("#modernized_data").append(rendered);    
    //fillHaatList(haatmaster_data,'#haat_'+modernized_id); 
    if(itemsdata!='' && itemsdata!=null)
    {   
        $('#haat_'+modernized_id).val(itemsdata.haat_id).trigger('change');
        $('#fund_'+modernized_id).val(itemsdata.estimated_funds);
    }
    var count = $(".delete_modernized_mfp").length;     
    haat_no_inc(); 
  } 

function haat_no_inc() { 
    var other_modernized = 0;
    $(".other_modernized").each(function() {
      ++other_modernized;
      $(this).html(other_modernized);
    });
    var count = $(".delete_modernized_mfp").length;
    if (count > 1) {
      $(".remove_modernized").show();
    } else {
      $(".remove_modernized")
        .first()
        .hide();
    }
  }

fetchHaatList = () => {
    var url = conf.getHaatMasterList.url;
    var method = conf.getHaatMasterList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            haatmaster_data=response.data;
        }
    });
}

fillHaatList= (Haats,item_id) => {
    html = '<option value="">Select Haat</option>';
    $.each(Haats, function(i, Haat) {
        html += '<option value="'+Haat.id+'">'+Haat.haat_bazaar_name+'</option>';
    });
    $(item_id).html(html);
}
function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function isNumber(ev) {
    if (ev.type === "paste" || ev.type === "drop") {
        var textContent = (ev.type === "paste" ? ev.clipboardData : ev.dataTransfer).getData('text');
        return !isNaN(textContent) && textContent.indexOf(".") === -1;
    } else if (ev.type === "keydown") {
        if (ev.ctrlKey || ev.metaKey) {
            return true
        };
        var keysToAllow = [8, 46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57];
        return keysToAllow.indexOf(ev.keyCode) > -1;
    } else {
        return true
    }
}