var count=[];
var state= [];
var filter={};
var amount=[];
var sanction=[];

$(function() {
  //fetchState();
  //fetchDistrict();
  //fetchBlock();
  searchEvent();
  publicDashboardCount();
});

publicDashboardCount = (filter={}) => {
  var url = conf.getPublicDashboardCount.url;
    var method = conf.getPublicDashboardCount.method;
    var data = filter;
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
      //console.log(response);
        if (response.status) {
          amount=[];
          sanction=[];
          count=[];
          state=[];
          approved_data=[];
          vdvk_approved=[];
          vdvk_approved['title']='State Wise VDVKs Approved';
          vdvk_approved['prefix']='';
          vdvk_approved['postfix']='';
          vdvk_approved['yAxis_title_text']='Number of VDVKs Approved';

          sanctioned_data=[];
          amount_sanctioned=[];
          amount_sanctioned['title']='Amount Sanctioned to VDVKs State Wise';
          amount_sanctioned['prefix']='Rs.';
          amount_sanctioned['postfix']='';
          
          var dashboard       = [ 'tribal_gatherers','ware_houses','haat_market' , 'pending_count' , 'approved_count' ,'sanction_amount','released_amount','shg_group', 'surveyor', 'supervisor'];
          var pmdvy_graph     = response.data.pmdvy_approved;
          var sanctionData    = response.data.sanctionReleased;

          if(pmdvy_graph.length){
            pmdvy_graph.forEach(function(stateCount){
                count.push(stateCount.approval_count);
                state.push(stateCount.state_name);

                approved_data.push({
                  name:stateCount.state_name,
                  y:parseInt(stateCount.approval_count),
                  url:'../approval-management/proposed-vdvks-list.php?state='+stateCount.state,
                });
                
            });
          
            
			vdvk_approved['data']=approved_data;
          //  create_column_graph(vdvk_approved,'vdvk_approved');
            
            //graph();
          }

          if(sanctionData.length){
            sanctionData.forEach(function(stateCount){
                amount.push(stateCount.sanctioned_sum);
                sanction.push(stateCount.state_name);

                sanctioned_data.push({

                  name:stateCount.state_name,
                  y:parseInt(stateCount.sanctioned_sum),
                  url:'../fund-management/sanction-letter-management.php',
                });
            });
            
            amount_sanctioned['data']=sanctioned_data;
            //create_pie(amount_sanctioned,'amount_sanctioned');
            //sanctionGraph();

          }

          dashboard.forEach(function(dashboardClass){
            //console.log(dashboardClass);
            if(dashboardClass=='sanction_amount' || dashboardClass=='released_amount'){
                var value=response.data[dashboardClass];
                $("."+dashboardClass).html(numDifferentiation(value));  
            }else{
                $("."+dashboardClass).html(response.data[dashboardClass]);  
            }
            

          });
          

        } 
        // else {
        //     TRIFED.showMessage('error', response.message);
        // }
    });
}


fetchState = () => {
  var url = conf.getDashboardStates.url;
    var method = conf.getDashboardStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response.status) {
            addressData = response.data;
            fillStates(response.data);
        } 
        // else {
        //     TRIFED.showError('error', response.message);
        // }
    });
}


fillStates = (states) => {
  html = '<option value="">Select State</option>';
  $.each(states, function(i, state) {
    html += '<option value="'+ xssClean(state.id) +'">'+ xssClean(state.title) +'</option>';
  });
  $('#state').html(html);
}

$('#state').on('change', function (ev) {
  const v = $(this).val();
  filter.state = $('#state option:selected').val();
  fetchDistrict(v);
})

fetchDistrict = (id = 0) => {
  var url = conf.getDashboardDistricts.url;
  var method = conf.getDashboardDistricts.method;
  var data = {
    state_id : id
  };
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
    if (response.status) {
      fillDistrict(response.data);
    }
        // else {
        //     TRIFED.showError('error', response.message);
        // }
  });
}

