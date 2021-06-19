$(document).ready(function(){
    $('#loader-div').html('');
    $('#loader-div').hide();
});
function removeTags(str) {
      if ((str===null) || (str===''))
      return false;
      else
      str = str.toString();
      return str.replace( /(<([^>]+)>)/ig, '');
   }
