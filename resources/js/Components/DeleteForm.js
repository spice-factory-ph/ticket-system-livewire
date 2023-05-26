import React from 'react';

const DeleteForm = (props) => {
  const handleDelete = (id) => {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $('form#delete-' + id).trigger('submit');
      }
    })
  };

  return (
    <React.Fragment>
      <button className="btn btn-danger deleteButton" onClick={() => { handleDelete(props.ticketId) }}>
        <i className="fa-solid fa-trash-can"></i>
      </button>
      <form
        id={`delete-${props.ticketId}`}
        action={`/tickets/${props.ticketId}`}
        method="POST"
        hidden
      >
        <input type="hidden" name="_method" value="DELETE" />
        <input type="hidden" name="_token" value={props.csrf_token} />
      </form>
    </React.Fragment>
  );
};

export default DeleteForm;