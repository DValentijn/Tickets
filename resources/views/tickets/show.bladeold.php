<x-app-layout>

    <div class="Ticketcontent">
    <h1 style="font-weight: 700">{{ $ticket->title }}</h1>
    <h3>{{ $ticket->description }}</h1><br>
    <!-- Ticket details here -->

    <!-- List existing comments -->
    <div class="comments">
    @foreach($ticket->comments as $comment)
    <h3>
        <div>
        <div class="Profiel"><img src="user.jpg"></img><h1 style="font-size: 15px; font-weight: 700;">{{ $comment->user->name }}<br> {{ $comment->created_at }}</h1></div>
        {{ $comment->body }}<br><br></div>
    @endforeach


    <h2>Add a Comment</h2>
    <form method="POST" action="{{ route('comments.store') }}">
        @csrf
        <textarea name="body" class="form-control" required></textarea>
        <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->id }}" />
        <br>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div> 
</div>


<style>
    .Profiel {
        border-radius: 10px;
        background-color: gray;
        padding: 10px;
    }

    </style>

</x-app-layout>
