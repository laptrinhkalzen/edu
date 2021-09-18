$(document).ready(function(){
    $('.updateteacherstatus').click(function(){
        var id=$(this).attr("teacher_id");
        var status=$(this).text();
        // alert(status);
        // alert(action);
        // alert(id);
        $.ajax({
            url: '/api/update-teacher-status',
            method:'POST',
            data:{
                id:id,
                status:status,
                
            },
            success:function(resp){
                // alert(resp['action']);
                if(resp['status']==0){
                    // alert(resp.action);
                    // alert(resp.id);
                    $('#teacher-'+ id).html('<a class""="updateteacherstatus text text-grey">Inactive</a>');
                    
                }else{
                    $('#teacher-'+id).html('<a class="updateteacherstatus text text-success">Active</a>');
                    
                }
            },error:function(){
                alert("error");
            }
        });
    });
});