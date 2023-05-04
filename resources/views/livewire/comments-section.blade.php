<div>
  <hr>
  @if ($this->successMessage)
  <div class="alert alert-success">
    {{ $this->successMessage }}
  </div>
  @endif

  <form wire:submit.prevent="addComment" method="POST">
    @csrf
    <div class="my-3">
      <textarea wire:model.defer="comment" class="form-control" name="comment" id="comment" cols="30" rows="5"
        placeholder="Type your comment here..."></textarea>
      <button class="btn btn-primary my-2">Post Comment</button>
    </div>
  </form>

  @foreach ($ticket->comments as $comment)
  <span><b>{{ $comment->user->name }}</b></span>
  <span class="ms-2 text-secondary">{{ $comment->created_at->diffForHumans() }}</span>
  <p>{{ $comment->text }}</p>
  @endforeach
</div>