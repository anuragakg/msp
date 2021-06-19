  var url_var = getUrlVars();
    var haatmaster_data={};
    var blockmaster_data={};
    var mfpmaster_data={};
   $(document).ready(function() {
    fetchFinancialYear();
    fetchHaatList();    
    fetchMfpMaster();
  });
var url_var = getUrlVars();
var form_id='';
var form_data='';
if(url_var['id']!=undefined){  
    form_id = url_var['id'];  
    $(document).ready(function() {
    form_data=fetchFormData(form_id);
     $('#year_id').val(form_data.year_id)
  });
    $('#preview').show();
    $('#preview').on('click',function(){
      window.location = '../modification-infrastructure/view-infrastructure.php?id='+form_id
    });
}
   $("#formID").submit(function(e) {
            e.preventDefault();
        }).validate({
        rules: {
            
            
        },
        submitHandler: function(form) { 
            var form = $('#formID')[0];   
            var data = new FormData(form);  
            var url = conf.addInfrastructurePartOne.url;
            var method = conf.addInfrastructurePartOne.method; 
            if (form_id != undefined && form_id != '') 
            {
                data.append('form_id', form_id );
            }
              if(form.submitter=='draft')
            {
                data.append('submit_type', 'draft');   
            }else{
                data.append('submit_type', 'submit');
            }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                   form_id=response.data.ref_id;
                    TRIFED.showMessage('success', 'Successfully Added');
                     if(form.submitter=='submit')
                    {
                        setTimeout(function() { window.location = '../modification-infrastructure/step2.php?id='+form_id}, 500);
                    }else{ 
                      setTimeout(function() { window.location = '../modification-infrastructure/step1.php?id='+form_id}, 500);
                    }
                  } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    }); 
/*======== Procurement Plan =====*/
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

$(document).ready(function() {
  var other_proposed_mfp = "";
  var random_haat_id = Date.now();
  $("#addproposed_mfp").click(function() {
    random_haat_id = Date.now();
    RenderGeneralInformation(random_haat_id,other_proposed_mfp);
  });  
}); 

$(document).ready(function() { 
  var random_haat_id = Date.now();    
     haat_data=form_data.infra_haat;         
  if (haat_data != null && haat_data.length) { 
    var haat_no = 0; 
    $.each(haat_data, function(key, haat) {       
      ++haat_no;
      random_haat_id = haat_no;
         RenderGeneralInformation(random_haat_id,haat)    
    });
  } else {
    haat = {};
    RenderGeneralInformation(random_haat_id, haat);
  } 
});

function RenderGeneralInformation(random_haat_id, itemsdata) {
    var source = $("#modernized_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_haat_id: random_haat_id,
      itemsdata: itemsdata
    }); 
    $("#haat_bazaar_proposed").append(rendered); 
    fillHaatList(haatmaster_data,'#haat_'+random_haat_id);      
    fillMfpMaster(mfpmaster_data,'#mfp_'+random_haat_id); 
     if(itemsdata!='' && itemsdata!=null)
    {   
       $('#haat_'+random_haat_id).val(itemsdata.haat_id).trigger('change');
       //$('#blocks_'+random_haat_id).val(itemsdata.block_id).trigger('change');
       $('#operation_'+random_haat_id).val(itemsdata.operation_day).trigger('change');
        $.each(itemsdata.mfp_data, function( i, v ){ 
              $("#mfp_"+random_haat_id +" option[value='" +v.mfp_id + "']").prop("selected", true);
        });
        $.each(itemsdata.block_data, function( i, v ){ 
              $("#blocks_"+random_haat_id +" option[value='" +v.block_id + "']").prop("selected", true);
        });
        if(itemsdata.operation_day!='' && itemsdata.operation_day!=null)
      {  
        var myarray = itemsdata.operation_day.split(',');
        for(var i = 0; i < myarray.length; i++)
        { 
           $("#operation_"+random_haat_id +" option[value='" +myarray[i]+ "']").prop("selected", true);
        } 
      }
    }
    var count = $(".delete_proposed_mfp").length;     
    haat_no_inc(); 
    delete_haat(random_haat_id); 
    $('#haat_'+random_haat_id).select2();
    $('#blocks_'+random_haat_id).select2();
    $('#mfp_'+random_haat_id).select2();
   // $('#operation_'+random_haat_id).select2();
  } 

