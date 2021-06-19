jQuery(document).delegate('a.add-record', 'click', function(e) {
         e.preventDefault();    
         var content = jQuery('#shg-table tr'),
         size = jQuery('#tbl_posts >tbody >tr').length + 1,
         element = null,    
         element = content.clone();
         element.attr('id', 'rec-'+size);
         element.find('.delete-record1').attr('data-id', size);
         element.appendTo('#tbl_posts_body');
         element.find('.sn').html(size);
       });

  jQuery(document).delegate('a.delete-record1', 'click', function(e) {
     e.preventDefault();    
     var didConfirm = confirm("Are you sure you want to delete ?");
     if (didConfirm == true) {
      var id = jQuery(this).attr('data-id');
      var targetDiv = jQuery(this).attr('targetDiv');
      jQuery('#rec-' + id).remove();
      
    //regnerate index number on table
    $('#tbl_posts_body tr').each(function(index) {
      //alert(index);
      $(this).find('span.sn').html(index+1);
    });
    return true;
  } else {
    return false;
  }
});

/* mfp table script */

jQuery(document).delegate('a.add-record', 'click', function(e) {
    e.preventDefault();    
    var content = jQuery('#mfp-table-child tr'),
    size = jQuery('#mfp-table-parent >tbody >tr').length + 1,
    element = null,    
    element = content.clone();
    element.attr('id', 'rec-'+size);
    element.find('.delete-record2').attr('data-id', size);
    element.appendTo('#mfp_table_body');
    element.find('.sn').html(size);
  });

jQuery(document).delegate('a.delete-record2', 'click', function(e) {
e.preventDefault();    
var didConfirm = confirm("Are you sure you want to delete ?");
if (didConfirm == true) {
 var id = jQuery(this).attr('data-id');
 var targetDiv = jQuery(this).attr('targetDiv');
 jQuery('#rec-' + id).remove();
 
//regnerate index number on table
$('#mfp_table_body tr').each(function(index) {
 //alert(index);
 $(this).find('span.sn').html(index+1);
});
return true;
} else {
return false;
}
});



/* propose value table script */

jQuery(document).delegate('a.add-record3', 'click', function(e) {
    e.preventDefault();    
    var content = jQuery('#propose-value-child tr'),
    size = jQuery('#propose-value-parent >tbody >tr').length + 1,
    element = null,    
    element = content.clone();
    element.attr('id', 'rec-'+size);
    element.find('.delete-record3').attr('data-id', size);
    element.appendTo('#propose-value-body');
    element.find('.sn').html(size);
  });

jQuery(document).delegate('a.delete-record3', 'click', function(e) {
e.preventDefault();    
var didConfirm = confirm("Are you sure you want to delete ?");
if (didConfirm == true) {
 var id = jQuery(this).attr('data-id');
 var targetDiv = jQuery(this).attr('targetDiv');
 jQuery('#rec-' + id).remove();
 
//regnerate index number on table
$('#propose-value-body tr').each(function(index) {
 //alert(index);
 $(this).find('span.sn').html(index+1);
});
return true;
} else {
return false;
}
});


/* propose equipment  */


/* propose equipment script */

jQuery(document).delegate('a.add-record4', 'click', function(e) {
    e.preventDefault();
    var content = jQuery('#table-equipment-child tr'),
    size = jQuery('#table-equipment-parent >tbody >tr').length + 1,
    element = null,    
    element = content.clone();
    element.attr('id', 'rec-'+size);
    element.find('.delete-record4').attr('data-id', size);
    element.appendTo('#table-equipment-body');
    element.find('.sn').html(size);
  });





/* HAAT BAAZAAR */

jQuery(document).delegate('a.add-record6', 'click', function(e) {
    e.preventDefault();    
    var content = jQuery('#haat-baazar-table-child tr'),
    size = jQuery('#haat-baazar-table-parent >tbody >tr').length + 1,
    element = null,    
    element = content.clone();
    element.attr('id', 'rec-'+size);
    element.find('.delete-record6').attr('data-id', size);
    element.appendTo('#haat-baazar-table-body');
    element.find('.sn').html(size);
  });

jQuery(document).delegate('a.delete-record6', 'click', function(e) {
e.preventDefault();    
var didConfirm = confirm("Are you sure you want to delete ?");
if (didConfirm == true) {
 var id = jQuery(this).attr('data-id');
 var targetDiv = jQuery(this).attr('targetDiv');
 jQuery('#rec-' + id).remove();
 
//regnerate index number on table
$('#haat-baazar-table-body tr').each(function(index) {
 //alert(index);
 $(this).find('span.sn').html(index+1);
});
return true;
} else {
return false;
}
});

/* ware house table script */

jQuery(document).delegate('a.add-record7', 'click', function(e) {
    e.preventDefault();    
    var content = jQuery('#table-warehouse-child tr'),
    size = jQuery('#table-warehouse-parent >tbody >tr').length + 1,
    element = null,    
    element = content.clone();
    element.attr('id', 'rec-'+size);
    element.find('.delete-record7').attr('data-id', size);
    element.appendTo('#table-warehouse-body');
    element.find('.sn').html(size);
  });

jQuery(document).delegate('a.delete-record7', 'click', function(e) {
e.preventDefault();    
var didConfirm = confirm("Are you sure you want to delete ?");
if (didConfirm == true) {
 var id = jQuery(this).attr('data-id');
 var targetDiv = jQuery(this).attr('targetDiv');
 jQuery('#rec-' + id).remove();
 
//regnerate index number on table
$('#table-warehouse-body tr').each(function(index) {
 //alert(index);
 $(this).find('span.sn').html(index+1);
});
return true;
} else {
return false;
}
});


/* buyer table script */

jQuery(document).delegate('a.add-record8', 'click', function(e) {
    e.preventDefault();    
    var content = jQuery('#buyer-table-child tr'),
    size = jQuery('#buyer-table-parent >tbody >tr').length + 1,
    element = null,    
    element = content.clone();
    element.attr('id', 'rec-'+size);
    element.find('.delete-record8').attr('data-id', size);
    element.appendTo('#buyer-table-body');
    element.find('.sn').html(size);
  });

jQuery(document).delegate('a.delete-record8', 'click', function(e) {
e.preventDefault();    
var didConfirm = confirm("Are you sure you want to delete ?");
if (didConfirm == true) {
 var id = jQuery(this).attr('data-id');
 var targetDiv = jQuery(this).attr('targetDiv');
 jQuery('#rec-' + id).remove();
 
//regnerate index number on table
$('#buyer-table-body tr').each(function(index) {
 //alert(index);
 $(this).find('span.sn').html(index+1);
});
return true;
} else {
return false;
}
});
