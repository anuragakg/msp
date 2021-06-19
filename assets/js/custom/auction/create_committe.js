var auth = TRIFED.getLocalStorageItem();
var url_var = getUrlVars();
var form_id = '';
mfpmaster_data={};
committe_members={};
members_detail={};
if (url_var['id'] != undefined) {
    form_id = url_var['id'];
    
}
var type=1;
if (url_var['type'] != undefined) {
    type = url_var['type'];
}
$(function () {
    $('.type2').hide();
    if(type==2)
    {
        $('#form_type').html('Value Added Products Details');
    }

    $('.date').datepicker({
        todayBtn: "linked",
        
        format: 'dd/mm/yyyy',
        startDate: new Date(),
        //endDate: new Date()

    });
    fetchState();
    fetchMfpMaster();
    getCommitteMember();
    fillHour();
    fillMinute();
    if (url_var['id'] != undefined) {

        form_data = fetchFormData(form_id);
        $('#auction_title').val(form_data.auction_title);
        $('#reference_number').val(form_data.reference_number);
        $('#auction_date').val(form_data.auction_date_form_format);
        $('#hour').val(form_data.hour);
        $('#minute').val(form_data.minute);
        $('#state_id').val(form_data.state_id);
        $('#venue').val(form_data.venue);
        
        committe_details=form_data.committe_detail;
        var random_committe_id=0;
        committe_details.forEach(function(committe_detail){
            ++random_committe_id;
            var Random_id=Date.now();
            RenderCommitteDetails(Random_id,committe_detail);    
        });
        mfp_details=form_data.mfp_detail;
         var random_mfp_id=0;
        mfp_details.forEach(function(mfp_detail){
            ++random_mfp_id;
            RenderMfpDetails(random_mfp_id,mfp_detail);    
        });
        
    }else{
        var Random_id=Date.now();
        var random_committe_details_id = Random_id;
        var committe_details={};
        var mfp_details={};
        RenderCommitteDetails(random_committe_details_id,committe_details);
        RenderMfpDetails(random_committe_details_id,mfp_details);
        
    }
    
    


    $("#formID").submit(function (e) {

        // e.preventDefault();
    }).validate({

        rules: {


        },
        submitHandler: function (form) {
            var form = $('#formID')[0];
            var data = new FormData(form);
            var url = conf.addAuctionCommitte.url;
            var method = conf.addAuctionCommitte.method;
            if (form_id != undefined && form_id != '') {
                data.append('form_id', form_id);
            }
            data.append('type', type);
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    form_id = response.data.ref_id;
                    $('#preview').show();
                    TRIFED.showMessage('success', 'Successfully Added');
                    
                    setTimeout(function () { window.location = '../auction/auction-committe-list.php'}, 500);
                    
                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            //submit via ajax
            return false;  //This doesn't prevent the form from submitting.
        }
    });
  
});
fetchFormData=(form_id)=>{
    var url = conf.getAuctionCommitteDetail.url(form_id);
    var method = conf.getAuctionCommitteDetail.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            data = response.data;
            console.log(data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}
fetchMfpMaster = (random_committe_details_id) => {
    var url = conf.getMfp.url;
    var method = conf.getMfp.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            mfpmaster_data = response.data;

        }
    });
}
fillMfpMaster = (mfps, item_id = 0) => {
    html = '<option value="">Select MFP</option>';
    $.each(mfps, function (i, mfp) {
        html += '<option value="' + mfp.id + '">' + mfp.mfp_name + '</option>';
    });
    $(item_id).html(html);
}

getCommitteMember=()=>{
    var url = conf.getCommitteMember.url;
    var method = conf.getCommitteMember.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            committe_members = response.data;

        }
    });
}
fillCommitteMember = (members, item_id = 0) => {
    html = '<option value="">Select Committee Member</option>';
    $.each(members, function (i, member) {
        html += '<option value="' + member.id + '">' + member.name+' ('+member.user_name+')' + '</option>';
        members_detail[member.id]=member;
    });
    $(item_id).html(html);
}

