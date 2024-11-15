
$(document).ready(function() {
    const counter = 0;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // CREATE COMMENT
    $('.createComment').submit(function(event) {

        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: '/comments',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {

                $('.CommentsDisplay').append('<h4>'+ response.username +': </h4>')
                $('.CommentsDisplay').append('<p>'+ response.comment +'</p>')

                $('.CommentsDisplay').append('<a href="#" class="approveComment btn btn-success m-2 px-4" data-comment-id="'+ response.commentId +'">Approve</a>')
                $('.CommentsDisplay').append('<a href="#" class="disapproveComment btn btn-danger m-2 px-4" data-comment-id="'+ response.commentId +'">Disapprove</a>')


                alert('Comment successfuly submited. An admin will review your comment and post it if adequate.');
            },
            error: function(xhr, status, error) {
                console.log("big ass error : ", error)
            }
        });
    });

    //DISAPPROVE COMMENT
    $(document).on('click', '.disapproveComment', function(event) {
        event.preventDefault();
        var commentId = $(this).data('comment-id');
        var commentContainer = $('.comment-' + commentId);
        $.ajax({
            url: '/comments/' + commentId + '/disapprove',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('@if (\\Illuminate\\Support\\Facades\\Auth::user())')
                commentContainer.remove();

                alert('Comment disaproved successfully');
            },
            error: function(xhr, status, error) {
                alert('error not disapprove ! ')
            }
        });
    });

    // APPROVE COMMENT
    $(document).on('click','.approveComment', function(event) {
        event.preventDefault();
        var commentId = $(this).data('comment-id');
        var commentContainer = $('.comment-' + commentId);
        $.ajax({
            url: '/comments/' + commentId + '/approve',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // data-comment-id="{{$comment->id}}"
                console.log()
                commentContainer.remove();
                deleteButton = $('#dugmence')

                var approvedComment =
                                            '<h4 class="comment-'+ response.comment_id +'">'+ response.username + ':</h4>' +
                                            '<p class="m-1 comment-'+ response.comment_id +'">' + response.comment + '</p>'

                $('.commentButtonContainer').addClass("comment-"+ response.comment_id);

                $('.deleteCommentApproved').each(function() {
                    $(this).attr('data-comment-id', response.comment_id);

                    $(this).css('display', 'block');
                });

                $('.CommentsDisplayAproved').prepend(approvedComment);

                alert('Comment aproved successfully');
            },
            error: function(xhr, status, error) {
                alert('error not disapprove ! ')
            }
        });
    });

     // DELETE COMMENT
     $(document).on('click', '.deleteComment',function() {
        var commentId = $(this).data('comment-id');
        var commentContainer = $('.comment-' + commentId);
        $.ajax({
            url: '/comments/' + commentId + '/delete',
            type: 'DELETE',
            dataType: 'json',
            success: function(response) {

                commentContainer.remove();

                $('.deleteCommentApproved').css('display', 'none');


                alert('Comment deleted successfully');
            },
            error: function(xhr, status, error) {
                alert('error not deleted ! ')
            }
        });
    });


//==============================*NOTES*==============================
    //CREATE NOTE
    $(document).on('click', '.addNote', function(){
        var createNotesForm = $('.createNoteForm');
        createNotesForm.css('display', 'flex')
    })

    $('.createNoteForm').submit(function(event){
        event.preventDefault();
        var bookId = $('.submitNote').data('book-id');
        var formData = $(this).serialize();

        console.log(bookId)

        $.ajax({
            url: '/notes/'+ bookId+ '/store',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response){
                $('.createNoteForm').css('display', 'none');
                $('.noteTableBody').prepend('<tr><td> => </td><td>'+ response.note +'</td></tr>')

                alert('successfuly created note.')
            },
            error: function(xhr, status, error){
                alert('error while createing note !')
            }
        })
    })

    $("tbody").on("click", ".edit-note", function(e) {

        e.preventDefault();

        var noteId = $(this).data("note-id");
        var noteTd = $('.note-' + noteId);
        var inputTd = $('.noteInput-'+noteId+'')

        noteTd.css('display', 'none');
        inputTd.css('display', 'block');
        $('.addTheNote-'+ noteId +'').css('display','block');


        inputTd.focus();

    });

    $('tbody').on('submit', '.updateNote', function(e){
        e.preventDefault();
        var noteId = $(this).data("note-id");
        console.log(noteId);
        var noteTd = $('.note-' + noteId);
        var formData = $(this).serialize();
        var inputTd = $('.noteInput-'+noteId+'')
        console.log(formData)
        $.ajax({
            url: '/notes/' + noteId + '/update',
            type: 'GET',
            data: formData,
            dataType: 'json',
            success: function(response){

                $('.addTheNote-'+ noteId +'').css('display','none');
                noteTd.css('display', 'block');
                inputTd.css('display', 'none');
                $('.content-note-'+noteId+'').text(response.note)

                alert('succesfuly updated note')
            },
            error: function(xhr,status,error){
                alert('error while updateing note', error)
            }

        })

    })
    $('tbody').on('click', '.delteNote', function(event){
        var noteId = $(this).data('note-id');

        $.ajax({
            url: '/notes/'+noteId+'/delete',
            type: 'GET',
            dataType: 'json',
            success: function(response){

                $('.tr-'+noteId+'').remove();

                alert('succesfully deleted note!')
            },
            error: function(response){
                alert('error while deleteing note')
            }
        })
    })


});