function haat_no_inc() { 
    var other_proposed_mfp_no = 0;
    $(".other_proposed_mfp_no").each(function() {
      ++other_proposed_mfp_no;
      $(this).html(other_proposed_mfp_no);
    });
    var count = $(".delete_proposed_mfp").length;

    if (count > 1) {
      $(".remove_proposed_mfp").show();
    } else {
      $(".remove_proposed_mfp")
        .first()
        .hide();
    }
  }

  function delete_haat(random_haat_id) {
    $("#remove_proposed_mfp" + random_haat_id).click(function() {
      var data_id = $(this).attr("data_id");
      var count = $(".delete_proposed_mfp").length;
      if (count > 1) {
        $("#delete_proposed_mfp" + random_haat_id).remove();
        other_proposed_mfp_no_inc();
        if(form_data!=''){ 
  form_data=fetchFormData(form_id);
}
         getAssesments(data_id,form_data);
      }
    });
  }
function other_proposed_mfp_no_inc() {
    var other_proposed_mfp_no = 0;
    $(".other_proposed_mfp_no").each(function() {
      ++other_proposed_mfp_no;
      $(this).html(other_proposed_mfp_no);
    });
    var count = $(".delete_proposed_mfp").length;

    if (count > 1) {
      $(".remove_proposed_mfp").show();
    } else {
      $(".remove_proposed_mfp")
        .first()
        .hide();
    }
  }

   

   

function RenderProposedPlan(random_proposed_mfp_id, proposed_plan,k) {
  //console.log(proposed_plan);
    var source = $("#proposed_plan_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
      random_proposed_mfp_id: random_proposed_mfp_id,
      proposed_plan: proposed_plan
    });

    $("#proposed_plan_table").append(rendered);
     if(proposed_plan!='' && proposed_plan!=null)
    {   
       $('#plan_'+random_proposed_mfp_id).val(proposed_plan.proposed_plan);  
            var haat_no = 0;   
          $.each(proposed_plan.haat_data, function(key, response) {       
                       ++haat_no; 
                         $('#estimated_funds_'+k+'_'+haat_no).val(response.estimated_funds);   //12  //12 == 1.1, 2.2
                
                });

    }

    count_proposed_plan_no_inc();  
    delete_proposed_plan(random_proposed_mfp_id);
  }

function count_proposed_plan_no_inc() {
    var count_proposed_no_inc = 0;
    $(".proposed_no_inc").each(function() {
      ++count_proposed_no_inc;
      $(this).html(count_proposed_no_inc);
    });
    var count = $(".delete_proposed_plan").length;

    if (count > 1) {
      $(".remove_proposed_plan").show();
    } else {
      $(".remove_proposed_plan")
        .first()
        .hide();
    }
  }
 function delete_proposed_plan(random_proposed_mfp_id) {
    $("#remove_proposed_plan" + random_proposed_mfp_id).click(function() {
      var data_id = $(this).attr("data_id");
      var count = $(".delete_proposed_plan").length;
      if (count > 1) {
        $("#delete_proposed_plan" + random_proposed_mfp_id).remove();
        count_proposed_plan_no_inc();
      }
    });
  }

  
fetchFinancialYear=()=>{
    var url = conf.getFinancialYearList.url;
    var method = conf.getFinancialYearList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            fillFinancialYear(response.data);
        }
    });
}
fillFinancialYear = (years) => {
    var d = new Date();
    currentYear = d.getFullYear()
    nextYear = d.getFullYear() + 1;
    currentFinancialYear = getCurrentFinancialYear();//currentYear + '-' + nextYear;
    html = '<option value="">Select Financial Year</option>';
    $.each(years, function (i, year) {
        if (currentFinancialYear == year.title) {
            html += '<option value="' + year.id + '" selected>' + year.title + '</option>';
        }
        //html += '<option value="'+year.id+'">'+year.title+'</option>';

    });
    $('#year_id').html(html);
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
$(document).on('change','.mfp_coverage_haat', function (ev) {
    const v = $(this).val();
    var item_id = $(this).attr('data-id');
    if($(this).val()!='')
    {
        fetchHaatBlock(v,'#blocks_'+item_id,item_id);  
        if(form_id!=''){ 
        form_data=fetchFormData(form_id);
      }
        getAssesments(v,form_data);  
    }
    
});

fetchHaatBlock = (id = 0,item_id=0,tblId) => {
    var url = conf.viewHaatMaster.url(id);
    var method = conf.viewHaatMaster.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            blocks=response.data.block_ids;
            fillHaatBlocks(blocks,item_id);
            fillDays(response.data,tblId);            
        }
    });
}
fillHaatBlocks = (blocks,item_id) => { 
    html = '<option value="" disabled>Select Block</option>';
    $.each(blocks, function(i, block) {
        html += '<option value="'+block.block_id+'">'+block.block_name+'</option>';
    });
    $(item_id).html(html);
}

