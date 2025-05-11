function startEdit(commentId) {
    document.getElementById('comment-text-' + commentId).style.display = 'none';

    document.getElementById('edit-form-' + commentId).style.display = 'block';

    const commentActions = document.querySelector(`#comment-text-${commentId}`).parentElement.querySelector('.comment-actions');
    if (commentActions) {
        commentActions.style.display = 'none';
    }
}

function cancelEdit(commentId) {
    document.getElementById('comment-text-' + commentId).style.display = 'block';

    document.getElementById('edit-form-' + commentId).style.display = 'none';

    const commentActions = document.querySelector(`#comment-text-${commentId}`).parentElement.querySelector('.comment-actions');
    if (commentActions) {
        commentActions.style.display = 'flex';
    }
}