function RenderCommitteDetails(random_committe_details_id,itemsdata) {
    var labels_no = $(".delete_committe_details").length;
    ++labels_no;
    var source = $("#committe_details_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_committe_details_id: random_committe_details_id,
        itemdata: itemsdata,
    });
    $("#committe_details_container").append(rendered);
    committe_details_no_inc();
    fillCommitteMember(committe_members,'#committe_details_committe_member_'+random_committe_details_id);
    //fillMfpMaster(mfpmaster_data, '#mfp_coverage_mfp_name_' + random_committe_details_id);
    
    if (itemsdata != '' && itemsdata != null) {
        $('#committe_details_committe_member_' + random_committe_details_id).val(itemsdata.member_id)
    } 
}

$('#add_committe_details').click(function () {
    random_committe_details_id = Date.now();
    RenderCommitteDetails(random_committe_details_id);
    committe_details_no_inc();
});

function delete_committe_details(random_committe_details_id) {
    var count = $(".delete_committe_details").length;
    if (count > 1) {
        $("#delete_committe_details" + random_committe_details_id).remove();
        committe_details_no_inc();
    }
}

function committe_details_no_inc() {
    var item_no = 0;
    $('.committe_details_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    var count = $(".delete_committe_details").length;
    $('.remove_committe_details').show();
    $('.remove_committe_details').first().hide();
}
function getMemberDetail(member_id,random_id)
{
    $('#committe_details_committe_member_designation'+random_id).val(members_detail[member_id]['designation_name']);
    $('#committe_details_committe_member_email'+random_id).val(members_detail[member_id]['email']);
    $('#committe_details_committe_member_phone'+random_id).val(members_detail[member_id]['mobile']);
    
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

function RenderMfpDetails(random_mfp_details_id,itemsdata) {
    var labels_no = $(".delete_mfp_details").length;
    ++labels_no;
    var source = $("#mfp_details_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_mfp_details_id: random_mfp_details_id,
        itemdata: itemsdata,
    });
    $("#mfp_details_container").append(rendered);
    if(type==1){
        $('.type2').hide();
    }else{
        $('.type2').show();
    }
    
    mfp_details_no_inc();
    fillMfpMaster(mfpmaster_data,'#mfp_details_mfpid'+random_mfp_details_id);
    if (itemsdata != '' && itemsdata != null) {
        $('#mfp_details_mfpid' + random_mfp_details_id).val(itemsdata.mfp)
    }
}
function mfp_details_no_inc() {
    var item_no = 0;
    $('.mfp_details_no').each(function () {
        ++item_no;
        $(this).html(item_no);
    });
    var count = $(".delete_mfp_details").length;
    $('.remove_mfp_details').show();
    $('.remove_mfp_details').first().hide();
}
$('#add_mfp_details').click(function () {
    random_mfp_details_id = Date.now();
    RenderMfpDetails(random_mfp_details_id);
    mfp_details_no_inc();
});

function delete_mfp_details(random_mfp_details_id) {
    var count = $(".delete_mfp_details").length;
    if (count > 1) {
        $("#delete_mfp_details" + random_mfp_details_id).remove();
        mfp_details_no_inc();
    }
}
fetchState = () => {
    var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillStates(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStates = (states) => {
    html = '<option value="">Select State</option>';
    $.each(states, function(i, state) {
        html += '<option value="'+state.id+'" selected>'+state.title+'</option>';
    });
    $('#state').html(html);
    
}
function fillHour()
{
    var option='<option value="">Select Hour</option>';
    for(var i=1;i<=24;i++)
    {
        option +='<option value="'+i+'">'+i+'</option>';
    }
    $('#hour').html(option);
}
function fillMinute()
{
    var option='<option value="">Select Minute</option>';
    for(var i=1;i<=60;i++)
    {
        option +='<option value="'+i+'">'+i+'</option>';
    }
    $('#minute').html(option);
}