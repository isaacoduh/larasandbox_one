jQuery(document).ready(function ($) {
    /**Trigger modal create */
    jQuery('#add-task-btn').click(function () {
        jQuery('#btn-save').val('add');
        jQuery('#addTaskForm').trigger('reset');
        jQuery('#addTaskFormModal').modal('show');
    });

    /**Add */
    $('#btn-save').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var addTaskFormData = {
            task: jQuery('#task').val(),
            description: jQuery('#description').val()
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var task_id = jQuery('#task_id').val();
        var ajaxurl = 'task';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: addTaskFormData,
            dataType: 'json',
            success: function(data){
                var task = '<tr id="task' + data.id + '"><td>' + data.id + '</td><td>' + data.task + '</td><td>' + data.description + '</td>';
                task += '<td><button class="btn btn-primary edit-modal" value="' + data.id + '">Edit</button>&nbsp;';
                task += '<button class="btn btn-danger delete-task" value="' + data.id + '">Delete</button></td></tr>';
                if(state == "add"){
                    jQuery('#task-list').append(task);
                }else{
                    jQuery("#task" + task_id).replaceWith(task);
                }
                jQuery('#addTaskForm').trigger('reset');
                jQuery('#addTaskFormModal').modal('hide');
            },
            error: function(data){
                console.log(data);
            }
        });
    });
});
