var auth = TRIFED.getLocalStorageItem();
const id= TRIFED.getUrlParameters().id;
var balance_amount=0;
$(function () {
   fetchReleasedFundDetails(id);
});

fetchReleasedFundDetails = (id) => {
    var url = conf.getReleasedFundDetails.url(id);
    var method = conf.getReleasedFundDetails.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            fillFields(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillFields = (data) => {
    if(data.file_number!='' && data.file_number!=null)
    {
        $('#file_number').val(data.file_number).prop('readonly',true);
        $('#sanction_date').val(data.sanction_date).prop('readonly',true);
        /*$('#transaction_id').val(data.transaction_id).prop('readonly',true);
        $('#transaction_date').val(data.transaction_date).prop('readonly',true);*/
    }
    $('#reference_number').html(data.reference_number);
    $('#approved_amount').html(utils.formatCurrency(data.approved_amount));
    $('#sanctioned_amount').html(utils.formatCurrency(data.sanctioned_amount));
    $('#released_amount').html(utils.formatCurrency(data.released_amount));
    var html='';
    released_details = data.released_details
    console.log(released_details);
    user_wise_balance=[];
    if(released_details.length){
       
        var user_wise_balance=[];
        release_amt = 0;
        var i = 0;
        released_details.forEach(function(row){
            ++i;
            release_amt  = parseFloat(row.release_amount) + parseFloat(row.commission_amount);

            balance = parseFloat(row.total_released_amount) - parseFloat(release_amt);
            if(user_wise_balance[row.created_by_id]!=undefined)
            {
                user_wise_balance[row.created_by_id]=parseFloat(user_wise_balance[row.created_by_id])-(parseFloat(row.release_amount)+parseFloat(row.commission_amount));    
            }else{
                user_wise_balance[row.created_by_id]=parseFloat(balance);    
            }
            
            html +='<tr>';
            html +='<td>'+ i +'</td>';
            html +='<td>'+ data.reference_number +'</td>';
            html +='<td class="text-right">'+ utils.formatAmount(data.approved_amount) +'</td>';
            html +='<td class="text-right">'+ row.release_percent +'</td>';
            html +='<td class="text-right">'+ utils.formatAmount(row.release_amount) +'</td>';
            html +='<td class="text-right">'+ utils.formatAmount(row.commission_amount) +'</td>';
            html +='<td>'+ row.bank_details.title +'</td>';
            html +='<td>'+ row.account_number +'</td>';
            html +='<td>'+ row.created_at +'</td>';
            html +='<td>'+ row.created_by.name +' '+row.created_by.middle_name+' '+row.created_by.last_name +'</td>';
            html +='<td class="text-right">'+ utils.formatAmount(user_wise_balance[row.created_by_id]) +'</td>';
            html +='</tr>';
        });
    } else {
        html +='<tr>';
        html +='<td colspan="10" style="text-align:center">No Records Available Now</td>';
        html +='</tr>'
    }
   
    $('#release_fund_history').html(html);
}