fillDistrict = (districts) => {
  html = '<option value="">Select District</option>';
  $.each(districts, function(i, district) {
    html += '<option value="'+ xssClean(district.id) +'">'+ xssClean(district.title) +'</option>';
  });
  $('#district').html(html);
}

$('#district').on('change', function (ev) {
  filter.district= $('#district option:selected').val();
  const v = $(this).val();
  fetchBlock(v);
})

fetchBlock = (id = 0) => {
  var url = conf.getDashbardBlocks.url;
  var method = conf.getDashbardBlocks.method;
  var data = {
    district_id : id
  };
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
    if (response.status) {
      fillBlock(response.data);
    }
        // else {
        //     TRIFED.showError('error', response.message);
        // }
  });
}

fillBlock = (blocks) => {
  html = '<option value="">Select Block</option>';
  $.each(blocks, function(i, block) {
    html += '<option value="'+ xssClean(block.id) +'">'+ xssClean(block.title) +'</option>';
  });
  $('#block').html(html);
}

$('#block').on('change', function (ev) {
  filter.block= $('#block option:selected').val();
})

searchEvent=()=>{
  $('#page-wrapper button').on('click',function(e){
    publicDashboardCount(filter);
  })
}

var barOptions = {
        responsive: true,
        scales: {
            xAxes : [{
                  gridLines : {
                      display : false,
                      lineWidth: 1,
                      zeroLineWidth: 1,
                      zeroLineColor: '#666666',
                      // drawTicks: false
                  },
                  ticks: {
                      display:true,
                      stepSize: 0,
                      min: 0,
                      autoSkip: false,
                      fontSize: 11,
                      padding: 12
                  }
              }],
              yAxes: [{
                  ticks: {
                      padding: 5
                  },
                  gridLines : {
                      display : true,
                      lineWidth: 1,
                      zeroLineWidth: 2,
                      zeroLineColor: '#666666'
                  }
              }]
        },

    };

 

function get_vdvk_rolewise_count(status)
{
    var state=$('#state').val();
    var district=$('#district').val();
    var block=$('#block').val();
    state=state==0?'':state;
    district=district==0?'':district;
    block=block==0?'':block;
    window.open("../auth/vdvk_rolewise.php?status="+status+'&state='+state+'&district='+district+'&block='+block,'_blank');
}

function get_vdvk_statewise_count(status)
{
    var state=$('#state').val();
    var district=$('#district').val();
    var block=$('#block').val();
    state=state==0?'':state;
    district=district==0?'':district;
    block=block==0?'':block;
    window.open("../auth/vdvk_statewise.php?status="+status+'&state='+state+'&district='+district+'&block='+block,'_blank');
}

function get_warehouse_statewise_count(status)
{
    var state=$('#state').val();
    var district=$('#district').val();
    var block=$('#block').val();
    state=state==0?'':state;
    district=district==0?'':district;
    block=block==0?'':block;
    window.open("../auth/warehouse_statewise.php?status="+status+'&state='+state+'&district='+district+'&block='+block,'_blank');
}
function get_haatbazaar_statewise_count()
{
    var state=$('#state').val();
    var district=$('#district').val();
    var block=$('#block').val();
    state=state==0?'':state;
    district=district==0?'':district;
    block=block==0?'':block;
    window.open("../auth/haatbazaar_statewise.php?state="+state+'&district='+district+'&block='+block,'_blank');
}
function sanctioned_sndwise()
{
    var state=$('#state').val();
    var district=$('#district').val();
    var block=$('#block').val();
    state=state==0?'':state;
    district=district==0?'':district;
    block=block==0?'':block;
    window.open("../auth/sanctioned_sndwise.php?&state_id="+state+'&district='+district+'&block='+block,'_blank');
}



function sanctioned_releasewise()
{
    var state=$('#state').val();
    var district=$('#district').val();
    var block=$('#block').val();
    state=state==0?'':state;
    district=district==0?'':district;
    block=block==0?'':block;
    window.open("../auth/sanctioned_releasewise.php?&state_id="+state+'&district='+district+'&block='+block,'_blank');
}
