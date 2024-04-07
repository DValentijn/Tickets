<x-app-layout>

    <style>
        .Profile img {
            width: 50px; /* Adjust as needed */
            height: 50px; /* Adjust as needed */
            border-radius: 50%; /* Makes the image circular */
        }
        .Profile {
            display: flex;
    gap: 10px;
    flex-direction: column;
        }
        .comments h3 {
            display: flex;
            width: 100%;
        }

        .comments {
            background-color: #303f53;
    padding: 20px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
        }





        .bubble {
  --r: 25px; /* the radius */
  --t: 30px; /* the size of the tail */
  
  max-width: 300px;
  padding: calc(2*var(--r)/3);
  -webkit-mask: 
    radial-gradient(var(--t) at var(--_d) 0,#0000 98%,#000 102%) 
      var(--_d) 100%/calc(100% - var(--r)) var(--t) no-repeat,
    conic-gradient(at var(--r) var(--r),#000 75%,#0000 0) 
      calc(var(--r)/-2) calc(var(--r)/-2) padding-box, 
    radial-gradient(50% 50%,#000 98%,#0000 101%) 
      0 0/var(--r) var(--r) space padding-box;
  color: #fff;
}
.left {
  --_d: 0%;
  border-left: var(--t) solid #0000;
  margin-right: var(--t);
  place-self: start;
  background-color: rgb(83, 79, 200);
}
.right {
  --_d: 100%;
  border-right: var(--t) solid #0000;
  margin-left: var(--t);
  place-self: end;
  background-color: rgb(176, 66, 66);
}

.form-control {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    color: black;
}

[x-cloak] { display: none !important; }

    </style>

    <div class="Ticketcontent">
        <h1 style="font-weight: 700">{{ $ticket->title }}</h1>
        <h3>{{ $ticket->description }}</h3><br>
        {{-- <button type="refresh" class="btn btn-primary" onclick="window.location.reload();">Refresh</button><br><br> --}}
        
        {{-- POPUP CREATION --}}

        <div x-data="{ open: false }">
            <!-- Trigger Button -->
            <button @click="open = true">Scrum board</button>
        
            <!-- Popup Modal -->
            <div x-cloak x-show="open" @click.away="open = false" style="background-color: rgba(0,0,0,0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;">
                <div class="popupmiddle" style="display: flex !important; align-items: center; justify-content: center;">
                    <div style="position: relative; background-color: white; padding: 20px; padding-top: 40px; border-radius: 10px; color: black; width: 1200px; height: 700px;">
                        <span style="position: absolute; top: 0; right: 10px; cursor: pointer; font-size: 44px; font-weight: bold;" @click="open = false">&times;</span>
                        <iframe src="https://sharing.clickup.com/9015544022/b/h/4-90151820181-2/62cff5e31576f5e" width="100%" height="500px"></iframe>
                    </div>
                </div>
            </div><br><br>
            
        

        {{-- END --}}










        <!-- Ticket details here -->

        <!-- List existing comments -->
        <div class="comments">
            @php
                $loggedInUserId = Auth::user()->id; // Assuming you have the Auth facade
            @endphp
            @foreach($ticket->comments as $comment)
                @php
                $messageClass = $comment->user->id === $loggedInUserId ? 'right' : 'left';
                @endphp






                <div class="bubble {{ $messageClass }}">
                    <div class="Profile">
                        <img src='{{Storage::url($comment->user->profilepicture)}}' :value="old('profilepicture', $comment->user->profilepicture)" required autofocus autocomplete="profilepicture" /></img>
                        <h1 style="font-size: 15px; font-weight: 700;">{{ $comment->user->name }}<br> 
                        {{ $comment->user->role->name ?? 'No Role' }}<br> <!-- Adjusted to display role -->
                        {{ $comment->created_at->format('H:i d M Y') }}</h1>
                    <p>{{ $comment->body }}</p>
                    @if($comment->image_path) <!-- Check if there's an image -->
                    <img src="{{ Storage::url($comment->image_path) }}" style="    max-width: 300px !important; max-height: 300px !important; border-radius: 10px !important; min-height: 100px !important; min-width: 100px !important;">
                @endif
                </div>
                </div>

            @endforeach

            <form method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                @csrf
                <textarea name="body" class="form-control"></textarea>
                <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->id }}" />
                <input type="file" name="image" class="form-control"> <!-- Image upload input -->
                <br>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
                 
            </form>
            	
        </div> 
    </div>

</x-app-layout>