fillDays = (result,tblId) => {  
      html = '';
    $.each(result.operating_days, function(i, day) { 
        html+='<label class="daylable">'+day+'</label>',
        html += '<input type="hidden" name="modernized['+tblId+'][operation][]" value="'+day+'">';
         //$("#operation_"+tblId +" option[value='" +day+ "']").prop("selected", true);
    });
    $('#oprationDays'+tblId).html(html);
    $('#nature_'+tblId).val(result.nature_of_operation);
}


fetchMfpMaster=(random_mfp_coverage_id)=>{
    var url = conf.getMfp.url;
    var method = conf.getMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data=response.data;
           
        }
    });
}
fillMfpMaster = (mfps,item_id=0) => {  
    html = '<option value="" disabled>Select MFP</option>';
	html = '';
    $.each(mfps, function(i, mfp) {
        html += '<option value="'+mfp.id+'">'+mfp.mfp_name+'</option>';
    });
    $(item_id).html(html);
}

function getCurrentFinancialYear() {
  var fiscalyear = "";
  var today = new Date();
  if ((today.getMonth() + 1) <= 3) {
    fiscalyear = (today.getFullYear() - 1) + "-" + today.getFullYear()
  } else {
    fiscalyear = today.getFullYear() + "-" + (today.getFullYear() + 1)
  }
  return fiscalyear
}
function getAssesments(id,form_data)
{  
  var count = $('.mfp_coverage_haat  option:selected').length;
  var selectedValues = {};
        $('.mfp_coverage_haat').each(function(){
            var text = $(this).children("option").filter(":selected").text();
            var value = $(this).val();
            selectedValues[value] = text;

        });
        //console.log(selectedValues);
        formData=form_data.assessment_data;
    var textValue = JSON.stringify(selectedValues, null, 4);

    $.ajax({
           type: "POST",
           url: '../modification-infrastructure/assessment.php',
           data: {total:count,option:textValue,formData:formData}, // serializes the form's elements.
           success: function(data)
           {
               $('#assessment').html(data); // show response from the php script.
               
           }
         });
     getProposed(textValue,form_data.proposed_plan);
}
function getProposed(data,formdata)
{  
    $.ajax({
           type: "POST",
           url: '../modification-infrastructure/proposed_plan.php',
           data: {option:data,formData:formdata}, // serializes the form's elements.
           success: function(data)
           {
               $('#proposed').html(data); // show response from the php script. 
              //console.log(formdata)
                 if (formdata != null && formdata.length) { 
                  k=0;
                var haat_no = 0; 
                $.each(formdata, function(key, proposed_plan) {       
                  ++haat_no;
                  ++k;
                  random_proposed_mfp_id = haat_no;
                     RenderProposedPlan(random_proposed_mfp_id,proposed_plan,k)    
                });
              } else {
              var proposed_plan = "";  
               random_proposed_mfp_id = Date.now(); 
               k='';
                RenderProposedPlan(random_proposed_mfp_id, proposed_plan,k);
              } 
           }
         });
     
}

function addmore(data)
{ 
  var proposed_plan = "";  
  k=0;
    random_proposed_mfp_id = Date.now();
    RenderProposedPlan(random_proposed_mfp_id,proposed_plan,k); 
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

/*$(document).ready(function() {
$(".mfp_coverage_haat").change(function () {
    var selected=$('.mfp_coverage_haat option:selected').val();
      $('.mfp_coverage_haat').each(function() {
      $('option[value="' + selected + '"]').attr('disabled','disabled');
    });
  });
});*/

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