$(document).ready(function() {

    /**
     * Delete a user
     */
    $('.btn-delete-user').click(function() {
        window.location.href = "users/delete/" + $(this).attr('data-id');
    });
	
	 /**
     * Delete a record
     */
    $('.btn-delete-record').click(function() {
        window.location.href = "finance/delete/" + $(this).attr('data-id');
    });
	
	/**
     * Delete a catven
     */
    $('.btn-delete-catven').click(function() {
        window.location.href = "delete_catven/" + $(this).attr('data-id');
    });
});
